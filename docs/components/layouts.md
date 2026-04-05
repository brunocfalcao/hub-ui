# Dashboard Layout

Full-page layout with responsive sidebar, mobile support, and optional toast/confirmation.

## Usage

```blade
<x-hub-ui::layouts.dashboard title="Page Title">
    <x-slot:sidebar>
        <x-hub-ui::sidebar>
            {{-- Navigation --}}
        </x-hub-ui::sidebar>
    </x-slot:sidebar>

    {{-- Main content --}}
    <x-hub-ui::page-header title="Welcome" />
</x-hub-ui::layouts.dashboard>
```

## Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `title` | string | `config('app.name')` | HTML page title |

## Slots

| Slot | Description |
|------|-------------|
| `default` | Main content area (padded with `px-12 py-12`) |
| `sidebar` | Sidebar content — use with `<x-hub-ui::sidebar>` |
| `head` | Additional `<head>` content (styles, meta tags) |
| `scripts` | Scripts rendered at end of `<body>` |

## What It Includes

- Full HTML document (`<!doctype html>` through `</html>`)
- Theme styles and scripts (prevents FOUC)
- Google Fonts: Inter, Space Grotesk, JetBrains Mono
- Vite asset loading (`resources/css/app.css`, `resources/js/app.js`)
- Mobile sidebar toggle (hamburger button + overlay)
- Toast container (when `config('hub-ui.features.toast')` is `true`)
- Confirmation modal (when `config('hub-ui.features.confirmation')` is `true`)
- Navigate fade animation (when `config('hub-ui.features.navigate_fade')` is `true`)
- Livewire styles/scripts (when Livewire is installed)
- Sidebar persistence via `@persist('sidebar')`

## Mobile Responsiveness

Handled automatically:

- Sidebar collapses off-screen on `< lg` breakpoints
- A hamburger button appears at the left edge
- Clicking the overlay closes the sidebar

## Complete Example

```blade
<x-hub-ui::layouts.dashboard title="Server Management">
    <x-slot:head>
        <meta name="description" content="Manage your servers">
    </x-slot:head>

    <x-slot:sidebar>
        <x-hub-ui::sidebar :activeSection="'servers'" :activeHighlight="'all-servers'">
            <x-slot:logo>
                <a href="{{ route('dashboard') }}">
                    <img src="/logo.svg" class="w-10 h-10" />
                </a>
            </x-slot:logo>

            {{-- Dashboard link --}}
            <a href="{{ route('dashboard') }}" data-nav-item="dashboard"
               @click="highlight = 'dashboard'; open = null;"
               class="flex flex-col items-center gap-1 py-2 rounded-xl cursor-pointer relative z-10"
               :class="highlight === 'dashboard' ? 'ui-sidebar-text-active' : 'ui-sidebar-text'">
                <span class="w-7 h-7">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 ..." />
                    </svg>
                </span>
                <span class="text-xs">Dashboard</span>
            </a>

            {{-- Accordion section --}}
            <x-hub-ui::sidebar.section name="servers" label="Servers">
                <x-slot:icon>
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 14.25h13.5..." />
                    </svg>
                </x-slot:icon>

                <a href="/servers" data-nav-item="all-servers"
                   @click="highlight = 'all-servers'"
                   class="flex flex-col items-center gap-1 py-2 rounded-lg relative z-10"
                   :class="highlight === 'all-servers' ? 'ui-sidebar-text-active' : 'ui-sidebar-text'">
                    <span class="w-5 h-5">
                        <svg>...</svg>
                    </span>
                    <span class="text-xs">All Servers</span>
                </a>
            </x-hub-ui::sidebar.section>

            <x-slot:footer>
                <div class="flex flex-col items-center gap-3 pb-4">
                    <x-hub-ui::theme-toggle />
                </div>
            </x-slot:footer>
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

## Configuration

```php
// config/hub-ui.php
'sidebar' => ['width' => 'w-28'],
'features' => [
    'toast' => true,
    'confirmation' => true,
    'navigate_fade' => true,
],
'layout' => [
    'fonts' => [
        'body' => 'Inter',       // Applied to <body>
        'heading' => 'Space Grotesk',
        'mono' => 'JetBrains Mono',
    ],
],
```
