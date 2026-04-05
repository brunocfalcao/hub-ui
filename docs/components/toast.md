# Toast Notifications

Stackable, auto-dismissing notifications.

## Usage

```javascript
window.showToast('Profile updated successfully!', 'success');
window.showToast('Failed to save changes', 'error');
window.showToast('Your session will expire soon', 'warning');
window.showToast('Processing your request...', 'info');

// Custom duration (milliseconds)
window.showToast('This stays for 20 seconds', 'info', 20000);

// No auto-dismiss (duration = 0)
window.showToast('Click to dismiss', 'info', 0);
```

## API

### showToast(message, type, duration)

| Parameter | Type | Default | Description |
|-----------|------|---------|-------------|
| `message` | string | **required** | Message to display |
| `type` | string | `'success'` | Toast type |
| `duration` | number | `10000` | Auto-dismiss time in ms (0 = manual) |

### hideAllToasts()

```javascript
window.hideAllToasts();
```

## Types

| Type | Color | Icon |
|------|-------|------|
| `success` | Green | Checkmark |
| `error` | Red | X icon |
| `warning` | Yellow | Warning triangle |
| `info` | Blue | Info circle |

## Behavior

- Multiple toasts stack vertically
- Click any toast to dismiss it
- Remaining toasts animate up smoothly when one is dismissed
- Default auto-dismiss: 10 seconds

## Laravel Integration

### Flash Messages

```php
// Controller
return redirect()->route('servers.index')
    ->with('toast', ['message' => 'Server created!', 'type' => 'success']);
```

```blade
{{-- Layout --}}
@if(session('toast'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.showToast("{{ session('toast.message') }}", "{{ session('toast.type', 'success') }}");
    });
</script>
@endif
```

### Validation Errors

```blade
@if($errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.showToast('Please fix the errors below.', 'error');
    });
</script>
@endif
```

### Livewire

```php
// Component
public function save()
{
    // ...
    $this->dispatch('toast', message: 'Saved!', type: 'success');
}
```

```blade
{{-- Layout --}}
<script>
    Livewire.on('toast', ({ message, type }) => {
        window.showToast(message, type);
    });
</script>
```

## Setup

Automatically included in the dashboard layout when `config('hub-ui.features.toast')` is `true`.

For custom layouts:

```blade
<x-hub-ui::toast />
```

```javascript
import { initToast } from './vendor/hub-ui/hub-ui.js';
document.addEventListener('DOMContentLoaded', () => initToast());
```

### Disable

```php
'features' => ['toast' => false],
```
