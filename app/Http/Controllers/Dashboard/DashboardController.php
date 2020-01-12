<?php

namespace App\Http\Controllers\Dashboard;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;


class DashboardController extends Controller
{
    public $data = [];

    public function index()
    {
    	if( auth()->user()->hasRole('Admin') )
    	{
			//dd(auth()->user()->roles->first()->title);
    		return $this->adminDashboard();
    	}
    	else
    	{	

			//dd(auth()->user()->email);
            return $this->userDashboard();
 
    	}
    	
    }


    public function adminDashboard()
    {
		return redirect('admin/');
    }

    public function userDashboard()
    {
        return view('dashboard.user');
    }
}

