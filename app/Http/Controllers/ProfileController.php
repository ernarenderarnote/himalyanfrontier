<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
class ProfileController extends Controller
{
    public function index(Request $request){
		$user = Auth::user()->with('profile')->first();
		//dd($user);
		return view('profile',compact('user'));
	}
}