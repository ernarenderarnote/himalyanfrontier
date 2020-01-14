<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyItineraryRequest;
use App\Http\Requests\StoreItineraryRequest;
use App\Http\Requests\UpdateItineraryRequest;
use Illuminate\Support\Facades\Validator;
use App\Itinerary;
use App\Destination;
use App\Activity;
use App\ItinerarySchedule;

class ItinerariesController extends Controller
{
    public function index()
    {
        abort_unless(\Gate::allows('itinerary_access'), 403);

        $itineraries = Itinerary::with('destinations','activities')->get();
        return view('admin.itineraries.index', compact('itineraries'));
    }

    public function create()
    {
        abort_unless(\Gate::allows('itinerary_create'), 403);
        $destinations = Destination::all();
        $activities   = Activity::all();
        return view('admin.itineraries.create', compact('destinations', 'activities'));
    }

    public function store(StoreItineraryRequest $request)
    {
        abort_unless(\Gate::allows('itinerary_create'), 403);
        
        $input = $request->all();
        
        $format = 'm/d/Y';
        $destination = new Destination();
        
        $input['slug'] = \Str::slug($request->title);
        
        $general_info = array();
        foreach($input['general_information'] as $general_infos){
    
            if ($general_infos['title'] != '' || $general_infos['description'] != '' ) {
                $general_info[] = array(
                    'title' => $general_infos['title'],
                    'description' => $general_infos['description'],
                );    
            }
        }
        if(count($general_info) > 1){
            $input['general_information'] = json_encode($general_info);
        }else{
            unset($input['general_information']);
        }
        if($request->has('feature_img')) {

            $image =  $request->file('feature_img');

            $imageName = time().'.'.request()->feature_img->getClientOriginalExtension();
            
            $image->storeAs('images/itinerary/featureImages', $imageName);
            
            $input['feature_img'] = $imageName;

        }
        if($request->has('gallery_img')) {

            $gallery_images =  $request->file('gallery_img');
            $images_name = array();
            foreach($gallery_images as $gallery_image){
                $images_name[] = $gallery_image->getClientOriginalName();
                $imagesname = $gallery_image->getClientOriginalName();
                $gallery_image->storeAs('images/itinerary/galleryImages', $imagesname);
            }
            $input['gallery_img'] = json_encode($images_name);
        }
        if($request->has('map')) {

            $map =  $request->file('map');

            $mapName = time().'.'.request()->map->getClientOriginalExtension();
            
            $map->storeAs('images/itinerary/maps', $mapName);
            
            $input['map'] = $mapName;

        }
        if( $itinerary = Itinerary::create($input) ){
            if( isset( $request->destination_id )  ){
                $destination = Destination::find($request->destination_id);
                $itinerary->destinations()->sync($destination);
            }
            if(  isset( $request->activity_id ) ){
                $activity = Activity::find($request->activity_id);
                $itinerary->activities()->sync($activity);
            }
            if(count($input['schedule']) > 0 ){
                $schedules = array();
                foreach($input['schedule'] as $key=>$schedule){
                    if($schedule['from_date'] != '' && $schedule['to_date'] != ''){
                        $schedules[] = [
                            'itinerary_id' => $itinerary->id,
                            'from_date' => \Carbon\Carbon::createFromFormat($format, $schedule['from_date']),
                            'to_date'   =>\Carbon\Carbon::createFromFormat($format, $schedule['to_date']),
                        ];
                    }
                    
                }
                $itinerary = $itinerary->schedule()->insert($schedules);
            }
            
            $response = ['message' => 'Itinerary Added Successfully.', 'alert-type' => 'success'];
        }

        return redirect()->route('admin.itineraries.index')->with($response); 
    }

    public function edit(Itinerary $itinerary)
    {
        abort_unless(\Gate::allows('itinerary_edit'), 403);
        
        $destinations = Destination::all();
        $activities   = Activity::all();
        $itinerary = Itinerary::with(['destinations', 'activities', 'schedule'])->where('id',$itinerary->id)->first();
       // dd($itinerary);
        return view('admin.itineraries.edit', compact('itinerary', 'destinations', 'activities'));
    }

