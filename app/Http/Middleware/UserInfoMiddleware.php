<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Contracts\Routing\Middleware;
use Illuminate\Support\Facades\Auth;
class UserInfoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
		if($request->path() !== 'profile' && $user && ($user->name === NULL || $user->email === NULL || $user->phone === null ) )
		{
            
			if(Auth::user()->hasRole('admin')){
				return \Redirect::to('admin/profile');
			}else if(Auth::user()->hasRole('user')){
				return \Redirect::to('profile');
			}else{
				return \Redirect::to('profile');
			}	
			
		}
		return $next($request);
    }
}