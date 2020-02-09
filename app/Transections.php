<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transections extends Model
{
    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'booking_id',
        'order_id',
        'billing_name',
        'billing_address',
        'city',
        'state',
        'zip',
        'country',
        'telephone',
        'email',
        'trans_date',
        'tracking_id',
        'order_id',
        'bank_ref_no',
        'order_status',
        'payment_mode',
        'card_name',
        'currency',
        'mer_amount',
		'created_at',
        'updated_at',
        'deleted_at',
    ];
	
}