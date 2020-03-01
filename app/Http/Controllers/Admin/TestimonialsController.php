<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTestimonialRequest;
use App\Http\Requests\StoreTestimonialRequest;
use App\Http\Requests\UpdateTestimonialRequest;
use App\Testimonial;

class TestimonialsController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $testimonials = Testimonial::all();

        return view('admin.testimonials.index', compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.testimonials.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTestimonialRequest $request)
    {
       
        $input = $request->all();
        
        $input['slug'] = \Str::slug($request->title);

        if($request->has('image')) {

            $image =  $request->file('image');

            $imageName = time().'.'.request()->image->getClientOriginalExtension();
           
            $image->storeAs('images/testimonials', $imageName);
            
            $input['photo'] = $imageName;

        }

        if( Testimonial::create($input) ){
            $response = ['message' => 'Testimonial Added Successfully.', 'alert-type' => 'success'];
        }
        return redirect()->route('admin.testimonials.index')->with($response); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Testimonial $testimonial)
    {
        return view('admin.testimonials.show', compact('testimonial'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTestimonialRequest $request, Testimonial $testimonial)
    {
     
        $input = $request->all();
        
        $input['slug'] = \Str::slug($request->title);

        if($request->has('image')) {

            $image =  $request->file('image');

            $imageName = time().'.'.request()->image->getClientOriginalExtension();
            
            $image->storeAs('images/testimonials', $imageName);
            
            $input['photo'] = $imageName;

        }

        if( $testimonial->update($input) ){
            $response = ['message' => 'Testimonial Updated Successfully.', 'alert-type' => 'success'];
        }
        return redirect()->route('admin.testimonials.index')->with($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Testimonial $testimonial)
    {

        if( $destination->delete() ){
            $response = ['message' => 'Testimonial Deleted Successfully.', 'alert-type' => 'success'];
        }

        return back()->with($response);
    }

    public function massDestroy(MassDestroyTestimonialRequest $request)
    {
        
        if( Testimonial::whereIn('id', request('ids'))->delete() ){
            $response = ['message' => 'Testimonials Deleted Successfully.', 'alert-type' => 'success'];
        }

        return response(null, 204);
    }
}
