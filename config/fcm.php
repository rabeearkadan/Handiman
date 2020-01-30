<?php

return [
    'driver' => env('FCM_PROTOCOL', 'http'),
    'log_enabled' => false,

    'http' => [
        'server_key' => 'AAAAoMpgz7g:APA91bF03zGkEHDAwMlxqNuDpFE-O46v46HLsuoTfPV9g6teSA16CHzX59m5Frt2lKRThz94D9lfg7kOfTR_zYfrO6bihvgyrCtHcy19kGZTp5SL3lMoYgFI12FEJTB4D_9P90-Gzncq',
        'sender_id' => 'AIzaSyAN5uf7VhyJAIQbjNPT0AKcuCWqo3q2BG4',
        'server_send_url' => 'https://fcm.googleapis.com/fcm/send',
        'server_group_url' => 'https://android.googleapis.com/gcm/notification',
        'timeout' => 30.0, // in second
    ],
];
