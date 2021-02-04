<?php

/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Brackets\AdminAuth\Models\AdminUser::class, function (Faker\Generator $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->email,
        'password' => bcrypt($faker->password),
        'remember_token' => null,
        'activated' => true,
        'forbidden' => $faker->boolean(),
        'language' => 'en',
        'deleted_at' => null,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
    ];
});/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Artist::class, static function (Faker\Generator $faker) {
    return [
        'artist_name' => $faker->sentence,
        'artist_description' => $faker->sentence,
        'artist_type' => $faker->sentence,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\SongCollection::class, static function (Faker\Generator $faker) {
    return [
        'song_name' => $faker->sentence,
        'song_description' => $faker->sentence,
        'artist_id' => $faker->sentence,
        'soundcloud_url' => $faker->sentence,
        'mixcloud_url' => $faker->sentence,
        'website_url' => $faker->sentence,
        'published_at' => $faker->dateTime,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\StreamerCommunity::class, static function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
        'streamer_name' => $faker->sentence,
        'description' => $faker->text(),
        'twitch_url' => $faker->sentence,
        'soundcloud_url' => $faker->sentence,
        'mixcloud_url' => $faker->sentence,
        'website_url' => $faker->sentence,
        'published_at' => $faker->dateTime,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Conversation::class, static function (Faker\Generator $faker) {
    return [
        'artist_name' => $faker->sentence,
        'short_description' => $faker->text(),
        'long_description' => $faker->text(),
        'interview_by' => $faker->sentence,
        'photography_by' => $faker->sentence,
        'published_at' => $faker->dateTime,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\ConversationInterview::class, static function (Faker\Generator $faker) {
    return [
        'conversation_id' => $faker->sentence,
        'question' => $faker->text(),
        'answer' => $faker->text(),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\YoutubeCollection::class, static function (Faker\Generator $faker) {
    return [
        'artist_id' => $faker->sentence,
        'created_at' => $faker->dateTime,
        'short_description' => $faker->text(),
        'title' => $faker->sentence,
        'updated_at' => $faker->dateTime,
        'youtube_url' => $faker->sentence,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\WordStaticPage::class, static function (Faker\Generator $faker) {
    return [
        'content' => $faker->sentence,
        'created_at' => $faker->dateTime,
        'slug' => $faker->unique()->slug,
        'updated_at' => $faker->dateTime,
        
        
    ];
});
