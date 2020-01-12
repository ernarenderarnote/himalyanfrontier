<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Destination;
use App\Activity;
use App\ItinerarySchedule;

class Itinerary extends Model
{
    use SoftDeletes;

    protected $table = 'itineraries';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'price',
        'slug',
        'created_at',
        'updated_at',
        'deleted_at',
        'description',
        'quick_look',
        "detailed_itinerary",
        "costs",
        "cost_include",
        "cost_exclude",
        "map",
        "general_information",
        "activity_points",
        "highlights",
        "hot_deal",
        "fixed_diparture",
        "status",
        'feature_img',
        'gallery_img',
        'subtitle',
        'rating',
    ];

    public function destinations()
    {
        return $this->belongsToMany(Destination::class);
    }

    public function activities()
    {
        return $this->belongsToMany(Activity::class);
    }

    public function schedule()
    {
    	return $this->hasMany(ItinerarySchedule::class);
    }
}
