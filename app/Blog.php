<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'user_id',
        'slug',
        'description',
        'thumbnails',
        'gallery_img',
		'is_active',
		'created_at',
        'updated_at',
        'deleted_at',
    ];
}