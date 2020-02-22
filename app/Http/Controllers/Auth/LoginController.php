<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\LoginOtpRequest;
use Illuminate\Http\Request;
use Validator;
use Redirect;
use Socialite;
use App\User;
use Auth;
use Hash;
use App\Token;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->middleware('guest')->except('logout');
    }

    /**
     * Handle mobile login
     * @return void
     */
    public function login(Request $request){
       
        if ($request->isMethod('post')) {

            $this->validate($request, $this->stepOneRules(), $this->stepOneMsg());

            $user_exist = User::where('phone',$request->mobile_number)->first();
        
            if( !empty($user_exist) ){
                
                $user = $user_exist;
            
            }else{
                $user = new user();

                $user->country_code = 91;
                
                $user->phone = $request->mobile_number;
                
                $user->save();
                
                $user->roles()->attach(2);
            }
            
            $token = Token::create([
                'user_id' => $user->id
            ]);
            
            if ($token->sendCode()) {
                
                $mobile_number = str_pad(substr($request->mobile_number, -4), strlen($request->mobile_number), '*', STR_PAD_LEFT);
                
                session(['token_id' => $token->id]);
                
                session(['user_id' => $user->id]);
                
                session(['mobile_number' => $request->mobile_number]);
                
                return view('auth.otp')->with('mobile_number',$mobile_number);
            }
            $token->delete();// delete token because it can't be sent
            return response()->json([
                'error' => true,
                'msg' => 'Unable to Send Otp'
            ]);
		}
    }

    public function resendOtp(Request $request){
        $mobile_number = session()->get('mobile_number');
        $user = User::where('phone',$mobile_number)->first();
        if( empty($user) ){
            return response()->json([
                'error' => true,
                'msg' => 'Unable to Send Otp'
            ]);
        }else{
            $token = Token::create([
                'user_id' => $user->id
            ]);
            
            if ($token->sendCode()) {
                session(['token_id' => $token->id]);
                session(['user_id' => $user->id]);
                session(['mobile_number' => $mobile_number]);
                return response()->json([
                    'error' => false,
                    'msg' => 'Otp send to registered number.'
                ]);
            }
            $token->delete();// delete token because it can't be sent
            return response()->json([
                'error' => true,
                'msg' => 'Unable to Send Otp'
            ]);
        }

    }

    public function loginotp(Request $request){
        if ($request->isMethod('post')) {
            $this->validate($request, $this->otpRules(), $this->otpMsg());
            // throttle for too many attempts
            if (! session()->has("token_id", "user_id")) {
                return response()->json([
                    'error' => false,
                    'redirect_url' => $this->redirectTo
                ]);
            }
            $token = Token::find(session()->get("token_id"));
            if (! $token ||
                ! $token->isValid() ||
                $request->otp !== $token->code ||
                (int)session()->get("user_id") !== $token->user->id
            ) {
                return response()->json([
                    'error' => true,
                    'msg' => 'Enter a valid Otp.'
                ]);
            }
            $token->used = true;
            $token->save();
            $this->guard()->login($token->user);
            session()->forget('token_id', 'user_id'); 
			return response()->json([
                'error' => false,
                'redirect_url' => $this->redirectTo
            ]);
		}
        
    }
	/**
    * Handle Social login request
    *
    * @return response
    */
	public function socialLogin($social)
	{
	   return Socialite::driver($social)->redirect();
	}
	/**
	* Obtain the user information from Social Logged in.
	* @param $social
	* @return Response
	*/
	public function handleProviderCallback($social)
	{
		$userSocial = Socialite::driver($social)->stateless()->user();
		$user = User::where(['email' => $userSocial->getEmail()])->first();
	    if($user){
		   Auth::login($user);
		   return redirect()->intended($this->redirectTo);
	    }else{
		   $user = User::create([
                'name'          => $userSocial->getName(),
                'email'         => $userSocial->getEmail(),
                'image'         => $userSocial->getAvatar(),
                'provider_id'   => $userSocial->getId(),
                'provider'      => $social,
            ]);
			$user->roles()->attach(2);
			Auth::login($user);
			$info = ['name' => $userSocial->getName(), 'email' => $userSocial->getEmail()];
			return redirect()->intended($this->redirectTo);
		}
    }
    
    public function stepOneRules()
    {
        return [
                 "mobile_number" => "required"
        ];
    }

    public function stepOneMsg()
    {
        return [
                "mobile_number" => 'Mobile number is required.',
           
        ];
    }
	
	public function otpRules()
    {
        return [
                 "otp" => "required"
        ];
    }

    public function otpMsg()
    {
        return [
                "otp.required" => 'Otp is required.',
           
        ];
    }
    // admin login functions
    public function adminLogin(Request $request){
        return view('auth.adminLogin');
    }

    public function admin(Request $request){
        $action = $this->request->route()->getAction();

       if($this->request->isMethod('post'))
        {
            $this->validate($this->request, $this->getLoginRules());

            return $this->authenticate();
        }
        else
        {
            return view("auth.adminLogin");
        }
    }

    public function getLoginRules()
    {
        return [
                'email'      => 'required|email',
                'password'   => 'required',
        ];
    }

    /**
     * Handle an authentication attempt.
     *
     * @return Response
     */
    public function authenticate()
    {

        $user = User::whereEmail($this->request->email)->first();

        if ($user && Hash::check($this->request->password, $user->password))
        {
            if($user instanceof User )
                Auth::login($user, $this->request->remember_to_pc);
            else{

                Auth::login($user->user, $this->request->remember_to_pc);
                $user->remember_token = auth()->user()->remember_token;
                $user->save();
              
            }
            return redirect()->intended($this->redirectTo);
        }
        else{
            return redirect()->back()->withInput()->with('error',"Either email/password is wrong");
        }
    }
}
