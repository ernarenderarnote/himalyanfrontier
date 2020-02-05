<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Itinerary;

class Activity extends Model
{
    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'slug',
        'description',
        'thumbnails',
        'gallery_img',
		'is_active',
		'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function itinerary()
    {
        return $this->belongsToMany(Itinerary::class);
    }
}