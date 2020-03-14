<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyYoutubeSliderRequest;
use App\Http\Requests\StoreYoutubeSliderRequest;
use App\Http\Requests\UpdateYoutubeSliderRequest;
use App\YoutubeSlider;

class YoutubeSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $youtubeVideos =  YoutubeSlider::all();
        return view('admin.youtubeSlider.index',compact('youtubeVideos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.youtubeSlider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreYoutubeSliderRequest $request)
    {
        $input = $request->all();

        $slider = new YoutubeSlider;
        
        $input['slug'] = \Str::slug($request->title);

        if( YoutubeSlider::create($input) ){

            $response = ['message' => 'Video added Successfully.', 'alert-type' => 'success'];
        
        }
        return redirect()->route('admin.youtube-slider.index')->with($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(YoutubeSlider $youtubeSlider)
    {
        return view('admin.youtube-slider.show', compact('youtubeSlider'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(YoutubeSlider $youtubeSlider)
    {
        return view('admin.youtubeSlider.edit', compact('youtubeSlider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response+-+
     */
    public function update(UpdateYoutubeSliderRequest $request, YoutubeSlider $youtubeSlider)
    {
        $input = $request->all();
        
        $input['slug'] = \Str::slug($request->title);

        if( $youtubeSlider->update($input) ){

            $response = ['message' => 'Video updated Successfully.', 'alert-type' => 'success'];
        
        }
        return redirect()->route('admin.youtube-slider.index')->with($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( YoutubeSlider $youtubeSlider)
    {
        if( $youtubeSlider->delete() ){
            $response = ['message' => 'Video Deleted Successfully.', 'alert-type' => 'success'];
        }
        return back()->with($response);
    }

    public function massDestroy(MassDestroyYoutubeSliderRequest $request)
    {
        
        YoutubeSlider::whereIn('id', request('ids'))->delete();

        return response(null, 204);
    }
}
