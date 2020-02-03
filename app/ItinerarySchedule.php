<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Itinerary;

class ItinerarySchedule extends Model
{
    use SoftDeletes;
    
    protected $table = 'itinerary_schedule';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'itinerary_id',
        'from_date',
        'to_date',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function itinerary()
    {
        return $this->belongsTo(Itinerary::class);
    }

}
