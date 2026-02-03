# Installation

## Requirements

- PHP 8.2 or higher
- Laravel 11.x or 12.x
- Alpine.js 3.x (with collapse plugin)
- Tailwind CSS 3.x

## Install via Composer

```bash
composer require brunocfalcao/hub-ui
```

The package uses Laravel's auto-discovery, so the service provider is registered automatically.

## Publish Configuration

```bash
php artisan vendor:publish --tag=hub-ui-config
```

This creates `config/hub-ui.php` where you can customize the package behavior.

## Optional: Publish Views

If you need to customize the component templates:

```bash
php artisan vendor:publish --tag=hub-ui-views
```

Views will be published to `resources/views/vendor/hub-ui/`.

## Optional: Publish Assets

To publish CSS and JavaScript files for customization:

```bash
php artisan vendor:publish --tag=hub-ui-assets
```

Assets will be published to `resources/css/vendor/hub-ui/` and `resources/js/vendor/hub-ui/`.

## JavaScript Setup

### Option 1: Import modules (recommended)

```javascript
// resources/js/app.js
import { initToast, initConfirmation } from './vendor/hub-ui/hub-ui.js';
import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';

// Initialize Alpine
Alpine.plugin(collapse);
window.Alpine = Alpine;
Alpine.start();

// Initialize Hub UI modules
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
cp vendor/brunocfalcao/hub-ui/resources/js/modules/*.js resources/js/modules/
cp vendor/brunocfalcao/hub-ui/resources/js/hub-ui.js resources/js/
```

## Tailwind CSS Configuration

Some components use dynamic Tailwind classes. Add this to your `tailwind.config.js`:

```javascript
// tailwind.config.js
module.exports = {
    content: [
        // ... your existing content paths
        './vendor/brunocfalcao/hub-ui/resources/views/**/*.blade.php',
    ],
    safelist: [
        // For <x-hub-ui::status> component
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
<x-hub-ui::layouts.dashboard title="UI Test">
    <x-slot:sidebar>
        <x-hub-ui::sidebar>
            <x-hub-ui::sidebar.link href="/" :active="true">
                <x-slot:icon>
                    <svg class="w-full h-full" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                </x-slot:icon>
                Home
            </x-hub-ui::sidebar.link>
        </x-hub-ui::sidebar>
    </x-slot:sidebar>

    <x-hub-ui::page-header title="UI Test" description="Testing Hub UI components" />

    <x-hub-ui::card title="Test Card">
        <x-hub-ui::alert type="success">
            Hub UI is working correctly!
        </x-hub-ui::alert>

        <div class="mt-4">
            <x-hub-ui::button onclick="window.showToast('Hello!', 'success')">
                Show Toast
            </x-hub-ui::button>
        </div>
    </x-hub-ui::card>
</x-hub-ui::layouts.dashboard>
```

Visit `/ui-test` to verify the installation.
