# Layouts

## Dashboard Layout

The dashboard layout provides a full-page layout with a responsive sidebar.

### Basic Usage

```blade
<x-ui::layouts.dashboard title="Page Title">
    <x-slot:sidebar>
        {{-- Sidebar content --}}
    </x-slot:sidebar>

    {{-- Main content --}}
    <h1>Welcome</h1>
</x-ui::layouts.dashboard>
```

### Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `title` | string | `config('app.name')` | Page title |

### Slots

| Slot | Description |
|------|-------------|
| `default` | Main content area |
| `sidebar` | Sidebar content (use with `<x-ui::sidebar>`) |
| `head` | Additional content for `<head>` (styles, meta tags) |
| `scripts` | Page-specific scripts (rendered at end of body) |

### Complete Example

```blade
<x-ui::layouts.dashboard title="Server Management">
    <x-slot:head>
        <meta name="description" content="Manage your servers">
    </x-slot:head>

    <x-slot:sidebar>
        <x-ui::sidebar :activeSection="'servers'">
            <x-ui::sidebar.section name="servers" label="Servers">
                <x-slot:icon>
                    <svg>...</svg>
                </x-slot:icon>
                <x-ui::sidebar.link href="/servers" :active="true" child>
                    All Servers
                </x-ui::sidebar.link>
            </x-ui::sidebar.section>
        </x-ui::sidebar>
    </x-slot:sidebar>

    <x-ui::page-header title="Servers" />

    <x-ui::card>
        {{-- Content --}}
    </x-ui::card>

    <x-slot:scripts>
        <script>
            // Page-specific JavaScript
        </script>
    </x-slot:scripts>
</x-ui::layouts.dashboard>
```

### Mobile Responsiveness

The layout automatically handles mobile responsiveness:
- Sidebar collapses on mobile devices
- A hamburger button appears to toggle the sidebar
- Clicking outside the sidebar closes it on mobile

### Configuration

The layout respects these config options:

```php
// config/ui-skeleton.php
'layout' => [
    'colors' => [
        'body' => '#1a1e2e',
        'sidebar' => '#151820',
    ],
],
'sidebar' => [
    'width' => 'w-28',
],
'features' => [
    'toast' => true,
    'confirmation' => true,
],
```
