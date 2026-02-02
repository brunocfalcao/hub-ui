<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Component Prefix
    |--------------------------------------------------------------------------
    |
    | The prefix used for all UI Skeleton components.
    | Components are accessed as <x-{prefix}::component-name>
    | Default: 'ui' -> <x-ui::button>, <x-ui::card>, etc.
    |
    */
    'prefix' => 'ui',

    /*
    |--------------------------------------------------------------------------
    | Application Settings
    |--------------------------------------------------------------------------
    |
    | Configure application-level settings for the UI components.
    |
    */
    'app' => [
        // Application name (used in layouts)
        'name' => env('APP_NAME', 'Laravel'),

        // Custom logo component path (e.g., 'components.my-logo')
        // If null, uses the default UI Skeleton logo
        'logo' => null,

        // Dashboard route name for logo link
        'dashboard_route' => 'dashboard',
    ],

    /*
    |--------------------------------------------------------------------------
    | Theme Settings
    |--------------------------------------------------------------------------
    |
    | Configure the color theme for the UI components.
    | Colors use Tailwind CSS color names.
    |
    */
    'theme' => [
        // Primary accent color (emerald, blue, indigo, purple, etc.)
        'primary' => 'emerald',
    ],

    /*
    |--------------------------------------------------------------------------
    | Feature Toggles
    |--------------------------------------------------------------------------
    |
    | Enable or disable specific features in the dashboard layout.
    |
    */
    'features' => [
        // Toast notification system
        'toast' => true,

        // Confirmation modal system
        'confirmation' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Sidebar Settings
    |--------------------------------------------------------------------------
    |
    | Configure the sidebar component behavior.
    |
    */
    'sidebar' => [
        // Width class (Tailwind width class)
        'width' => 'w-28',

        // Enable localStorage persistence for accordion state
        'persistence' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Layout Settings
    |--------------------------------------------------------------------------
    |
    | Configure the dashboard layout.
    |
    */
    'layout' => [
        // Font families (Google Fonts URLs will be generated)
        'fonts' => [
            'body' => 'Inter',
            'heading' => 'Space Grotesk',
            'mono' => 'JetBrains Mono',
        ],

        // Background colors (CSS hex values)
        'colors' => [
            'body' => '#1a1e2e',
            'sidebar' => '#151820',
            'card' => '#1a2332',
        ],
    ],
];
