<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WordStaticPage extends Model
{
    protected $fillable = [
        'content',
        'slug',
    
    ];
    
    
    protected $dates = [
        'created_at',
        'updated_at',
    
    ];
    
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/word-static-pages/'.$this->getKey());
    }
}
