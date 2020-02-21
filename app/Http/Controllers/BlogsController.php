<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Blog;

class BlogsController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $blogs = Blog::where('is_active','1')->whereNull('deleted_at')->paginate(10);

        return view('blogs', compact('blogs'));
    }

    public function blogDetails(Request $request, $slug){

        $blog = Blog::where('is_active','1')->whereNull('deleted_at')->where('slug',$slug)->first();

        return view('singleBlog', compact('blog'));
    }
}