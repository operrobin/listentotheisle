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

class Artist extends Model implements HasMedia
{
    use ProcessMediaTrait;
    use AutoProcessMediaTrait;
    use HasMediaCollectionsTrait;
    use HasMediaThumbsTrait;


    public const MIXTAPE = 'mixtape';
    public const LIST_OF_HEAD = 'list_head';

    public function registerMediaCollections()
    {
        $this->addMediaCollection('gallery')
            ->accepts('image/*');
    }

    protected $fillable = [
        'artist_name',
        'artist_description',
        'artist_type',
        'record'
    ];

    public function registerMediaConversions(Media $media = null)
    {
        $this->autoRegisterThumb200();

        $this->addMediaConversion('album')
            ->fit(Manipulations::FIT_CROP, 100, 100);

        $this->addMediaConversion('portrait')
            ->fit(Manipulations::FIT_CROP, 400, 712);

        $this->addMediaConversion('landscape')
            ->fit(Manipulations::FIT_CROP, 712, 400);

    }


    protected $dates = [
        'created_at',
        'updated_at',

    ];

    protected $appends = [
        'resource_url',
        'image_url',
        'album_url',
        'portrait_url',
        'landscape_url',
        'rank'
    ];

    /* ************************ ACCESSOR ************************* */

    public function getRankAttribute() {
        //SELECT id, artist_name, artist_type, FIND_IN_SET(id, (SELECT GROUP_CONCAT(id) FROM artists where artist_type='mixtape')) as `rank` FROM artists where artist_type='mixtape';
        $rank = DB::table('artists')
            ->selectRaw("FIND_IN_SET(id, (SELECT GROUP_CONCAT(id) FROM artists where artist_type='" . $this->artist_type . "')) as `rank`")
            ->where('artist_type', $this->artist_type)
            ->where('id', $this->id)
            ->first();


        $text = '';

        switch ($this->artist_type) {
            case 'mixtape':
                $text = 'mixtape #';
            break;

            case 'list_head':
                $text = 'list in my head #';
            break;
        }

        return $text . $rank->rank;
    }

    public function getPortraitUrlAttribute() {
        $media = $this->getMedia('gallery')->first();

        if ($media) {
            return url($media->getUrl('portrait'));
        }

        return null;
    }

    public function getLandscapeUrlAttribute() {
        $media = $this->getMedia('gallery')->first();

        if ($media) {
            return url($media->getUrl('landscape'));
        }

        return null;
    }

    public function getImageUrlAttribute() {
        $media = $this->getMedia('gallery')->first();

        if ($media) {
            return url($media->getUrl());
        }

        return null;
    }

    public function getAlbumUrlAttribute() {
        $media = $this->getMedia('gallery')->first();

        if ($media) {
            return url($media->getUrl('album'));
        }

        return null;
    }

    public function getResourceUrlAttribute()
    {
        return url('/admin/artists/'.$this->getKey());
    }

    public function Songs() {
        return $this->hasMany('App\Models\SongCollection', 'artist_id', 'id');
    }

    public function Youtube() {
        return $this->hasMany('App\Models\YoutubeCollection', 'artist_id', 'id');
    }
}
