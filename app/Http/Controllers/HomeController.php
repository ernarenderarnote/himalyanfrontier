<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Builder;
use App\Itinerary;
use App\Destination;
use App\Activity;

class HomeController extends Controller
{
    private $destination;
    private $activity;
    private $itinerary_type;
    private $itinerary_date;
    private $grading;
    private $s;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->destination = '';
        $this->activity = '';
        $this->itinerary_type = '';
        $this->itinerary_date = '';
        $this->grading = '';
        $this->s = '';
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $itineraries   = Itinerary::with('destinations','activities')->where('deleted_at',NULL)->where('status','active')->orderBy('created_at', 'desc')->take(3)->get();
        $fixedPrograms = Itinerary::with('destinations','activities')->where('deleted_at',NULL)->where('status','active')->where('fixed_diparture', '1')->orderBy('created_at', 'desc')->take(6)->get();
        return view('index', compact('itineraries','fixedPrograms'));
    }

    public function activity(Request $request){
        $activity = Itinerary::with('destinations','activities','schedule')->where('slug',$request->slug)->first();
        $similar_tours = Itinerary::where('deleted_at',NULL)->where('status','active')->orderBy('created_at', 'desc')->take(3)->get();
        return view('single',compact('activity', 'similar_tours'));
    }

    public function advanedSearch(Request $request){
        $destination = '';
        $activity    = '';
        $itinerary_type_value = '';
        $itinerary_type = '';
        $itineraries = '';
        $ratingFrom  = '1';
        $ratingTo    = '4';
        $itinerary_date = '';
        $search = '';
        $destinations = Destination::all();
        $activities   = Activity::all();
        if($request->has('activity') ){
            if(!empty($request->activity )) {
                $activity = $request->activity;
            }  
        }
        if($request->has('destination') && $request->has('destination') !='' ){
            
            if(!empty($request->destination )) {
                $destination = $request->destination;
            }    
        }
        if($request->has('itinerary_type')){
            $itinerary_type = $request->itinerary_type;
            if($itinerary_type == 'fixed_departure' || $itinerary_type == 'hot_deal'){
                $itinerary_type_value = '1';
            }
        }
        if($request->has('date')){
            if(!empty($request->date )) {
                $itinerary_date = $request->date;
            }  
            
        }
        if($request->has('rating_from')){
            if(!empty($request->rating_from )) {
                $ratingFrom = $request->rating_from;
            }  
            
        }
        if($request->has('rating_to')){
            if(!empty($request->rating_to )) {
                $ratingTo = $request->rating_to;
            }  
            
        }
        if($request->has('s')){
            if(!empty($request->s )) {
                $search = $request->s;
            } 
        }

        $required_params = array('title','slug','price','activity_points','feature_img','rating');

        if($destination != '' && $activity !='' && $itinerary_date !='' ){
         
            $itineraries = Itinerary::with(['destinations', 'activities', 'schedule'])
                ->whereHas('destinations', function (Builder $query) use ($destination){
                    $query->where('slug', $destination);
                })->whereHas('activities', function (Builder $query) use ($activity){
                    $query->where('slug', $activity);
                })->whereHas('schedule', function (Builder $query) use ($itinerary_date){
                    $query->whereMonth('from_date', $itinerary_date);
                })->where(function($q) use($search) {
                    $q->orWhere('description', 'like', '%' . $search . '%')
                      ->orWhere('title', 'like', '%' . $search . '%');
                })->whereBetween('rating', [$ratingFrom, $ratingTo])
                ->get($required_params)
                ->paginate(10);

        }elseif($destination != '' && $activity !='' && $itinerary_date ==''){
            $itineraries = Itinerary::with(['destinations', 'activities', 'schedule'])
                ->whereHas('destinations', function (Builder $query) use ($destination){
                    $query->where('slug', $destination);
                })->whereHas('activities', function (Builder $query) use ($activity){
                    $query->where('slug', $activity);
                })->where(function($q) use($search) {
                    $q->orWhere('description', 'like', '%' . $search . '%')
                      ->orWhere('title', 'like', '%' . $search . '%');
                })
                ->whereBetween('rating', [$ratingFrom, $ratingTo])
                ->get($required_params)
                ->paginate(10);

        }elseif($destination == '' && $activity !='' && $itinerary_date !=''){
            
            $itineraries = Itinerary::with(['destinations', 'activities', 'schedule'])
                ->whereHas('activities', function (Builder $query) use ($activity){
                    $query->where('slug', $activity);
                })->whereHas('schedule', function (Builder $query) use ($itinerary_date){
                    $query->whereMonth('from_date', $itinerary_date);
                })->where(function($q) use($search) {
                    $q->orWhere('description', 'like', '%' . $search . '%')
                      ->orWhere('title', 'like', '%' . $search . '%');
                })
                ->whereBetween('rating', [$ratingFrom, $ratingTo])
                ->get($required_params)
                ->paginate(10);

        }elseif($destination != '' && $activity =='' && $itinerary_date !=''){
            
            $itineraries = Itinerary::with(['destinations', 'activities', 'schedule'])
                ->whereHas('destinations', function (Builder $query) use ($destination){
                    $query->where('slug', $destination);
                })->whereHas('schedule', function (Builder $query) use ($itinerary_date){
                    $query->whereMonth('from_date', $itinerary_date);
                })->where(function($q) use($search) {
                    $q->orWhere('description', 'like', '%' . $search . '%')
                      ->orWhere('title', 'like', '%' . $search . '%');
                })
                ->whereBetween('rating', [$ratingFrom, $ratingTo])
                ->get($required_params)
                ->paginate(10);

        }elseif($destination != '' && $activity == '' && $itinerary_date == ''){
            
            $itineraries = Itinerary::with(['destinations', 'activities', 'schedule'])
                ->whereHas('destinations', function (Builder $query) use ($destination){
                    $query->where('slug', $destination);
                })->where(function($q) use($search) {
                    $q->orWhere('description', 'like', '%' . $search . '%')
                      ->orWhere('title', 'like', '%' . $search . '%');
                })
                ->whereBetween('rating', [$ratingFrom, $ratingTo])
                ->get($required_params)
                ->paginate(10);

        }elseif($destination == '' && $activity != '' && $itinerary_date == ''){
            
            $itineraries = Itinerary::with(['destinations', 'activities', 'schedule'])
                ->whereHas('activities', function (Builder $query) use ($activity){
                    $query->where('slug', $activity);
                })->where(function($q) use($search) {
                    $q->orWhere('description', 'like', '%' . $search . '%')
                      ->orWhere('title', 'like', '%' . $search . '%');
                })
                ->whereBetween('rating', [$ratingFrom, $ratingTo])
                ->get($required_params)
                ->paginate(10);

        }elseif($destination == '' && $activity == '' && $itinerary_date != ''){
            
            $itineraries = Itinerary::with(['destinations', 'activities', 'schedule'])
                ->whereHas('schedule', function (Builder $query) use ($itinerary_date){
                    $query->whereMonth('from_date', $itinerary_date);
                })->where(function($q) use($search) {
                    $q->orWhere('description', 'like', '%' . $search . '%')
                      ->orWhere('title', 'like', '%' . $search . '%');
                })
                ->whereBetween('rating', [$ratingFrom, $ratingTo])
                ->get($required_params)
                ->paginate(10);

        }elseif($itinerary_type != ''){

            if($itinerary_type == 'fixed_departure'){
                $itinerary_type = 'fixed_diparture';
            }
            if($itinerary_type == 'hot_deal'){
                $hot_deal = 'hot_deal';
            }
            $itineraries = Itinerary::with(['destinations', 'activities'])
                ->where($itinerary_type, $itinerary_type_value)
                ->where(function($q) use($search) {
                    $q->orWhere('description', 'like', '%' . $search . '%')
                      ->orWhere('title', 'like', '%' . $search . '%');
                })
                ->whereBetween('rating', [$ratingFrom, $ratingTo])
                ->get($required_params)
                ->paginate(10);;

        }else{
            $itineraries = Itinerary::with(['destinations', 'activities'])
            ->where(function($q) use($search) {
                $q->orWhere('description', 'like', '%' . $search . '%')
                  ->orWhere('title', 'like', '%' . $search . '%');
            })
            ->get($required_params)->paginate(10);
        }
        $itineraries->appends(request()->all())->render();
        return view('advancedSearch', compact('itineraries', 'destinations', 'activities'));
    }
}
