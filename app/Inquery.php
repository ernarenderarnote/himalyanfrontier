<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inquery extends Model
{
    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'itinerary_id',
        'name',
        'email',
		'phone',
		'subject',
		'message',
        'updated_at',
        'deleted_at',
    ];

    public function itinerary(){
        return $this->hasOne(Itinerary::class,'id', 'itinerary_id');
    }

    public function user(){
        return $this->hasOne(User::class,'id', 'user_id');
    }
}