<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConversationInterview extends Model
{
    protected $fillable = [
        'conversation_id',
        'question',
        'answer',
    ];


    protected $dates = [
        'created_at',
        'updated_at',

    ];

    public function talk() {
        return $this->belongsTo('App\Models\Conversation');
    }

    protected $appends = ['resource_url', 'artist_name'];

    /* ************************ ACCESSOR ************************* */

    public function getArtistNameAttribute() {
        $c = Conversation::find($this->conversation_id);

        if ($c) {
            return $c->artist_name;
        }

        return 'No Artist';

    }

    public function getResourceUrlAttribute()
    {
        return url('/admin/conversation-interviews/'.$this->getKey());
    }


}
