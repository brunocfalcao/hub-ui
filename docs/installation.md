# Installation

## Requirements

- PHP 8.2 or higher
- Laravel 11.x or 12.x
- Alpine.js 3.x (with collapse plugin)
- Tailwind CSS 3.x

## Install via Composer

```bash
composer require brunocfalcao/ui-skeleton
```

The package uses Laravel's auto-discovery, so the service provider is registered automatically.

## Publish Configuration

```bash
php artisan vendor:publish --tag=ui-skeleton-config
```

This creates `config/ui-skeleton.php` where you can customize the package behavior.

## Optional: Publish Views

If you need to customize the component templates:

```bash
php artisan vendor:publish --tag=ui-skeleton-views
```

Views will be published to `resources/views/vendor/ui-skeleton/`.

## Optional: Publish Assets

To publish CSS and JavaScript files for customization:

```bash
php artisan vendor:publish --tag=ui-skeleton-assets
```

Assets will be published to `resources/css/vendor/ui-skeleton/` and `resources/js/vendor/ui-skeleton/`.

## JavaScript Setup

### Option 1: Import modules (recommended)

```javascript
// resources/js/app.js
import { initToast, initConfirmation } from './vendor/ui-skeleton/ui-skeleton.js';
import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';

// Initialize Alpine
Alpine.plugin(collapse);
window.Alpine = Alpine;
Alpine.start();

// Initialize UI Skeleton modules
document.addEventListener('DOMContentLoaded', function() {
    initToast();
    initConfirmation();
});

// If using Turbo:
document.addEventListener('turbo:load', function() {
    initToast();
    initConfirmation();
});
```

### Option 2: Copy the modules

If you don't want to publish assets, copy the JavaScript files directly:

```bash
cp vendor/brunocfalcao/ui-skeleton/resources/js/modules/*.js resources/js/modules/
cp vendor/brunocfalcao/ui-skeleton/resources/js/ui-skeleton.js resources/js/
```

## Tailwind CSS Configuration

Some components use dynamic Tailwind classes. Add this to your `tailwind.config.js`:

```javascript
// tailwind.config.js
module.exports = {
    content: [
        // ... your existing content paths
        './vendor/brunocfalcao/ui-skeleton/resources/views/**/*.blade.php',
    ],
    safelist: [
        // For <x-ui::status> component
        { pattern: /^(bg|text)-(red|green|blue|yellow|gray|emerald|amber)-(300|400|500)$/ },
    ],
}
```

## Alpine.js Collapse Plugin

The sidebar accordion requires the Alpine.js collapse plugin:

```bash
npm install @alpinejs/collapse
```

```javascript
// resources/js/app.js
import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';

Alpine.plugin(collapse);
window.Alpine = Alpine;
Alpine.start();
```

## Verify Installation

Create a test route to verify everything works:

```php
// routes/web.php
Route::get('/ui-test', function () {
    return view('ui-test');
});
```

```blade
{{-- resources/views/ui-test.blade.php --}}
<x-ui::layouts.dashboard title="UI Test">
    <x-slot:sidebar>
        <x-ui::sidebar>
            <x-ui::sidebar.link href="/" :active="true">
                <x-slot:icon>
                    <svg class="w-full h-full" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                </x-slot:icon>
                Home
            </x-ui::sidebar.link>
        </x-ui::sidebar>
    </x-slot:sidebar>

    <x-ui::page-header title="UI Test" description="Testing UI Skeleton components" />

    <x-ui::card title="Test Card">
        <x-ui::alert type="success">
            UI Skeleton is working correctly!
        </x-ui::alert>

        <div class="mt-4">
            <x-ui::button onclick="window.showToast('Hello!', 'success')">
                Show Toast
            </x-ui::button>
        </div>
    </x-ui::card>
</x-ui::layouts.dashboard>
```

Visit `/ui-test` to verify the installation.
