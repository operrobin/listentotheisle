<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class YoutubeCollection extends Model
{
    protected $fillable = [
        'artist_id',
        'short_description',
        'title',
        'youtube_url',

    ];


    protected $dates = [
        'created_at',
        'updated_at',

    ];

    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/youtube-collections/'.$this->getKey());
    }

    public function Artist() {
        return $this->hasOne('App\Models\Artist', 'id', 'artist_id');
    }
}
