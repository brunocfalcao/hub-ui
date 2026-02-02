# Sidebar

The sidebar component provides an accordion-style navigation with localStorage persistence.

## Components

- `<x-ui::sidebar>` - Main sidebar wrapper
- `<x-ui::sidebar.section>` - Accordion section with collapsible children
- `<x-ui::sidebar.link>` - Navigation link
- `<x-ui::sidebar.logo>` - Default logo (can be replaced)

## Sidebar Wrapper

```blade
<x-ui::sidebar :activeSection="'servers'">
    {{-- Navigation content --}}

    <x-slot:footer>
        {{-- User avatar, logout button, etc. --}}
    </x-slot:footer>
</x-ui::sidebar>
```

### Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `activeSection` | string | `null` | Section name to open by default |

### Slots

| Slot | Description |
|------|-------------|
| `default` | Navigation sections and links |
| `logo` | Custom logo (overrides config) |
| `footer` | Footer content (user avatar, etc.) |

## Section

Accordion-style parent with collapsible children.

```blade
<x-ui::sidebar.section name="servers" label="Servers">
    <x-slot:icon>
        <svg class="w-full h-full" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5.25 14.25h13.5..." />
        </svg>
    </x-slot:icon>

    {{-- Child links --}}
    <x-ui::sidebar.link href="/servers" :active="true" child>
        All Servers
    </x-ui::sidebar.link>
</x-ui::sidebar.section>
```

### Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `name` | string | `''` | Unique identifier for accordion state |
| `label` | string | `''` | Display text |

### Slots

| Slot | Description |
|------|-------------|
| `default` | Child links |
| `icon` | Section icon |

## Link

Navigation link with icon and label.

```blade
<x-ui::sidebar.link
    href="/servers"
    :active="request()->routeIs('servers.*')"
    child
>
    <x-slot:icon>
        <svg>...</svg>
    </x-slot:icon>
    All Servers
</x-ui::sidebar.link>
```

### Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `href` | string | `'#'` | Link URL |
| `active` | bool | `false` | Highlight as active |
| `child` | bool | `false` | Render as child item (smaller, no background) |

## Custom Logo

### Option 1: Config

```php
// config/ui-skeleton.php
'app' => [
    'logo' => 'components.my-logo',
],
```

### Option 2: Slot

```blade
<x-ui::sidebar>
    <x-slot:logo>
        <a href="{{ route('dashboard') }}">
            <x-my-app-logo />
        </a>
    </x-slot:logo>

    {{-- Navigation --}}
</x-ui::sidebar>
```

## Complete Example

```blade
<x-ui::sidebar :activeSection="request()->routeIs('servers.*') ? 'servers' : ''">
    <x-slot:logo>
        <a href="{{ route('dashboard') }}">
            <x-application-logo class="w-14 h-14" />
        </a>
    </x-slot:logo>

    {{-- Home (standalone link) --}}
    <x-ui::sidebar.link
        href="{{ route('dashboard') }}"
        :active="request()->routeIs('dashboard')"
    >
        <x-slot:icon>
            <svg class="w-full h-full" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.25 12l8.954-8.955..." />
            </svg>
        </x-slot:icon>
        Home
    </x-ui::sidebar.link>

    {{-- Servers Section --}}
    <x-ui::sidebar.section name="servers" label="Servers">
        <x-slot:icon>
            <svg class="w-full h-full" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path d="M5.25 14.25h13.5..." />
            </svg>
        </x-slot:icon>

        <x-ui::sidebar.link href="{{ route('servers.index') }}" :active="request()->routeIs('servers.index')" child>
            <x-slot:icon>
                <svg class="w-full h-full" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M8.25 6.75h12..." />
                </svg>
            </x-slot:icon>
            All Servers
        </x-ui::sidebar.link>

        <x-ui::sidebar.link href="{{ route('servers.create') }}" :active="request()->routeIs('servers.create')" child>
            <x-slot:icon>
                <svg class="w-full h-full" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
            </x-slot:icon>
            Create Server
        </x-ui::sidebar.link>
    </x-ui::sidebar.section>

    <x-slot:footer>
        @auth
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="group" title="Sign out">
                    <div class="w-12 h-12 rounded-full ring-2 ring-white overflow-hidden group-hover:ring-red-400 transition-colors">
                        <img src="https://i.pravatar.cc/100?u={{ auth()->user()->email }}" alt="{{ auth()->user()->name }}" class="w-full h-full object-cover" />
                    </div>
                </button>
            </form>
        @endauth
    </x-slot:footer>
</x-ui::sidebar>
```

## LocalStorage Persistence

The accordion state is automatically saved to localStorage. Disable with:

```php
// config/ui-skeleton.php
'sidebar' => [
    'persistence' => false,
],
```
