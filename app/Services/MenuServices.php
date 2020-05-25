<?php
namespace App\Services;

use App\user;
use App\Itinerary;
use Auth;

class MenuServices {

	public function activities(){
		$itineraries = Itinerary::with('activities','destinations')
            ->where('deleted_at',NULL)
            ->where('status','active')
            ->get();
        $results = array();
        foreach($itineraries as $itinerary){
            if(isset($itinerary->destinations)){
                foreach($itinerary->destinations as $key=>$destination){
                    $results[$destination->title][] = $itinerary->activities; 
                }
            }
        }
        $data = array();
        foreach($results as $key=>$v){
            foreach($v as $k){
               foreach($k as $n){
                    $data[$key][$n->title] = $n->slug;
               }
            }
        }

       return $data;
       
	}

    public function fixedDeparture(){
        $itinerary = Itinerary::where('fixed_diparture','1')
            ->where('deleted_at',NULL)
            ->get(['title','slug']);
        
        return $itinerary;
    }

    public function hotDeals(){
        $itinerary = Itinerary::where('hot_deal','1')
            ->where('deleted_at',NULL)
            ->get(['title','slug']);
        
        return $itinerary;
    }
}
