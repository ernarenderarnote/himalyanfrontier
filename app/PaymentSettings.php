<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentSettings extends Model
{
    use SoftDeletes;
    
    protected $table = 'payment_settings';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'bank_changes',
        'partial_payment',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
