<?php

namespace App\Models;

use Brackets\Media\HasMedia\AutoProcessMediaTrait;
use Brackets\Media\HasMedia\HasMediaCollectionsTrait;
use Brackets\Media\HasMedia\HasMediaThumbsTrait;
use Brackets\Media\HasMedia\ProcessMediaTrait;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;

class SongCollection extends Model implements HasMedia
{

    use ProcessMediaTrait;
    use AutoProcessMediaTrait;
    use HasMediaCollectionsTrait;
    use HasMediaThumbsTrait;

    public function registerMediaCollections()
    {
        $this->addMediaCollection('song_file')
            ->maxFilesize(60*1024*1024)
            ->accepts('audio/mpeg');
    }

    protected $fillable = [
        'song_name',
        'song_description',
        'artist_id',
        'soundcloud_url',
        'mixcloud_url',
        'website_url',
        'published_at',

    ];


    protected $dates = [
        'published_at',
        'created_at',
        'updated_at',

    ];

    protected $appends = ['resource_url', 'song_url'];

    /* ************************ ACCESSOR ************************* */


    public function getSongUrlAttribute()
    {
        return url($this->getMedia('song_file')->first()->getUrl());
    }

    public function getResourceUrlAttribute()
    {
        return url('/admin/song-collections/'.$this->getKey());
    }

    public function Artist() {
        return $this->hasOne('App\Models\Artist', 'id', 'artist_id');
    }
}
