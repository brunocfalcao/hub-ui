# Configuration

Publish the config file, then customize in `config/hub-ui.php`.

## Full Config Reference

```php
return [
    'prefix' => 'hub-ui',

    'app' => [
        'name' => env('APP_NAME', 'Laravel'),
        'logo' => null,
        'dashboard_route' => 'dashboard',
    ],

    'theme' => [
        'default_mode' => 'dark', // 'dark' or 'light'

        'colors' => [
            'primary'   => '#10b981', // Emerald
            'secondary' => '#6366f1', // Indigo
            'success'   => '#22c55e', // Green
            'warning'   => '#f59e0b', // Amber
            'danger'    => '#ef4444', // Red
            'info'      => '#3b82f6', // Blue
        ],
    ],

    'layout' => [
        'fonts' => [
            'body' => 'Inter',
            'heading' => 'Space Grotesk',
            'mono' => 'JetBrains Mono',
        ],
    ],

    'sidebar' => [
        'width' => 'w-28',
        'persistence' => true,
    ],

    'features' => [
        'toast' => true,
        'confirmation' => true,
        'navigate_fade' => true,
    ],
];
```

## Section Details

### Component Prefix

```php
'prefix' => 'hub-ui',
```

All components are accessed as `<x-hub-ui::component-name>`.

### Application Settings

| Key | Type | Default | Description |
|-----|------|---------|-------------|
| `name` | string | `APP_NAME` | App name used in page titles |
| `logo` | string\|null | `null` | Custom logo view path (e.g., `'components.my-logo'`) |
| `dashboard_route` | string | `'dashboard'` | Route name for the sidebar logo link |

#### Custom Logo

```php
'app' => [
    'logo' => 'components.my-app-logo',
],
```

```blade
{{-- resources/views/components/my-app-logo.blade.php --}}
<svg viewBox="0 0 40 40" class="w-14 h-14">
    <!-- Your logo SVG -->
</svg>
```

Or use the `logo` slot on the sidebar component (takes precedence over config).

### Theme Settings

| Key | Type | Default | Description |
|-----|------|---------|-------------|
| `default_mode` | string | `'dark'` | Default theme mode (`'dark'` or `'light'`) |
| `colors` | array | See above | Brand colors as hex values |

All colors must be hex values (e.g., `'#10b981'`). The `Theme` class automatically derives hover variants, soft variants, and all surface/border/text colors for both dark and light modes.

### Layout Settings

| Key | Type | Default | Description |
|-----|------|---------|-------------|
| `fonts.body` | string | `'Inter'` | Body font family (Google Fonts) |
| `fonts.heading` | string | `'Space Grotesk'` | Heading font family |
| `fonts.mono` | string | `'JetBrains Mono'` | Monospace font family |

### Sidebar Settings

| Key | Type | Default | Description |
|-----|------|---------|-------------|
| `width` | string | `'w-28'` | Tailwind width class for sidebar |
| `persistence` | bool | `true` | Save accordion state in localStorage |

### Feature Toggles

| Key | Type | Default | Description |
|-----|------|---------|-------------|
| `toast` | bool | `true` | Enable toast notification system |
| `confirmation` | bool | `true` | Enable confirmation modal system |
| `navigate_fade` | bool | `true` | Enable fade animation on page navigation |
