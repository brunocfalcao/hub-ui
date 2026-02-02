# UI Skeleton

A reusable Laravel admin panel UI components package with dark theme, Alpine.js, and Tailwind CSS.

## Features

- **Dark Theme** - Modern dark color scheme with customizable colors
- **Dashboard Layout** - Responsive layout with collapsible sidebar
- **Form Components** - Input, Select, Textarea, Checkbox, Button
- **Display Components** - Card, Badge, Alert, Status, Page Header, Empty State
- **Modal System** - Generic modal and confirmation dialog
- **Toast Notifications** - Stackable toast notifications with auto-dismiss
- **Sidebar System** - Accordion-style navigation with localStorage persistence

## Requirements

- PHP 8.2+
- Laravel 11 or 12
- Alpine.js 3.x
- Tailwind CSS 3.x

## Installation

```bash
composer require brunocfalcao/ui-skeleton
```

Publish the configuration file:

```bash
php artisan vendor:publish --tag=ui-skeleton-config
```

## Quick Start

### 1. Set up your layout

```blade
{{-- resources/views/layouts/app.blade.php --}}
<x-ui::layouts.dashboard title="My App">
    <x-slot:sidebar>
        <x-ui::sidebar :activeSection="'dashboard'">
            {{-- Your navigation here --}}
        </x-ui::sidebar>
    </x-slot:sidebar>

    {{ $slot }}
</x-ui::layouts.dashboard>
```

### 2. Initialize JavaScript modules

```javascript
// resources/js/app.js
import { initToast, initConfirmation } from './vendor/ui-skeleton/ui-skeleton.js';

document.addEventListener('DOMContentLoaded', function() {
    initToast();
    initConfirmation();
});
```

### 3. Use components

```blade
<x-ui::card title="Server Details">
    <x-ui::input name="hostname" label="Hostname" required />
    <x-ui::select name="region" label="Region" :options="$regions" />
    <x-ui::button type="submit">Save</x-ui::button>
</x-ui::card>
```

## Documentation

- [Installation Guide](docs/installation.md)
- [Configuration](docs/configuration.md)
- [Theming](docs/theming.md)
- [Components](docs/components/)
  - [Layouts](docs/components/layouts.md)
  - [Sidebar](docs/components/sidebar.md)
  - [Forms](docs/components/forms.md)
  - [Display](docs/components/display.md)
  - [Modals](docs/components/modals.md)
  - [Toast](docs/components/toast.md)

## License

MIT License. See [LICENSE](LICENSE) for details.
