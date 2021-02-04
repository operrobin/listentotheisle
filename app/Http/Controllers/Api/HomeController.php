<?php
namespace App\Http\Controllers\Api;

use App\Helper\BaseResponse;
use App\Models\Artist;
use App\Models\StreamerCommunity;
use App\Models\Conversation;
use App\Models\ConversationInterview;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    public function home() {

        $artistMix = Artist::where('artist_type', Artist::MIXTAPE)->whereHas('Songs')->orderBy('id','desc')->limit(4)->get();

        $artisHead = Artist::where('artist_type', Artist::LIST_OF_HEAD)->whereHas('Youtube')->orderBy('id','desc')->limit(4)->get();

        $artisAll = Artist::whereHas('Songs')->orWhereHas('Youtube')->orderBy('id','desc')->limit(4)->get();

        $conversation = Conversation::orderBy('id', 'desc')->limit(2)->get();

        $artistMix->load('Songs');
        $artisHead->load('Youtube');
        $artisAll->load('Songs', 'Youtube');



        return BaseResponse::ok([
            'mix' => $artistMix,
            'head' => $artisHead,
            'all' => $artisAll,
            'conversation' => $conversation
        ]);
    }

    public function mixTape() {
        $artistMix = Artist::where('artist_type', Artist::MIXTAPE)->whereHas('Songs')->orderBy('id','desc')->paginate(16);

        $artistMix->load('Songs');

        return BaseResponse::ok($artistMix);
    }

    public function listOnHead() {
        $artisHead = Artist::where('artist_type', Artist::LIST_OF_HEAD)->whereHas('Youtube')->orderBy('id','desc')->paginate(16);

        $artisHead->load('Youtube');
        return BaseResponse::ok($artisHead);
    }

    public function community() {
        $streamer = StreamerCommunity::orderBy('id', 'desc')->paginate(16);

        return BaseResponse::ok($streamer);
    }

    public function conversation() {
        $conversation = Conversation::orderBy('id', 'DESC')->paginate(20);

        return BaseResponse::ok($conversation);
    }

    public function conversationDetail($id) {
        $conversation = Conversation::find($id);

        if ($conversation) {
            $conversation->load('Interviews');

            return BaseResponse::ok($conversation);
        }

        return BaseResponse::error('Conversation Not Found', 404);
    }

    public function mixTapeSong() {
        $artistMix = Artist::where('artist_type', Artist::MIXTAPE)->whereHas('Songs')->orderBy('id', 'desc')->get();

        $artistMix->load('Songs');

        return BaseResponse::ok($artistMix);
    }

}
