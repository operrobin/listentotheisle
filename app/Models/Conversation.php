<?php

namespace App\Models;

use DB;

use Brackets\Media\HasMedia\AutoProcessMediaTrait;
use Brackets\Media\HasMedia\HasMediaCollectionsTrait;
use Brackets\Media\HasMedia\HasMediaThumbsTrait;
use Brackets\Media\HasMedia\ProcessMediaTrait;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\Models\Media;

class Conversation extends Model implements HasMedia
{
    use ProcessMediaTrait;
    use AutoProcessMediaTrait;
    use HasMediaCollectionsTrait;
    use HasMediaThumbsTrait;

    protected $fillable = [
        'artist_name',
        'short_description',
        'long_description',
        'interview_by',
        'photography_by',
        'published_at',
    ];

    public function registerMediaCollections()
    {
        $this->addMediaCollection('gallery')
            ->maxNumberOfFiles(30)
            ->accepts('image/*');

        $this->addMediaCollection('thumbnail')
            ->accepts('image/*');
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->autoRegisterThumb200();

        $this->addMediaConversion('thumbnail')
            ->fit(Manipulations::FIT_CROP, 100, 100);

        $this->addMediaConversion('portrait')
            ->fit(Manipulations::FIT_CROP, 400, 712);

        $this->addMediaConversion('landscape')
            ->fit(Manipulations::FIT_CROP, 712, 400);

    }

    protected $dates = [
        'published_at',
        'created_at',
        'updated_at',

    ];

    protected $appends = [
        'resource_url',
        'landscape_url',
        'portrait_url',
        'thumbnail_url',
        'rank'
    ];

    public function getRankAttribute() {
        //SELECT id, artist_name, artist_type, FIND_IN_SET(id, (SELECT GROUP_CONCAT(id) FROM artists where artist_type='mixtape')) as `rank` FROM artists where artist_type='mixtape';
        $rank = DB::table('conversations')
            ->selectRaw("FIND_IN_SET(id, (SELECT GROUP_CONCAT(id) FROM conversations)) as `rank`")
            ->where('id', $this->id)
            ->first();


        $text = 'Conversation #';
        return $text . $rank->rank;
    }

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/conversations/'.$this->getKey());
    }

    public function Interviews() {
        return $this->hasMany('App\Models\ConversationInterview', 'conversation_id', 'id');
    }

    public function getPortraitUrlAttribute() {
        $url = [];

        foreach($this->getMedia('gallery') as $gallery) {
            array_push($url, $gallery->getUrl('portrait'));
        }

        return $url;
    }

    public function getLandscapeUrlAttribute() {
        $url = [];

        foreach($this->getMedia('gallery') as $gallery) {
            array_push($url, $gallery->getUrl('landscape'));
        }

        return $url;
    }

    public function getThumbnailUrlAttribute() {
        $media = $this->getMedia('thumbnail')->first();

        if ($media) {
            return url($media->getUrl());
        }

        return null;
    }
}
