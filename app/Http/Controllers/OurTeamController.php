<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OurTeamController extends Controller
{
    public function index(Request $request){
        return view('ourTeam');
    }
}
