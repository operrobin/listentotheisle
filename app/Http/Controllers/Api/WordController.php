<?php
namespace App\Http\Controllers\Api;

use App\Helper\BaseResponse;
use App\Models\Artist;
use App\Models\StreamerCommunity;
use App\Http\Controllers\Controller;

use App\Models\WordStaticPage;

class WordController extends Controller
{

    public function getWord($slug) {

        $word = WordStaticPage::where('slug', $slug)->first();


        if ($word) {
            return BaseResponse::ok($word);
        }

        return BaseResponse::error('Word not found', 404);
        
    }

}