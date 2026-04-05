# Display Components

## Card

Container with optional title, subtitle, and footer.

```blade
<x-hub-ui::card title="Server Details" subtitle="Configuration and status">
    <p class="ui-text">Card content goes here.</p>

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
| `padding` | bool | `true` | Apply `px-8 py-7` padding to content |
| `footer` | slot | `null` | Footer content (has darker background) |

### Without Padding

Useful for edge-to-edge content like tables:

```blade
<x-hub-ui::card title="Servers" :padding="false">
    <x-hub-ui::data-table :columns="$columns" :rows="$rows" />
</x-hub-ui::card>
```

### CSS Classes

- `.ui-card` — container (bg, border, rounded)
- `.ui-card-header` — title/subtitle area (border-bottom)
- `.ui-card-footer` — footer area (border-top, darker bg)

## Page Header

Page title with optional description.

```blade
<x-hub-ui::page-header title="Servers" description="Manage your server infrastructure" />
```

### Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `title` | string | **required** | Page title (`text-5xl font-medium`) |
| `description` | string | `null` | Description (`text-sm`, subtle color) |

Has `mb-8` bottom margin by default. Override via attributes.

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
| `size` | string | `'md'` | Size: `sm`, `md`, `lg` |
| `dot` | bool | `false` | Show colored dot before text |

### Types

| Type | Description |
|------|-------------|
| `default` | Gray (elevated bg, muted text) |
| `primary` | Primary color |
| `secondary` | Secondary color |
| `success` | Green |
| `warning` | Amber |
| `danger` | Red |
| `info` | Blue |
| `online` | Green (alias for success) |
| `offline` | Gray (alias for default) |
| `pending` | Primary with 80% opacity |

## Alert

Notification banner with icon and optional dismiss.

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
| `title` | string | `null` | Optional bold title above message |
| `dismissible` | bool | `false` | Show dismiss button (uses Alpine.js) |

### Types

| Type | Color | Icon |
|------|-------|------|
| `info` | Blue | Info circle |
| `success` | Green | Check circle |
| `warning` | Yellow | Warning triangle |
| `error` | Red | X circle |
| `danger` | Red | X circle (alias for error) |

## Status

Inline status indicator with colored dot.

```blade
<x-hub-ui::status type="success" label="Connected" />
<x-hub-ui::status type="danger" label="Error" />
<x-hub-ui::status type="info" label="Processing" :animated="true" />
```

### Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `type` | string | `'default'` | Color type |
| `label` | string | **required** | Status text |
| `animated` | bool | `false` | Show pulsing animation on dot |

### Types

Uses theme CSS variables: `primary`, `success`, `warning`, `danger`, `info`, `secondary`, `default`.

## Spinner

Animated loading indicator.

```blade
<x-hub-ui::spinner />
<x-hub-ui::spinner size="lg" color="primary" />
```

### Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `size` | string | `'md'` | Size: `xs`, `sm`, `md`, `lg`, `xl` |
| `color` | string | `'current'` | Color: `current`, `white`, `primary` |

### Sizes

| Size | Class |
|------|-------|
| `xs` | `h-3 w-3` |
| `sm` | `h-4 w-4` |
| `md` | `h-6 w-6` |
| `lg` | `h-8 w-8` |
| `xl` | `h-12 w-12` |

## Empty State

Placeholder for empty lists or tables.

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
| `action` | array | `null` | Action button: `['href' => '...', 'label' => '...']` |

### Slots

| Slot | Description |
|------|-------------|
| `icon` | Icon above the title (rendered inside a rounded elevated container) |

The action button renders as a secondary button with a `+` icon.

## Data Table

Simple table from arrays.

```blade
<x-hub-ui::data-table
    :columns="['Name', 'Status', 'Region']"
    :rows="[
        ['Name' => 'Server 1', 'Status' => 'Active', 'Region' => 'US East'],
        ['Name' => 'Server 2', 'Status' => 'Offline', 'Region' => 'EU West'],
    ]"
    empty="No servers found."
/>
```

### Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `columns` | array | `[]` | Column headers (also used as row keys) |
| `rows` | array | `[]` | Array of associative arrays keyed by column names |
| `empty` | string | `'No results.'` | Message when no rows |

Shows a row count below the table. Cells truncate with a `title` attribute for full text on hover.

## Dropdown

Click-triggered dropdown menu.

```blade
<x-hub-ui::dropdown align="right">
    <x-slot:trigger>
        <x-hub-ui::button variant="secondary">Actions</x-hub-ui::button>
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
| `align` | string | `'right'` | Alignment: `left`, `right`, `top` |
| `width` | string | `'w-48'` | Width (Tailwind class) |
| `contentClasses` | string | `'py-1'` | Additional classes for content |

### Slots

| Slot | Description |
|------|-------------|
| `trigger` | Element that triggers the dropdown |
| `content` | Dropdown content (links, buttons) |

Closes on click-outside. Uses Alpine.js for toggle.

## Dropdown Link

Link item for dropdown content. All attributes passed through to the `<a>` element.

```blade
<x-hub-ui::dropdown-link href="/profile">Profile</x-hub-ui::dropdown-link>
```

Uses `.ui-dropdown-link` styling (muted text, hover: card bg + full text).
