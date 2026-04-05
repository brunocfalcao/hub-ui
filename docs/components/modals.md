# Modal Components

## Generic Modal

Flexible modal with Alpine.js, keyboard navigation, and focus management.

```blade
<x-hub-ui::modal name="edit-user" maxWidth="lg">
    <div class="p-6">
        <h2 class="text-lg font-medium ui-text">Edit User</h2>
        <form>
            {{-- Form content --}}
        </form>
    </div>
</x-hub-ui::modal>
```

### Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `name` | string | **required** | Unique modal identifier |
| `show` | bool | `false` | Initial visibility |
| `maxWidth` | string | `'2xl'` | Max width: `sm`, `md`, `lg`, `xl`, `2xl` |

### Opening / Closing

Use Alpine.js events:

```blade
{{-- Open --}}
<button @click="$dispatch('open-modal', 'edit-user')">Edit User</button>

{{-- Close from inside --}}
<button @click="$dispatch('close-modal', 'edit-user')">Cancel</button>
```

### Keyboard Navigation

- **Escape** — closes the modal
- **Tab** — cycles through focusable elements
- **Shift+Tab** — reverse tab

### Auto-Focus

Add `focusable` attribute to focus the first element on open:

```blade
<x-hub-ui::modal name="confirm" focusable>
    {{-- First focusable element gets focus --}}
</x-hub-ui::modal>
```

### Features

- Backdrop click closes the modal
- Body scroll is locked while open (`overflow-y-hidden`)
- Uses `.ui-elevated` styling (themed background + border)

## Confirmation Modal

Pre-built confirmation dialog for dangerous or cautionary actions.

### Usage via JavaScript

```javascript
window.showConfirmation({
    title: 'Delete Server',
    message: 'This will permanently delete the server. This action cannot be undone.',
    confirmText: 'Delete',
    cancelText: 'Cancel',
    type: 'danger',
    onConfirm: () => {
        deleteServer(serverId);
    },
    onCancel: () => {
        // Optional
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
| `type` | string | `'danger'` | Color type: `danger`, `warning`, `info` |
| `onConfirm` | function | `null` | Callback on confirm |
| `onCancel` | function | `null` | Callback on cancel |

### Types

| Type | Confirm Button Color |
|------|---------------------|
| `danger` | Red |
| `warning` | Amber |
| `info` | Blue |

### Example: Delete with Form

```blade
<form id="delete-form-{{ $server->id }}" action="{{ route('servers.destroy', $server) }}" method="POST" class="hidden">
    @csrf
    @method('DELETE')
</form>

<x-hub-ui::button
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
</x-hub-ui::button>
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

The confirmation modal is automatically included in the dashboard layout when `config('hub-ui.features.confirmation')` is `true`.

For custom layouts, add manually:

```blade
{{-- At the end of body --}}
<x-hub-ui::modal-confirmation />
```

### Initialize JavaScript

```javascript
import { initConfirmation } from './vendor/hub-ui/hub-ui.js';
document.addEventListener('DOMContentLoaded', () => initConfirmation());
```

### Disable

```php
'features' => ['confirmation' => false],
```
