<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DirectPayment extends Model
{
    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'first_name',
        'last_name',
        'email_address',
        'country_id',
        'state',
        'city',
        'zip_code',
        'phone_number',
        'address',
        'currency',
        'amount',
        'status',
    ];
}
