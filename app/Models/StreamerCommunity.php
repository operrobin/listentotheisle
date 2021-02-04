<?php

namespace App\Models;

use DB;

use Illuminate\Database\Eloquent\Model;
use Brackets\Media\HasMedia\AutoProcessMediaTrait;
use Brackets\Media\HasMedia\HasMediaCollectionsTrait;
use Brackets\Media\HasMedia\HasMediaThumbsTrait;
use Brackets\Media\HasMedia\ProcessMediaTrait;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\Models\Media;

class StreamerCommunity extends Model implements HasMedia
{

    use ProcessMediaTrait;
    use AutoProcessMediaTrait;
    use HasMediaCollectionsTrait;
    use HasMediaThumbsTrait;

    public function registerMediaCollections()
    {
        $this->addMediaCollection('gallery')
            ->accepts('image/*');
    }

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

    protected $fillable = [
        'name',
        'streamer_name',
        'description',
        'twitch_url',
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
    
    protected $appends = [
        'resource_url',
        'image_url',
        'portrait_url',
        'landscape_url',
        'rank'
    ];

    public function getRankAttribute() {
        //SELECT id, artist_name, artist_type, FIND_IN_SET(id, (SELECT GROUP_CONCAT(id) FROM artists where artist_type='mixtape')) as `rank` FROM artists where artist_type='mixtape';
        $rank = DB::table('streamer_communities')
            ->selectRaw("FIND_IN_SET(id, (SELECT GROUP_CONCAT(id) FROM streamer_communities)) as `rank`")
            ->where('id', $this->id)
            ->first();


        $text = 'Conversation #';
        return $text . $rank->rank;
    }

    /* ************************ ACCESSOR ************************* */


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
            return $media->getUrl();
        }

        return null;
    }

    public function getResourceUrlAttribute()
    {
        return url('/admin/streamer-communities/'.$this->getKey());
    }
}
