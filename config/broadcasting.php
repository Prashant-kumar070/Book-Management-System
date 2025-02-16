<?php
return [

'default' => env('BROADCAST_DRIVER', 'ably'),

'connections' => [

    'ably' => [
        'driver' => 'ably',
        'key' => env('ABLY_KEY'),
    ],

],

];
