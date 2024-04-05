<?php

return [
    'name' => env('APP_NAME'),
    'manifest' => [
        'name' => env('APP_NAME', 'CESI Ton Job'),
        'short_name' => 'CTJ',
        'start_url' => '/',
        'background_color' => '#ffffff',
        'theme_color' => '#000000',
        'display' => 'standalone',
        'orientation'=> 'any',
        'status_bar'=> 'black',
        'icons' => [
            '72x72' => [
                'path' => '/images/icons/icon-72x72.png',
                'purpose' => 'any maskable'
            ],
            '96x96' => [
                'path' => '/images/icons/icon-96x96.png',
                'purpose' => 'any'
            ],
            '128x128' => [
                'path' => '/images/icons/icon-128x128.png',
                'purpose' => 'any'
            ],
            '144x144' => [
                'path' => '/images/icons/icon-144x144.png',
                'purpose' => 'any'
            ],
            '152x152' => [
                'path' => '/images/icons/icon-152x152.png',
                'purpose' => 'any'
            ],
            '192x192' => [
                'path' => '/images/icons/icon-192x192.png',
                'purpose' => 'any'
            ],
            '384x384' => [
                'path' => '/images/icons/icon-384x384.png',
                'purpose' => 'any'
            ],
            '512x512' => [
                'path' => '/images/icons/icon-512x512.png',
                'purpose' => 'any'
            ]
        ],
        'shortcuts' => [
            [
                'name' => 'Offres',
                'description' => 'Accéder aux offres de stage et d\'emploi',
                'url' => '/offer'
            ],
            [
                'name' => 'Profile',
                'description' => 'Accéder à votre profile',
                'url' => '/profile'
            ]
        ],
        'custom' => []
    ]
];
