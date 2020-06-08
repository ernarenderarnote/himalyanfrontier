<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyItineraryRequest;
use App\Http\Requests\StoreItineraryRequest;
use App\Http\Requests\UpdateItineraryRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Itinerary;
use App\Destination;
use App\Activity;
use App\ItinerarySchedule;

class ItinerariesController extends Controller
{
    public function index(Request $request)
    {
        abort_unless(\Gate::allows('itinerary_access'), 403);
        $activities = Activity::all();
        $itinerary_type = '';
        if($request->has('itinerary_type') ){
            if($request->itinerary_type == 'introduction'){
                $itineraries = Itinerary::with('destinations','activities','currency')
                ->where('is_homepage','1')
                ->where('widget_section','introduction')
                ->orderBy('homepage_position', 'asc')
                ->get();
                $itinerary_type = 'introduction';
            }
            elseif($request->itinerary_type == 'hot_deal'){
                $itineraries = Itinerary::with('destinations','activities','currency')
                ->where('hot_deal','1')
                ->get();
                $itinerary_type = 'hot_deal';
            }
            elseif($request->itinerary_type == 'fixed_departure'){
                $itineraries = Itinerary::with('destinations','activities','currency')
                ->where('fixed_diparture','1')
                ->where('is_homepage','1')
                ->where('widget_section','fixed_departure')
                ->orderBy('homepage_position', 'asc')
                ->get();
                $itinerary_type = 'fixed_departure';
            }
            elseif($request->itinerary_type == 'upcoming_programs'){
                $itineraries = Itinerary::whereHas('schedule', function($query){
                    $query->where('from_date', '>', date('Y-m-d'));
                    })
                ->with('destinations','activities','currency')
                ->where('is_homepage','1')
                ->where('widget_section','upcoming')
                ->orderBy('homepage_position', 'asc')
                ->get();
                $itinerary_type = 'upcoming_programs';
            }else{
                $itineraries = Itinerary::with('destinations','activities','currency')->get();
            }
        }else{
            $itineraries = Itinerary::with('destinations','activities','currency')->get();
        }
        
        return view('admin.itineraries.index', compact('itineraries','itinerary_type','activities'));
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
        dd($input['general_information']);
        foreach($input['general_information'] as $general_infos){
            if ( isset($general_infos['title']) || isset($general_infos['description']) ) {
                if ($general_infos['title'] != '' || $general_infos['description'] != '' ) {
                    $general_info[] = array(
                        'title' => $general_infos['title'],
                        'description' => $general_infos['description'],
                    );    
                }
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
        $itinerary = Itinerary::with(['destinations', 'activities', 'schedule', 'currency'])->where('id',$itinerary->id)->first();
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
            if ( isset($general_infos['title']) || isset($general_infos['description']) ) {
                if($general_infos['title'] != '' || $general_infos['description'] != ''){
                    $general_info[] = array(
                        'title' => $general_infos['title'],
                        'description' => $general_infos['description'],
                    );  
                }    
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

    public function scheduleDestroy(Request $request){
        $itinerarySchedule = new ItinerarySchedule();
        ItinerarySchedule::where('id', $request->id )->delete();
        return response(null, 204);
    }
    
    public function homepageItineraryPosition(Request $request){
        if($request->filter_type == 'homepage'){
            foreach ($request->order as $order) {
                $itineray = Itinerary::where("id", $order['id'])->first();
                $itineray->homepage_position = $order['position'];
                $itineray->save();
            }
        }
        if($request->filter_type == 'activity'){
            foreach ($request->order as $order) {
                $itineray = Itinerary::where("id", $order['id'])->first();
                $itineray->search_position = $order['position'];
                $itineray->save();
            } 
        }    
       
        return response(['status' => 'success']);
    }

    public function itineraryFilter(Request $request, $type= null){
        $activities = Activity::all();
        $itinerary_type = '';
        $filter_type    = $request->filter_type;
        if(!empty($type) ){
            if($request->filter_type == "homepage"){
                if($type == 'introduction'){
                    $itineraries = Itinerary::with('destinations','activities','currency')
                    ->where('is_homepage','1')
                    ->where('widget_section','introduction')
                    ->orderBy('homepage_position', 'asc')
                    ->get();
                    $itinerary_type = 'introduction';
                }
                elseif($type == 'hot_deal'){
                    $itineraries = Itinerary::with('destinations','activities','currency')
                    ->where('hot_deal','1')
                    ->get();
                    $itinerary_type = 'hot_deal';
                }
                elseif($type == 'fixed-departure'){
                    $itineraries = Itinerary::with('destinations','activities','currency')
                    ->where('fixed_diparture','1')
                    ->where('is_homepage','1')
                    ->where('widget_section','fixed_departure')
                    ->orderBy('homepage_position', 'asc')
                    ->get();
                    $itinerary_type = 'fixed-departure';
                }
                elseif($type == 'upcoming-programs'){
                    $itineraries = Itinerary::with('destinations','activities','currency')
                    ->where('deleted_at',NULL)
                    ->where('status','active')
                    ->where('is_homepage','1')
                    ->where('widget_section','upcoming')
                    ->orderBy('homepage_position', 'asc')
                    ->get();
                    $itinerary_type = 'upcoming-programs';
                }else{
                    $itineraries = Itinerary::with('destinations','activities','currency')->get();
                }
            }elseif($request->filter_type =="activity" ){
                $activity = Activity::with('itinerary')->where('slug',$type)->first();
                $all_itinerary = $activity->itinerary;
                if($all_itinerary){
                    $itinerary_ids = array();
                    foreach($all_itinerary as $itinerary){
                        $itinerary_ids[] = $itinerary->id;
                    }
                    $itineraries = Itinerary::with('destinations','activities','currency')
                        ->whereIn('id',$itinerary_ids)
                        ->orderBy('search_position', 'asc')
                        ->get();
                    $itinerary_type = $type;    
                }else{
                    $itinerary_type = '';
                    $itineraries = '';
                }
            }else{
                $itineraries = Itinerary::with('destinations','activities','currency')->get();
                return redirect()->route('admin.itineraries.index', compact('itineraries'));
            }    
        }else{
            $itineraries = Itinerary::with('destinations','activities','currency')->get();
        }
        
        return view('admin.itineraries.index', compact('itineraries','itinerary_type','activities','filter_type'));
    }

    
}
