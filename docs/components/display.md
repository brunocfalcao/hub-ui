# Display Components

## Card

Container with optional title, subtitle, and footer.

```blade
<x-hub-ui::card title="Server Details" subtitle="Configuration and status">
    <p>Card content goes here.</p>

    <x-slot:footer>
        <x-hub-ui::button>Save Changes</x-hub-ui::button>
    </x-slot:footer>
</x-hub-ui::card>
```

### Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `title` | string | `null` | Card title |
| `subtitle` | string | `null` | Subtitle below title |
| `padding` | bool | `true` | Add padding to content |
| `footer` | slot | `null` | Footer content |

### Without Padding

```blade
<x-hub-ui::card :padding="false">
    <table class="w-full">
        {{-- Table without extra padding --}}
    </table>
</x-hub-ui::card>
```

## Badge

Small label/tag for status or categories.

```blade
<x-hub-ui::badge type="success">Active</x-hub-ui::badge>
<x-hub-ui::badge type="danger" dot>Error</x-hub-ui::badge>
<x-hub-ui::badge type="warning" size="sm">Warning</x-hub-ui::badge>
```

### Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `type` | string | `'default'` | Color type |
| `size` | string | `'md'` | Size (sm, md, lg) |
| `dot` | bool | `false` | Show status dot |

### Types

- `default` - Gray
- `primary` - Emerald/green
- `success` - Green
- `warning` - Amber
- `danger` - Red
- `info` - Blue
- `online` - Green (status)
- `offline` - Gray (status)
- `pending` - Emerald tint

## Alert

Notification banner with icon.

```blade
<x-hub-ui::alert type="success" title="Success!">
    Your changes have been saved.
</x-hub-ui::alert>

<x-hub-ui::alert type="warning" dismissible>
    Please review your settings.
</x-hub-ui::alert>
```

### Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `type` | string | `'info'` | Alert type |
| `title` | string | `null` | Optional title |
| `dismissible` | bool | `false` | Show dismiss button |

### Types

- `info` - Blue
- `success` - Green
- `warning` - Yellow
- `error` / `danger` - Red

## Status

Inline status indicator with optional animation.

```blade
<x-hub-ui::status color="emerald" label="Connected" />
<x-hub-ui::status color="red" label="Error" title="Connection failed" />
<x-hub-ui::status color="blue" label="Processing" :animated="true" />
```

### Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `color` | string | `'gray'` | Tailwind color name |
| `label` | string | **required** | Status text |
| `animated` | bool | `false` | Show pulsing animation |

### Tailwind Safelist

This component uses dynamic classes. Add to your `tailwind.config.js`:

```javascript
safelist: [
    { pattern: /^(bg|text)-(red|green|blue|yellow|gray|emerald|amber)-(300|400|500)$/ },
]
```

## Page Header

Page title with optional description.

```blade
<x-hub-ui::page-header
    title="Servers"
    description="Manage your server infrastructure"
/>
```

### Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `title` | string | **required** | Page title |
| `description` | string | `null` | Description text |

## Empty State

Placeholder for empty lists/tables.

```blade
<x-hub-ui::empty-state
    title="No servers yet"
    description="Get started by creating your first server."
    :action="['href' => route('servers.create'), 'label' => 'Create your first server']"
>
    <x-slot:icon>
        <svg class="w-full h-full" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5.25 14.25h13.5..." />
        </svg>
    </x-slot:icon>
</x-hub-ui::empty-state>
```

### Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `title` | string | **required** | Title text |
| `description` | string | `null` | Description text |
| `action` | array | `null` | Action button `['href' => ..., 'label' => ...]` |

### Slots

| Slot | Description |
|------|-------------|
| `icon` | Icon displayed above title |

## Dropdown

Click-triggered dropdown menu.

```blade
<x-hub-ui::dropdown align="right">
    <x-slot:trigger>
        <x-hub-ui::button variant="secondary">
            Actions
        </x-hub-ui::button>
    </x-slot:trigger>

    <x-slot:content>
        <x-hub-ui::dropdown-link href="/edit">Edit</x-hub-ui::dropdown-link>
        <x-hub-ui::dropdown-link href="/delete">Delete</x-hub-ui::dropdown-link>
    </x-slot:content>
</x-hub-ui::dropdown>
```

### Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `align` | string | `'right'` | Alignment (left, right, top) |
| `width` | string | `'48'` | Width class (Tailwind) |
| `contentClasses` | string | `'py-1 bg-neutral-800'` | Content container classes |

### Slots

| Slot | Description |
|------|-------------|
| `trigger` | Button/element that triggers the dropdown |
| `content` | Dropdown content (links, buttons) |

## Dropdown Link

Link item for dropdown content.

```blade
<x-hub-ui::dropdown-link href="/profile">Profile</x-hub-ui::dropdown-link>
<x-hub-ui::dropdown-link href="/settings">Settings</x-hub-ui::dropdown-link>
```

All attributes are passed through to the `<a>` element.
