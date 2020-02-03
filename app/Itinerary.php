<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Destination;
use App\Activity;
use App\ItinerarySchedule;
use App\Currency;

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
        'currency_id'
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

    public function getConvertedPriceAttribute() {
        $price = $this->price;
        $selected_currency = session()->get('selected_currency');
        if( $selected_currency ){
            $price = $this->getExchangeRate($selected_currency);
        }
        return round($price, 2);

    }

    public function getExchangeRate($currency_code){
        $currency = Currency::where('code',$currency_code)->first();
        return $this->price * $currency->exchange_rate; 
    }
    
    public function getCurrencySymbolAttribute()
    {
        $symbol = Currency::where('id', $this->currency_id)->first()->symbol;
        $selected_currency = session()->get('selected_currency');
        if( $selected_currency ){
            $currency = Currency::where('code',$selected_currency)->first();
            $symbol   = $currency->symbol;
           
        }
        return $symbol;
    }

    public function getConvertedCurrencyIdAttribute()
    {
        $currency_id = Currency::where('id', $this->currency_id)->first()->id;
        $selected_currency = session()->get('selected_currency');
        if( $selected_currency ){
            $currency = Currency::where('code',$selected_currency)->first();
            $symbol   = $currency->id;
           
        }
        return $currency_id;
    }

    public function currency()
    {
    	return $this->hasOne(Currency::class,'id', 'currency_id');
    } 
}
