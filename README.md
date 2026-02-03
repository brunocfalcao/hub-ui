# Hub UI

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
composer require brunocfalcao/hub-ui
```

Publish the configuration file:

```bash
php artisan vendor:publish --tag=hub-ui-config
```

## Quick Start

### 1. Set up your layout

```blade
{{-- resources/views/layouts/app.blade.php --}}
<x-hub-ui::layouts.dashboard title="My App">
    <x-slot:sidebar>
        <x-hub-ui::sidebar :activeSection="'dashboard'">
            {{-- Your navigation here --}}
        </x-hub-ui::sidebar>
    </x-slot:sidebar>

    {{ $slot }}
</x-hub-ui::layouts.dashboard>
```

### 2. Initialize JavaScript modules

```javascript
// resources/js/app.js
import { initToast, initConfirmation } from './vendor/hub-ui/hub-ui.js';

document.addEventListener('DOMContentLoaded', function() {
    initToast();
    initConfirmation();
});
```

### 3. Use components

```blade
<x-hub-ui::card title="Server Details">
    <x-hub-ui::input name="hostname" label="Hostname" required />
    <x-hub-ui::select name="region" label="Region" :options="$regions" />
    <x-hub-ui::button type="submit">Save</x-hub-ui::button>
</x-hub-ui::card>
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