    public function update(UpdateItineraryRequest $request, Itinerary $itinerary)
    {
        abort_unless(\Gate::allows('itinerary_edit'), 403);

        $input = $request->all();
        $format = 'm/d/Y';
        $destination = new Destination();
        
        $input['slug'] = \Str::slug($request->title);
        $general_info = array();
        foreach($input['general_information'] as $general_infos){
    
            if ($general_infos['title'] != '' || $general_infos['description'] != '' ) {
                $general_info[] = array(
                    'title' => $general_infos['title'],
                    'description' => $general_infos['description'],
                );    
            }
        }
        if(count($general_info) > 1){
            $input['general_information'] = json_encode($general_info);
        }else{
            unset($input['general_information']);
        }
        if($request->has('feature_img')) {

            $image =  $request->file('feature_img');

            $imageName = time().'.'.request()->feature_img->getClientOriginalExtension();
            
            $image->storeAs('images/itinerary/featureImages', $imageName);
            
            $input['feature_img'] = $imageName;

        }
        if($request->has('map')) {

            $map =  $request->file('map');

            $mapName = time().'.'.request()->map->getClientOriginalExtension();
            
            $map->storeAs('images/itinerary/maps', $mapName);
            
            $input['map'] = $mapName;

        }
       
        if($request->has('gallery_img')) {

            $gallery_images =  $request->file('gallery_img');
            $images_name = array();
            foreach($gallery_images as $gallery_image){
                $images_name[] = $gallery_image->getClientOriginalName();
                $imagesname = $gallery_image->getClientOriginalName();
                $gallery_image->storeAs('images/itinerary/galleryImages', $imagesname);
            }
            $images_uploaded = $images_name;
            if( $request->has('gallery_upload_img') && $request->gallery_img !== '' ){
                $input['gallery_img'] = json_encode($request->gallery_upload_img);
                $images_uploaded = array_merge($images_name, $request->gallery_upload_img);
            }
            
            $input['gallery_img'] = json_encode($images_uploaded);
        }
        
        if( $itinerary->update($input) ){
            if( isset( $request->destination_id )  ){
                $destination = Destination::find($request->destination_id);
                $itinerary->destinations()->sync($destination);
            }
            if(  isset( $request->activity_id ) ){
                $activity = Activity::find($request->activity_id);
                $itinerary->activities()->sync($activity);
            }
            $delete_schedule = ItinerarySchedule::where('itinerary_id', $itinerary->id)->delete();
            if(count($input['schedule']) > 0 ){
                $schedules = array();
                
                    foreach($input['schedule'] as $key=>$schedule){
                        if( $schedule['from_date'] !=='' && $schedule['to_date'] !='' ){
                            $schedules[] = [
                                'itinerary_id' => $itinerary->id,
                                'from_date' => \Carbon\Carbon::createFromFormat($format, $schedule['from_date']),
                                'to_date'   =>\Carbon\Carbon::createFromFormat($format, $schedule['to_date']),
                            ];
                        } 
                    }
                  
                    
                $itinerary = $itinerary->schedule()->insert($schedules);
            }
            $response = ['message' => 'Itinerary Updated Successfully.', 'alert-type' => 'success'];
        }

        return redirect()->route('admin.itineraries.index')->with($response); 
    }

    public function show(Itinerary $itinerary)
    {
        abort_unless(\Gate::allows('itinerary_show'), 403);

        return view('admin.itineraries.show', compact('itinerary'));
    }

    public function destroy(Itinerary $itinerary)
    {

        abort_unless(\Gate::allows('itinerary_delete'), 403);

        $itinerary->delete();

        return back();
    }

    public function massDestroy(MassDestroyItineraryRequest $request)
    {
        $itineraries = new Itinerary();
        Itinerary::whereIn('id', request('ids'))->delete();

        return response(null, 204);
    }
}
