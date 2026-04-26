<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Component Prefix
    |--------------------------------------------------------------------------
    |
    | The prefix used for all Hub UI components.
    | Components are accessed as <x-{prefix}::component-name>
    |
    */
    'prefix' => 'hub-ui',

    /*
    |--------------------------------------------------------------------------
    | Application Settings
    |--------------------------------------------------------------------------
    */
    'app' => [
        'name' => env('APP_NAME', 'Laravel'),
        'logo' => null,
        'dashboard_route' => 'dashboard',
    ],

    /*
    |--------------------------------------------------------------------------
    | Theme Settings
    |--------------------------------------------------------------------------
    |
    | Define your brand colors and the package derives all surface, border,
    | and text colors automatically per light/dark mode.
    |
    | Colors must be hex values (e.g., '#10b981').
    |
    */
    'theme' => [
        'default_mode' => 'light', // 'dark' or 'light'

        'colors' => [
            'primary'   => '#10b981',
            'secondary' => '#6366f1',
            'success'   => '#22c55e',
            'warning'   => '#f59e0b',
            'danger'    => '#ef4444',
            'info'      => '#3b82f6',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Layout Settings
    |--------------------------------------------------------------------------
    */
    'layout' => [
        'fonts' => [
            'body' => 'Inter',
            'heading' => 'Space Grotesk',
            'mono' => 'JetBrains Mono',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Sidebar Settings
    |--------------------------------------------------------------------------
    */
    'sidebar' => [
        'width' => 'w-28',
        'persistence' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Feature Toggles
    |--------------------------------------------------------------------------
    */
    'features' => [
        'toast' => true,
        'confirmation' => true,
        'navigate_fade' => true,
    ],
];
