<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cohensive\Embed\Facades\Embed;

class YoutubeSlider extends Model
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
        'thumbnail_url',
        'youtube_url'
    ];

    public function getEmbededVideoHtmlAttribute()
    {
        $embed = Embed::make($this->youtube_url)->parseUrl();

        if (!$embed)
            return '';

        $embed->setAttribute(['width' => 200]);
        return $embed->getHtml();
    }
}
