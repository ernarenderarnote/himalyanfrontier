<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Testimonial;

class TestimonialController extends Controller
{
    public function index(){

        $testimonials = Testimonial::where('is_active','1')
                        ->get();

        return view('testimonials',compact('testimonials'));
    }
}
