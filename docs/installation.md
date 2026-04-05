# Installation

## Requirements

- PHP 8.2+
- Laravel 11.x or 12.x
- Alpine.js 3.x (with collapse plugin)
- Tailwind CSS 3.x

## Install via Composer

```bash
composer require brunocfalcao/hub-ui
```

The package uses Laravel's auto-discovery — no manual service provider registration needed.

## Publish Configuration

```bash
php artisan vendor:publish --tag=hub-ui-config
```

Creates `config/hub-ui.php` for customization.

## Optional: Publish Views

```bash
php artisan vendor:publish --tag=hub-ui-views
```

Views are published to `resources/views/vendor/hub-ui/`.

## Optional: Publish Assets

```bash
php artisan vendor:publish --tag=hub-ui-assets
```

CSS goes to `resources/css/vendor/hub-ui/`, JS to `resources/js/vendor/hub-ui/`.

## JavaScript Setup

### Option 1: Import modules (recommended)

```javascript
// resources/js/app.js
import { initToast, initConfirmation } from './vendor/hub-ui/hub-ui.js';
import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';

Alpine.plugin(collapse);
window.Alpine = Alpine;
Alpine.start();

document.addEventListener('DOMContentLoaded', function() {
    initToast();
    initConfirmation();
});
```

### Option 2: Copy the modules

```bash
cp vendor/brunocfalcao/hub-ui/resources/js/modules/*.js resources/js/modules/
cp vendor/brunocfalcao/hub-ui/resources/js/hub-ui.js resources/js/
```

## Tailwind CSS Configuration

Add the package's views to your content paths:

```javascript
// tailwind.config.js
export default {
    content: [
        // ... your existing paths
        './vendor/brunocfalcao/hub-ui/resources/views/**/*.blade.php',
        // Or if using a local path repository:
        './packages/brunocfalcao/hub-ui/resources/views/**/*.blade.php',
    ],
}
```

## Alpine.js Collapse Plugin

Required for the sidebar accordion:

```bash
npm install @alpinejs/collapse
```

```javascript
import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';

Alpine.plugin(collapse);
window.Alpine = Alpine;
Alpine.start();
```

## Verify Installation

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
            <x-slot:logo>
                <span class="text-2xl">Test</span>
            </x-slot:logo>
        </x-hub-ui::sidebar>
    </x-slot:sidebar>

    <x-hub-ui::page-header title="UI Test" description="Testing Hub UI components" />

    <x-hub-ui::alert type="success">
        Hub UI is working correctly!
    </x-hub-ui::alert>
</x-hub-ui::layouts.dashboard>
```
