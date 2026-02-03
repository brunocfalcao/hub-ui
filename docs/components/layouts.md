# Layouts

## Dashboard Layout

The dashboard layout provides a full-page layout with a responsive sidebar.

### Basic Usage

```blade
<x-hub-ui::layouts.dashboard title="Page Title">
    <x-slot:sidebar>
        {{-- Sidebar content --}}
    </x-slot:sidebar>

    {{-- Main content --}}
    <h1>Welcome</h1>
</x-hub-ui::layouts.dashboard>
```

### Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `title` | string | `config('app.name')` | Page title |

### Slots

| Slot | Description |
|------|-------------|
| `default` | Main content area |
| `sidebar` | Sidebar content (use with `<x-hub-ui::sidebar>`) |
| `head` | Additional content for `<head>` (styles, meta tags) |
| `scripts` | Page-specific scripts (rendered at end of body) |

### Complete Example

```blade
<x-hub-ui::layouts.dashboard title="Server Management">
    <x-slot:head>
        <meta name="description" content="Manage your servers">
    </x-slot:head>

    <x-slot:sidebar>
        <x-hub-ui::sidebar :activeSection="'servers'">
            <x-hub-ui::sidebar.section name="servers" label="Servers">
                <x-slot:icon>
                    <svg>...</svg>
                </x-slot:icon>
                <x-hub-ui::sidebar.link href="/servers" :active="true" child>
                    All Servers
                </x-hub-ui::sidebar.link>
            </x-hub-ui::sidebar.section>
        </x-hub-ui::sidebar>
    </x-slot:sidebar>

    <x-hub-ui::page-header title="Servers" />

    <x-hub-ui::card>
        {{-- Content --}}
    </x-hub-ui::card>

    <x-slot:scripts>
        <script>
            // Page-specific JavaScript
        </script>
    </x-slot:scripts>
</x-hub-ui::layouts.dashboard>
```

### Mobile Responsiveness

The layout automatically handles mobile responsiveness:
- Sidebar collapses on mobile devices
- A hamburger button appears to toggle the sidebar
- Clicking outside the sidebar closes it on mobile

### Configuration

The layout respects these config options:

```php
// config/hub-ui.php
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
