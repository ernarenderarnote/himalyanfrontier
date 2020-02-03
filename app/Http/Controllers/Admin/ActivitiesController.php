<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyActivityRequest;
use App\Http\Requests\StoreActivityRequest;
use App\Http\Requests\UpdateActivityRequest;
use App\Activity;

class ActivitiesController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(\Gate::allows('activity_access'), 403);

        $activities = Activity::all();

        return view('admin.activities.index', compact('activities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(\Gate::allows('activity_create'), 403);

        return view('admin.activities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreActivityRequest $request)
    {
        abort_unless(\Gate::allows('activity_create'), 403);
       
        $input = $request->all();
        
        $activity = new Activity();
        
        $input['slug'] = \Str::slug($request->title);

        if($request->has('image')) {

            $image =  $request->file('image');

            $imageName = time().'.'.request()->image->getClientOriginalExtension();
            
            $image->storeAs('images/activity/featureImages', $imageName);
            
            $input['thumbnails'] = $imageName;

        }
        if($request->has('gallery_img')) {

            $gallery_images =  $request->file('gallery_img');
            $images_name = array();
            foreach($gallery_images as $gallery_image){
                $images_name[] = $gallery_image->getClientOriginalName();
                $imagesname = $gallery_image->getClientOriginalName();
                $gallery_image->storeAs('images/activity/galleryImages', $imagesname);
            }
            $input['gallery_img'] = json_encode($images_name);
        }
        if( Activity::create($input) ){
            $response = ['message' => 'Activity Added Successfully.', 'alert-type' => 'success'];
        }
        return redirect()->route('admin.activities.index')->with($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Activity $activity)
    {
        abort_unless(\Gate::allows('activity_show'), 403);

        return view('admin.activities.show', compact('activity'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Activity $activity)
    {
        abort_unless(\Gate::allows('activity_edit'), 403);

        return view('admin.activities.edit', compact('activity'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateActivityRequest $request, Activity $activity)
    {
        abort_unless(\Gate::allows('activity_edit'), 403);

        $input = $request->all();
        
        $input['slug'] = \Str::slug($request->title);

        if($request->has('image')) {

            $image =  $request->file('image');

            $imageName = time().'.'.request()->image->getClientOriginalExtension();
            
            $image->storeAs('images/activity/featureImages', $imageName);
            
            $input['thumbnails'] = $imageName;

        }
        if($request->has('gallery_img')) {

            $gallery_images =  $request->file('gallery_img');
            $images_name = array();
            foreach($gallery_images as $gallery_image){
                $images_name[] = $gallery_image->getClientOriginalName();
                $imagesname = $gallery_image->getClientOriginalName();
                $gallery_image->storeAs('images/activity/galleryImages', $imagesname);
            }
            $input['gallery_img'] = json_encode($images_name);
        }
        if( $activity->update($input) ){
            $response = ['message' => 'Activity Updated Successfully.', 'alert-type' => 'success'];
        }
        return redirect()->route('admin.activities.index')->with($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $activity)
    {

        abort_unless(\Gate::allows('activity_delete'), 403);
        if( $activity->delete() ){
            $response = ['message' => 'Activity Deleted Successfully.', 'alert-type' => 'success'];
        }
        return back()->with($response);
    }

    public function massDestroy(MassDestroyActivityRequest $request)
    {
        
        Activity::whereIn('id', request('ids'))->delete();

        return response(null, 204);
    }
}
