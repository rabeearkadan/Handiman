<?php

return [
    'driver' => env('FCM_PROTOCOL', 'http'),
    'log_enabled' => false,

    'http' => [
        'server_key' => 'AAAAnAeGVHo:APA91bH4xmyS31G9CFPQ5zDozIx79HaL3lE4IKVzPIfFY2VjumXsf8ybfI6aoJOsK-_f5bCHqSNW3fTbe8uvC_ELeAGVqP3nqSvvDxP-mxVePY8viM-6Vy3wrzUtWhek1nxJFmFB2j_G',
        'sender_id' => '670141142138',
        'server_send_url' => 'https://fcm.googleapis.com/fcm/send',
        'server_group_url' => 'https://android.googleapis.com/gcm/notification',
        'timeout' => 30.0, // in second
    ],
];
