# Sidebar

Accordion-style navigation sidebar with sliding background tile and localStorage persistence.

## Components

| Component | Description |
|-----------|-------------|
| `<x-hub-ui::sidebar>` | Main sidebar wrapper |
| `<x-hub-ui::sidebar.section>` | Accordion section with collapsible children |
| `<x-hub-ui::sidebar.link>` | Navigation link (child of section) |
| `<x-hub-ui::sidebar.logo>` | Default Hub UI logo |
| `<x-hub-ui::theme-toggle>` | Dark/light theme toggle button |

## Sidebar Wrapper

```blade
<x-hub-ui::sidebar :activeSection="'servers'" :activeHighlight="'all-servers'">
    {{-- Navigation items --}}

    <x-slot:footer>
        <x-hub-ui::theme-toggle />
    </x-slot:footer>
</x-hub-ui::sidebar>
```

### Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `activeSection` | string\|null | `null` | Section name to open on load |
| `activeHighlight` | string\|null | `null` | Nav item to highlight on load |

### Slots

| Slot | Description |
|------|-------------|
| `default` | Navigation sections and links |
| `logo` | Custom logo (overrides config `app.logo`) |
| `footer` | Footer content (theme toggle, user avatar, logout) |

### Alpine.js Data

The sidebar exposes these Alpine.js properties for nav items to interact with:

| Property | Description |
|----------|-------------|
| `open` | Currently opened section name (or `null`) |
| `highlight` | Currently highlighted nav item name |

Nav items should use `data-nav-item="name"` and `:class` bindings to react to `highlight`.

### Sliding Background Tile

The sidebar has a sliding background element that follows the highlighted nav item. Items with `data-nav-item` are tracked. The tile transitions smoothly between items.

## Section

Accordion parent — click to toggle children.

```blade
<x-hub-ui::sidebar.section name="servers" label="Servers">
    <x-slot:icon>
        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 14.25h13.5..." />
        </svg>
    </x-slot:icon>

    {{-- Child links go here --}}
</x-hub-ui::sidebar.section>
```

### Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `name` | string | `''` | Unique section identifier (for accordion tracking) |
| `label` | string | `''` | Display label |

### Slots

| Slot | Description |
|------|-------------|
| `default` | Child links |
| `icon` | Section icon (SVG, `w-full h-full`) |

## Standalone Nav Items

For top-level items that aren't inside a section (like "Dashboard"), add them directly to the sidebar slot:

```blade
<a
    href="{{ route('dashboard') }}" wire:navigate
    data-nav-item="dashboard"
    @click="highlight = 'dashboard'; open = null;"
    class="flex flex-col items-center gap-1 py-2 rounded-xl cursor-pointer transition-colors relative z-10"
    :class="highlight === 'dashboard' ? 'ui-sidebar-text-active' : 'ui-sidebar-text hover:ui-text-muted'"
>
    <span class="w-7 h-7">
        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 ..." />
        </svg>
    </span>
    <span class="text-xs">Dashboard</span>
</a>
```

Key attributes:
- `data-nav-item="name"` — enables tile tracking
- `@click="highlight = 'name'; open = null;"` — sets highlight and closes any open section
- `:class` — toggles between `ui-sidebar-text-active` and `ui-sidebar-text`
- `relative z-10` — ensures content appears above the sliding tile

## Child Links Inside Sections

```blade
<a
    href="/servers" wire:navigate
    data-nav-item="all-servers"
    @click="highlight = 'all-servers'"
    class="flex flex-col items-center gap-1 py-2 rounded-lg transition-colors relative z-10"
    :class="highlight === 'all-servers' ? 'ui-sidebar-text-active' : 'ui-sidebar-text hover:ui-text-muted'"
>
    <span class="w-5 h-5">
        <svg>...</svg>
    </span>
    <span class="text-xs">All Servers</span>
</a>
```

Child links use smaller icons (`w-5 h-5`) vs top-level (`w-7 h-7`).

## Custom Logo

### Via config

```php
// config/hub-ui.php
'app' => ['logo' => 'components.my-logo'],
```

### Via slot (takes precedence)

```blade
<x-hub-ui::sidebar>
    <x-slot:logo>
        <a href="{{ route('dashboard') }}">
            <img src="/logo.svg" class="w-10 h-10" />
        </a>
    </x-slot:logo>
    {{-- ... --}}
</x-hub-ui::sidebar>
```

## Theme Toggle

```blade
<x-hub-ui::theme-toggle />
```

Renders a sun/moon icon button that toggles between dark and light mode. Usually placed in the sidebar footer.

## LocalStorage Persistence

Accordion state is saved to `localStorage['sidebar_open']`. Disable:

```php
'sidebar' => ['persistence' => false],
```
