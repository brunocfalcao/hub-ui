# Toast Notifications

The toast system provides stackable, auto-dismissing notifications.

## Usage

```javascript
// Success toast (default)
window.showToast('Profile updated successfully!', 'success');

// Error toast
window.showToast('Failed to save changes', 'error');

// Warning toast
window.showToast('Your session will expire soon', 'warning');

// Info toast
window.showToast('Processing your request...', 'info');

// Custom duration (in milliseconds)
window.showToast('This will stay for 20 seconds', 'info', 20000);

// No auto-dismiss (duration = 0)
window.showToast('Click to dismiss', 'info', 0);
```

## Types

| Type | Color | Use Case |
|------|-------|----------|
| `success` | Emerald/Green | Successful operations |
| `error` | Red | Errors and failures |
| `warning` | Yellow | Warnings and cautions |
| `info` | Blue | Informational messages |

## Default Duration

Toasts auto-dismiss after 10 seconds (10000ms). Users can click to dismiss earlier.

## Stacking

Multiple toasts stack vertically. When dismissed, remaining toasts animate up smoothly.

## API

### showToast(message, type, duration)

| Parameter | Type | Default | Description |
|-----------|------|---------|-------------|
| `message` | string | **required** | Message to display |
| `type` | string | `'success'` | Toast type |
| `duration` | number | `10000` | Auto-dismiss time (ms) |

### hideAllToasts()

```javascript
// Dismiss all visible toasts immediately
window.hideAllToasts();
```

## Setup

### Include in Layout

The toast container is automatically included in the dashboard layout when `config('hub-ui.features.toast')` is `true`.

For custom layouts:

```blade
{{-- Near the end of your body --}}
<x-hub-ui::toast />
```

### Initialize JavaScript

```javascript
// resources/js/app.js
import { initToast } from './vendor/hub-ui/hub-ui.js';

document.addEventListener('DOMContentLoaded', function() {
    initToast();
});

// With Turbo:
document.addEventListener('turbo:load', function() {
    initToast();
});
```

## Laravel Integration

### Flash Messages

```php
// In your controller
return redirect()->route('servers.index')
    ->with('toast', [
        'message' => 'Server created successfully!',
        'type' => 'success'
    ]);
```

```blade
{{-- In your layout --}}
@if(session('toast'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.showToast(
            "{{ session('toast.message') }}",
            "{{ session('toast.type', 'success') }}"
        );
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

## Livewire Integration

```php
// In Livewire component
public function save()
{
    // ... save logic
    $this->dispatch('toast', message: 'Saved!', type: 'success');
}
```

```blade
{{-- In layout --}}
<script>
    Livewire.on('toast', ({ message, type }) => {
        window.showToast(message, type);
    });
</script>
```

## Disable Toasts

```php
// config/hub-ui.php
'features' => [
    'toast' => false,
],
```

## Styling

Toast colors are defined in the JavaScript module. To customize, publish the assets and modify `resources/js/vendor/hub-ui/modules/toast.js`.
