<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserProfileRequest;
use Auth;
use App\Profile;
use App\User;

class ProfileController extends Controller
{
    public function index(Request $request){

      $user = User::with('profile')->where('id',Auth::user()->id)->first();
      
      return view('admin.profile',compact('user'));
    }
    
    public function store(UserProfileRequest $request){
      
      $user = Auth::user();
      
      $user->name       = $request->first_name;
      
      $user->last_name  = $request->last_name;
      
      $user->email      = $request->email;
      
      $user->phone      = $request->phone;

      if($user->save()){
      
        $profile = Auth::user()->profile()->first();
       
        if($profile == '' ){
          
          $profile = new Profile();
        
        }
        $profile->user_id     = Auth::user()->id;
        
        $profile->age     = $request->age;
        
        $profile->gender  = $request->gender;
        
        $profile->height  = $request->height;
        
        $profile->weight  = $request->weight;
        
        $profile->address = $request->address;
        
        if($profile->save()){
            $response = ['message' => 'Profile Updated.', 'alert-type' => 'success'];
        }
        
        return redirect()->route('admin.profile')->with($response);
      
      }
      
      $response = ['message' => 'Something Went Wrong.', 'alert-type' => 'danger'];
      
      return redirect()->route('admin.profile')->with($response); 
    
    }
}