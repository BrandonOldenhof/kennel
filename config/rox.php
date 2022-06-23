<?php

return [
    /**
     * Determines if accessibility scanning should be enabled.
     * Setting this to true in the .env will run the aXe accessibility scanner on every page.
     * This significantly slows down the page load time.
     */
    'accessibility' => env('ACCESSIBILITY_SCANNING', env('APP_DEBUG') === true && env('APP_ENV') !== 'production'),

    /**
     * Determines if the application should display a basic auth prompt.
     * By default this is set to the value of APP_DEBUG.
     * Note: this will also run for local environments, unless disabled in the .env by setting the BASIC_AUTH key to false.
     * @link https://laravel.com/docs/authentication#http-basic-authentication
     */
    'basic_auth' => env('BASIC_AUTH', env('APP_DEBUG', true)),

    /**
     * Add a task to the Laravel Schedule to automatically optimize all images in the storage/app/public/images directory.
     */
    'image' => [
        'optimize' => env('IMAGE_OPTIMIZATION', false),
    ],

    'users' => [
        'rox' => env('USERS_ROX_PASSWORD'),
        'client' => env('USERS_CLIENT_PASSWORD'),
    ],

    /**
     * Contact the PM for account details and the license key. More info at: https://www.cookiebot.com/en/help/
     * Example key format: 00000000-0000-0000-0000-000000000000
     */
    'cookiebot' => env('COOKIEBOT_KEY', ''),

    /**
     * GTM & Google Tag manager
     * Example GTM format: GTM-XXXXX
     * Example GA format: G-XXXXXXXX
     */
    'google' => [
        'gtm' => env('GTM_TAG', ''),
        'ga' => env('GA_TAG', ''),
    ],
];
