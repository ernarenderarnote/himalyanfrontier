<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'user_id',
        'itinerary_id',
        'schedule_id',
        'booking_id',
        'name',
        'email',
        'mobile',
        'gender',
        'height',
        'weight',
        'address',
        'state',
        'city',
        'pin_code',
        'source',
        'travelexperiance',
        'currency_id',
        'activity_price',
        'payment_percentage',
        'actual_currency',
        'payment_paid',
        'remaining_payment',
        'booking_status',
        'payment_status',
		'created_at',
        'updated_at',
        'deleted_at',
    ];
	
}