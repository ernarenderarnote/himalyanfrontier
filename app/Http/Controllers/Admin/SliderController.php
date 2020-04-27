<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\StoreSliderRequest;
use App\Http\Requests\UpdateSliderRequest;
use App\Http\Controllers\Controller;
use App\Slider;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::all();
        return view('admin.sliders.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('admin.sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSliderRequest $request)
    {
        $input = $request->all();

        $slider = new Slider;
        
        $input['slug'] = \Str::slug($request->title);
        
        if($request->has('photo')) {
           
            $sliderImages =  $request->file('photo');
            
            $images_name = array();

            foreach($sliderImages as $sliderImage){

                $images_name[] = $sliderImage->getClientOriginalName();

                $imagesname    = $sliderImage->getClientOriginalName();

                $sliderImage->storeAs('images/sliders/', $imagesname);

            }

            $input['photo'] = json_encode($images_name);
        
        }

        if( Slider::create($input) ){

            $response = ['message' => 'Slider Created Successfully.', 'alert-type' => 'success'];
        
        }
        return redirect()->route('admin.slides.index')->with($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slide)
    {
        $slider = $slide;
        return view('admin.sliders.edit', compact('slider'));
    }

    
     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slide)
    {
       
        return view('admin.sliders.show', compact('slide'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSliderRequest $request, Slider $slide)
    {
        
        abort_unless(\Gate::allows('activity_edit'), 403);

        $input = $request->all();
        
        $input['slug'] = \Str::slug($request->title);

        if($request->has('photo') && $request->has('gallery_upload_img')) {
            
            $sliderImages =  $request->file('photo');

            $images_name = array();

            foreach($sliderImages as $sliderImage){

                $images_name[] = $sliderImage->getClientOriginalName();

                $imagesname = $sliderImage->getClientOriginalName();

                $sliderImage->storeAs('images/sliders/', $imagesname);

            }
            $images_uploaded = $images_name;
            if( $request->has('gallery_upload_img') && $request->photo !== '' ){
                $input['photo']  = json_encode($request->gallery_upload_img);
                $images_uploaded = array_merge($images_name, $request->gallery_upload_img);
            }
            
            $input['photo'] = json_encode($images_uploaded);    
        }elseif($request->has('gallery_upload_img') && !null == $request->gallery_upload_img){
            $input['photo'] = json_encode($request->gallery_upload_img);
        }else{
			$sliderImages =  $request->file('photo');

            $images_name = array();

            foreach($sliderImages as $sliderImage){

                $images_name[] = $sliderImage->getClientOriginalName();

                $imagesname = $sliderImage->getClientOriginalName();

                $sliderImage->storeAs('images/sliders/', $imagesname);

            }
            $images_uploaded = $images_name;
			$input['photo']  = json_encode($images_uploaded);
		}

        if( $slide->update($input) ){
            $response = ['message' => 'Slider Updated Successfully.', 'alert-type' => 'success'];
        }
        return redirect()->route('admin.slides.index')->with($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slide)
    {

        if( $slide->delete() ){
            $response = ['message' => 'Slider Deleted Successfully.', 'alert-type' => 'success'];
        }
        return back()->with($response);
    }

    public function massDestroy(Request $request)
    {
        
        Slider::whereIn('id', request('ids'))->delete();

        return response(null, 204);
    }

    public function setDefault($id){

        $removeDefault   = Slider::where('is_default', '1')->update(array('is_default' => '0'));

        $setDefault      = Slider::where('id',$id)->first();

        $setDefault->is_default = '1';

        if(  $setDefault->save() ){
            $response = ['message' => 'Slider set as default successfully.', 'alert-type' => 'success'];
        }

        return redirect()->route('admin.slides.index')->with($response); 
    }
}