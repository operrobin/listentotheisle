<?php

return [
    'admin-user' => [
        'title' => 'Users',

        'actions' => [
            'index' => 'Users',
            'create' => 'New User',
            'edit' => 'Edit :name',
            'edit_profile' => 'Edit Profile',
            'edit_password' => 'Edit Password',
        ],

        'columns' => [
            'id' => 'ID',
            'first_name' => 'First name',
            'last_name' => 'Last name',
            'email' => 'Email',
            'password' => 'Password',
            'password_repeat' => 'Password Confirmation',
            'activated' => 'Activated',
            'forbidden' => 'Forbidden',
            'language' => 'Language',

            //Belongs to many relations
            'roles' => 'Roles',

        ],
    ],

    'artist' => [
        'title' => 'Artists',

        'actions' => [
            'index' => 'Artists',
            'create' => 'New Artist',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'record' => 'Record',
            'artist_name' => 'Artist name',
            'artist_description' => 'Artist description',
            'artist_type' => 'Artist type',

        ],
    ],

    'song-collection' => [
        'title' => 'Mixes',

        'actions' => [
            'index' => 'Mixes',
            'create' => 'New Mixes',
            'edit' => 'Edit :name',
            'will_be_published' => 'Mixes will be published at',
        ],

        'columns' => [
            'id' => 'ID',
            'song_name' => 'Song name',
            'song_description' => 'Song description',
            'artist_id' => 'Artist',
            'soundcloud_url' => 'Soundcloud url',
            'mixcloud_url' => 'Mixcloud url',
            'website_url' => 'Website url',
            'published_at' => 'Published at',

        ],
    ],

    'streamer-community' => [
        'title' => 'Folks',

        'actions' => [
            'index' => 'Folks',
            'create' => 'New Folks',
            'edit' => 'Edit :name',
            'will_be_published' => 'Folks will be published at',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'streamer_name' => 'Streamer name',
            'description' => 'Description',
            'twitch_url' => 'Twitch url',
            'soundcloud_url' => 'Soundcloud url',
            'mixcloud_url' => 'Mixcloud url',
            'website_url' => 'Website url',
            'published_at' => 'Published at',

        ],
    ],

    'conversation' => [
        'title' => 'Talks',

        'actions' => [
            'index' => 'Talks',
            'create' => 'New Talks',
            'edit' => 'Edit :name',
            'will_be_published' => 'Talks will be published at',
        ],

        'columns' => [
            'id' => 'ID',
            'artist_name' => 'Artist name',
            'short_description' => 'Short description',
            'long_description' => 'Long description',
            'interview_by' => 'Interview by',
            'photography_by' => 'Photography by',
            'published_at' => 'Published at',

        ],
    ],

    'conversation-interview' => [
        'title' => 'Talk Interviews',

        'actions' => [
            'index' => 'Talk Interviews',
            'create' => 'New Conversation Interview',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'conversation_id' => 'Conversation',
            'question' => 'Question',
            'answer' => 'Answer',

        ],
    ],

    'youtube-collection' => [
        'title' => 'Specials',

        'actions' => [
            'index' => 'Specials',
            'create' => 'New Specials',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'artist_id' => 'Artist',
            'short_description' => 'Short description',
            'title' => 'Title',
            'youtube_url' => 'Youtube url',

        ],
    ],

    'word-static-page' => [
        'title' => 'Word Static Pages',

        'actions' => [
            'index' => 'Word Static Pages',
            'create' => 'New Word Static Page',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'content' => 'Content',
            'slug' => 'Slug',

        ],
    ],

    // Do not delete me :) I'm used for auto-generation
];
