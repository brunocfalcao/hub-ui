# Configuration

After publishing the configuration file, you can customize UI Skeleton in `config/ui-skeleton.php`.

## Component Prefix

```php
'prefix' => 'ui',
```

The prefix used for all components. Default is `ui`, so components are accessed as `<x-ui::button>`.

## Application Settings

```php
'app' => [
    'name' => env('APP_NAME', 'Laravel'),
    'logo' => null,
    'dashboard_route' => 'dashboard',
],
```

- **name**: Application name used in layouts
- **logo**: Custom logo component path (e.g., `'components.my-logo'`). If null, uses the default UI Skeleton logo.
- **dashboard_route**: Route name for the logo link in the sidebar

### Custom Logo Example

```php
// config/ui-skeleton.php
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

## Theme Settings

```php
'theme' => [
    'primary' => 'emerald',
],
```

- **primary**: Primary accent color using Tailwind CSS color names

## Feature Toggles

```php
'features' => [
    'toast' => true,
    'confirmation' => true,
],
```

Enable or disable features in the dashboard layout:
- **toast**: Toast notification system
- **confirmation**: Confirmation modal system

## Sidebar Settings

```php
'sidebar' => [
    'width' => 'w-28',
    'persistence' => true,
],
```

- **width**: Tailwind width class for the sidebar
- **persistence**: Enable localStorage persistence for accordion state

## Layout Settings

```php
'layout' => [
    'fonts' => [
        'body' => 'Inter',
        'heading' => 'Space Grotesk',
        'mono' => 'JetBrains Mono',
    ],
    'colors' => [
        'body' => '#1a1e2e',
        'sidebar' => '#151820',
        'card' => '#1a2332',
    ],
],
```

- **fonts**: Font families (Google Fonts)
- **colors**: Background colors in CSS hex format

## Environment Variables

You can use environment variables in your configuration:

```php
// config/ui-skeleton.php
'app' => [
    'name' => env('UI_APP_NAME', env('APP_NAME', 'Laravel')),
],
```

```env
# .env
UI_APP_NAME="My Admin Panel"
```
