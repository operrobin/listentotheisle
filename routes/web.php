<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;

//Route::get('/', function() {
//    return redirect('/home');
//});
Route::get('/serve/audio.mp3', function() {
    \App\Helper\ServeFileHelper::serveFilePartial(public_path('assets/test.mp3', 'Nero Forte - Slipknot.mp3'));
});


/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function() {
        Route::prefix('admin-users')->name('admin-users/')->group(static function() {
            Route::get('/',                                             'AdminUsersController@index')->name('index');
            Route::get('/create',                                       'AdminUsersController@create')->name('create');
            Route::post('/',                                            'AdminUsersController@store')->name('store');
            Route::get('/{adminUser}/impersonal-login',                 'AdminUsersController@impersonalLogin')->name('impersonal-login');
            Route::get('/{adminUser}/edit',                             'AdminUsersController@edit')->name('edit');
            Route::post('/{adminUser}',                                 'AdminUsersController@update')->name('update');
            Route::delete('/{adminUser}',                               'AdminUsersController@destroy')->name('destroy');
            Route::get('/{adminUser}/resend-activation',                'AdminUsersController@resendActivationEmail')->name('resendActivationEmail');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function() {
        Route::get('/profile',                                      'ProfileController@editProfile')->name('edit-profile');
        Route::post('/profile',                                     'ProfileController@updateProfile')->name('update-profile');
        Route::get('/password',                                     'ProfileController@editPassword')->name('edit-password');
        Route::post('/password',                                    'ProfileController@updatePassword')->name('update-password');
    });
});


/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function() {
        Route::prefix('artists')->name('artists/')->group(static function() {
            Route::get('/',                                             'ArtistsController@index')->name('index');
            Route::get('/create',                                       'ArtistsController@create')->name('create');
            Route::post('/',                                            'ArtistsController@store')->name('store');
            Route::get('/{artist}/edit',                                'ArtistsController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'ArtistsController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{artist}',                                    'ArtistsController@update')->name('update');
            Route::delete('/{artist}',                                  'ArtistsController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function() {
        Route::prefix('song-collections')->name('song-collections/')->group(static function() {
            Route::get('/',                                             'SongCollectionsController@index')->name('index');
            Route::get('/create',                                       'SongCollectionsController@create')->name('create');
            Route::post('/',                                            'SongCollectionsController@store')->name('store');
            Route::get('/{songCollection}/edit',                        'SongCollectionsController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'SongCollectionsController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{songCollection}',                            'SongCollectionsController@update')->name('update');
            Route::delete('/{songCollection}',                          'SongCollectionsController@destroy')->name('destroy');
        });
    });
});


/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function() {
        Route::prefix('streamer-communities')->name('streamer-communities/')->group(static function() {
            Route::get('/',                                             'StreamerCommunitiesController@index')->name('index');
            Route::get('/create',                                       'StreamerCommunitiesController@create')->name('create');
            Route::post('/',                                            'StreamerCommunitiesController@store')->name('store');
            Route::get('/{streamerCommunity}/edit',                     'StreamerCommunitiesController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'StreamerCommunitiesController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{streamerCommunity}',                         'StreamerCommunitiesController@update')->name('update');
            Route::delete('/{streamerCommunity}',                       'StreamerCommunitiesController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function() {
        Route::prefix('conversations')->name('conversations/')->group(static function() {
            Route::get('/',                                             'ConversationsController@index')->name('index');
            Route::get('/create',                                       'ConversationsController@create')->name('create');
            Route::post('/',                                            'ConversationsController@store')->name('store');
            Route::get('/{conversation}/edit',                          'ConversationsController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'ConversationsController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{conversation}',                              'ConversationsController@update')->name('update');
            Route::delete('/{conversation}',                            'ConversationsController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function() {
        Route::prefix('conversation-interviews')->name('conversation-interviews/')->group(static function() {
            Route::get('/',                                             'ConversationInterviewsController@index')->name('index');
            Route::get('/create',                                       'ConversationInterviewsController@create')->name('create');
            Route::post('/',                                            'ConversationInterviewsController@store')->name('store');
            Route::get('/{conversationInterview}/edit',                 'ConversationInterviewsController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'ConversationInterviewsController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{conversationInterview}',                     'ConversationInterviewsController@update')->name('update');
            Route::delete('/{conversationInterview}',                   'ConversationInterviewsController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function() {
        Route::prefix('youtube-collections')->name('youtube-collections/')->group(static function() {
            Route::get('/',                                             'YoutubeCollectionsController@index')->name('index');
            Route::get('/create',                                       'YoutubeCollectionsController@create')->name('create');
            Route::post('/',                                            'YoutubeCollectionsController@store')->name('store');
            Route::get('/{youtubeCollection}/edit',                     'YoutubeCollectionsController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'YoutubeCollectionsController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{youtubeCollection}',                         'YoutubeCollectionsController@update')->name('update');
            Route::delete('/{youtubeCollection}',                       'YoutubeCollectionsController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function() {
        Route::prefix('word-static-pages')->name('word-static-pages/')->group(static function() {
            Route::get('/',                                             'WordStaticPagesController@index')->name('index');
            Route::get('/create',                                       'WordStaticPagesController@create')->name('create');
            Route::post('/',                                            'WordStaticPagesController@store')->name('store');
            Route::get('/{wordStaticPage}/edit',                        'WordStaticPagesController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'WordStaticPagesController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{wordStaticPage}',                            'WordStaticPagesController@update')->name('update');
            Route::delete('/{wordStaticPage}',                          'WordStaticPagesController@destroy')->name('destroy');
        });
    });
});

Route::get('/{vue}', function () {
    return view('frontend.pages.index');
})->where('vue', '.*');