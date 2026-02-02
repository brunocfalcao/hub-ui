# Modal Components

## Generic Modal

A flexible modal component with Alpine.js.

```blade
<x-ui::modal name="edit-user" maxWidth="lg">
    <div class="p-6">
        <h2 class="text-lg font-medium text-white">Edit User</h2>
        <form>
            {{-- Form content --}}
        </form>
    </div>
</x-ui::modal>
```

### Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `name` | string | **required** | Unique modal identifier |
| `show` | bool | `false` | Initial visibility |
| `maxWidth` | string | `'2xl'` | Max width (sm, md, lg, xl, 2xl) |

### Opening/Closing

Use Alpine.js events:

```blade
{{-- Open modal --}}
<button @click="$dispatch('open-modal', 'edit-user')">
    Edit User
</button>

{{-- Close from inside modal --}}
<button @click="$dispatch('close-modal', 'edit-user')">
    Cancel
</button>
```

### Keyboard Navigation

- **Escape** - Closes the modal
- **Tab** - Cycles through focusable elements
- **Shift+Tab** - Reverse tab navigation

### Focusable Elements

Add the `focusable` attribute to auto-focus the first element:

```blade
<x-ui::modal name="confirm" focusable>
    {{-- First focusable element will be focused --}}
</x-ui::modal>
```

## Confirmation Modal

Pre-built confirmation dialog for dangerous actions.

### Usage via JavaScript

```javascript
window.showConfirmation({
    title: 'Delete Server',
    message: 'This will permanently delete the server and all its data. This action cannot be undone.',
    confirmText: 'Delete',
    cancelText: 'Cancel',
    type: 'danger',
    onConfirm: () => {
        // Handle confirmation
        deleteServer(serverId);
    },
    onCancel: () => {
        // Handle cancellation (optional)
    }
});
```

### Options

| Option | Type | Default | Description |
|--------|------|---------|-------------|
| `title` | string | `'Are you sure?'` | Modal title |
| `message` | string | `''` | Message text |
| `confirmText` | string | `'Confirm'` | Confirm button text |
| `cancelText` | string | `'Cancel'` | Cancel button text |
| `type` | string | `'danger'` | Type (danger, warning, info) |
| `onConfirm` | function | `null` | Callback on confirm |
| `onCancel` | function | `null` | Callback on cancel |

### Types

- `danger` - Red styling (for destructive actions)
- `warning` - Amber styling (for cautionary actions)
- `info` - Blue styling (for informational confirmations)

### Example: Delete with Form

```blade
<form id="delete-form-{{ $server->id }}" action="{{ route('servers.destroy', $server) }}" method="POST" class="hidden">
    @csrf
    @method('DELETE')
</form>

<x-ui::button
    variant="danger"
    onclick="window.showConfirmation({
        title: 'Delete Server',
        message: 'Are you sure you want to delete {{ $server->name }}?',
        type: 'danger',
        confirmText: 'Delete Server',
        onConfirm: () => document.getElementById('delete-form-{{ $server->id }}').submit()
    })"
>
    Delete
</x-ui::button>
```

### Example: Warning Confirmation

```javascript
window.showConfirmation({
    title: 'Restart Server',
    message: 'This will cause a brief downtime. Are you sure?',
    type: 'warning',
    confirmText: 'Restart',
    onConfirm: async () => {
        await fetch(`/api/servers/${serverId}/restart`, { method: 'POST' });
        window.showToast('Server is restarting', 'info');
    }
});
```

## Setup

### Include in Layout

The confirmation modal is automatically included in the dashboard layout when `config('ui-skeleton.features.confirmation')` is `true`.

For custom layouts:

```blade
{{-- At the end of your body --}}
<x-ui::modal-confirmation />
```

### Initialize JavaScript

```javascript
// resources/js/app.js
import { initConfirmation } from './vendor/ui-skeleton/ui-skeleton.js';

document.addEventListener('DOMContentLoaded', function() {
    initConfirmation();
});

// With Turbo:
document.addEventListener('turbo:load', function() {
    initConfirmation();
});
```

## Disable Confirmation Modal

```php
// config/ui-skeleton.php
'features' => [
    'confirmation' => false,
],
```
