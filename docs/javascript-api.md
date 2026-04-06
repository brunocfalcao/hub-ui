# JavaScript API

Hub UI provides global JavaScript functions available on every page that uses the dashboard layout. These are loaded synchronously in the `<head>` to prevent FOUC and ensure availability.

## hubUiFetch

Standard AJAX helper for all server communication. Handles CSRF, JSON headers, response parsing, and error extraction. Use this instead of raw `fetch()` so every feature gets consistent behavior.

### Usage

```javascript
const { ok, data } = await hubUiFetch('/api/endpoint', {
    body: { key: 'value' },
});

if (ok) {
    // data contains the parsed JSON response
    console.log(data);
} else {
    // data.error contains the error message
    console.error(data.error);
}
```

### Parameters

| Parameter | Type | Description |
|-----------|------|-------------|
| `url` | string | **Required.** The endpoint URL |
| `options` | object | Optional configuration |

### Options

| Key | Type | Default | Description |
|-----|------|---------|-------------|
| `method` | string | `'POST'` | HTTP method |
| `body` | object | `null` | Request body (JSON.stringified automatically) |
| `headers` | object | `{}` | Extra headers (merged with defaults) |

### Return Value

Returns `{ ok, status, data }`:

| Key | Type | Description |
|-----|------|-------------|
| `ok` | boolean | `true` if HTTP status is 2xx |
| `status` | number | HTTP status code (0 on network error) |
| `data` | object | Parsed JSON response body |

### What It Handles

- **CSRF token** — reads from `<meta name="csrf-token">` (included in dashboard layout)
- **JSON headers** — sets `Content-Type` and `Accept` to `application/json`
- **Network errors** — catches fetch failures and returns `{ ok: false, data: { error: '...' } }`
- **Response parsing** — automatically parses JSON response

### Alpine.js Pattern

The standard pattern for AJAX-driven features:

```javascript
function myFeature() {
    return {
        loading: false,
        error: null,
        results: null,

        async doSomething() {
            if (this.loading) return;

            this.loading = true;
            this.error = null;

            const { ok, data } = await hubUiFetch('/my-endpoint', {
                body: { param: 'value' },
            });

            if (ok) {
                this.results = data;
            } else {
                this.error = data.error || 'An error occurred.';
            }

            this.loading = false;
        },
    };
}
```

```blade
<div x-data="myFeature()">
    <button @click="doSomething()" :disabled="loading">
        <span x-text="loading ? 'Loading...' : 'Go'"></span>
    </button>

    <template x-if="error">
        <x-hub-ui::alert type="error"><span x-text="error"></span></x-hub-ui::alert>
    </template>

    <template x-if="results">
        {{-- Render results --}}
    </template>
</div>
```

### Laravel Controller Pattern

Return JSON from controllers:

```php
public function execute(Request $request): JsonResponse
{
    $request->validate(['query' => ['required', 'string']]);

    try {
        $results = $this->doWork($request->input('query'));
        return response()->json(['results' => $results]);
    } catch (\Throwable $e) {
        return response()->json(['error' => $e->getMessage()], 422);
    }
}
```

### GET Requests

```javascript
const { ok, data } = await hubUiFetch('/api/items', { method: 'GET' });
```

Body is not sent for GET requests.

## Theme Functions

```javascript
hubUiSetTheme('light');   // Set to light mode
hubUiSetTheme('dark');    // Set to dark mode
hubUiToggleTheme();       // Toggle between modes
hubUiGetTheme();          // Returns 'light' or 'dark'
```

Persists preference in `localStorage['hub-ui-theme']`.

## Toast Functions

```javascript
showToast('Success!', 'success');           // Green toast
showToast('Error occurred', 'error');       // Red toast
showToast('Warning', 'warning');            // Yellow toast
showToast('Info', 'info');                  // Blue toast
showToast('Custom', 'info', 20000);         // 20s duration
showToast('Manual dismiss', 'info', 0);     // No auto-dismiss
hideAllToasts();                            // Clear all
```

See [Toast documentation](components/toast.md) for details.

## Confirmation Function

```javascript
showConfirmation({
    title: 'Delete Item',
    message: 'This cannot be undone.',
    type: 'danger',          // 'danger', 'warning', 'info'
    confirmText: 'Delete',
    cancelText: 'Cancel',
    onConfirm: () => { /* ... */ },
    onCancel: () => { /* ... */ },
});
```

See [Modal documentation](components/modals.md) for details.
