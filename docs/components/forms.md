# Form Components

## Input

Text input with label, validation, and hints.

```blade
<x-hub-ui::input
    name="hostname"
    label="Hostname"
    placeholder="Enter hostname"
    hint="Use only lowercase letters and hyphens"
    required
/>
```

### Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `name` | string | **required** | Input name and id |
| `label` | string | `null` | Label text |
| `type` | string | `'text'` | HTML input type (text, email, password, number, etc.) |
| `value` | string | `null` | Default value (respects `old()` helper) |
| `placeholder` | string | `null` | Placeholder text |
| `hint` | string | `null` | Help text below input (hidden when error is shown) |
| `error` | string | `null` | Custom error message (or uses Laravel's `$errors` bag) |
| `notice` | string | `null` | Info notice (shown when no error) |
| `required` | bool | `false` | Mark as required (shows `*` after label) |
| `disabled` | bool | `false` | Disable input |
| `readonly` | bool | `false` | Read-only input |
| `autocomplete` | string | `null` | Autocomplete attribute |
| `autofocus` | bool | `false` | Auto-focus on page load |

### Validation Errors

Errors from Laravel's `$errors` bag are shown automatically:

```blade
{{-- If validation fails for 'email', the error message appears automatically --}}
<x-hub-ui::input name="email" label="Email" type="email" />
```

Priority: custom `error` prop > `$errors->first($name)`.

### CSS Classes

- `.ui-input` — base input styling
- `.ui-input-error` — error state (red border)
- `.ui-label` — label text
- `.ui-hint` — hint text
- `.ui-error` — error message text
- `.ui-required` — required asterisk

## Textarea

Multi-line text input. Same props as Input, plus `rows`.

```blade
<x-hub-ui::textarea
    name="notes"
    label="Notes"
    rows="5"
    placeholder="Enter notes..."
/>
```

### Additional Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `rows` | int | `3` | Number of visible rows |

## Select

Dropdown select with options.

```blade
<x-hub-ui::select
    name="region"
    label="Region"
    :options="['us-east' => 'US East', 'eu-west' => 'EU West']"
    placeholder="Select a region"
    required
/>
```

### Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `name` | string | **required** | Select name and id |
| `label` | string | `null` | Label text |
| `value` | string | `null` | Selected value (respects `old()`) |
| `options` | array | `[]` | Options as `[value => label]` |
| `placeholder` | string | `'Select an option'` | Placeholder option (disabled) |
| `hint` | string | `null` | Help text |
| `error` | string | `null` | Error message |
| `notice` | string | `null` | Info notice |
| `required` | bool | `false` | Mark as required |
| `disabled` | bool | `false` | Disable select |

### Dynamic Options

```blade
<x-hub-ui::select
    name="account_id"
    label="Account"
    :options="App\Models\Account::pluck('name', 'id')->toArray()"
/>
```

## Checkbox

Single checkbox with label.

```blade
<x-hub-ui::checkbox
    name="agree_terms"
    label="I agree to the terms and conditions"
    required
/>
```

### Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `name` | string | **required** | Checkbox name and id |
| `label` | string | `null` | Label text |
| `value` | string | `'1'` | Value when checked |
| `checked` | bool | `false` | Default checked state |
| `hint` | string | `null` | Help text |
| `error` | string | `null` | Error message |
| `disabled` | bool | `false` | Disable checkbox |

## Button

Styled button with variants, sizes, and loading state.

```blade
<x-hub-ui::button type="submit">
    Save Changes
</x-hub-ui::button>

<x-hub-ui::button variant="danger" onclick="confirmDelete()">
    Delete
</x-hub-ui::button>

<x-hub-ui::button href="/servers" variant="secondary">
    Cancel
</x-hub-ui::button>
```

### Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `type` | string | `'button'` | Button type (button, submit, reset) |
| `variant` | string | `'primary'` | Style variant |
| `size` | string | `'md'` | Size (sm, md, lg) |
| `disabled` | bool | `false` | Disable button |
| `loading` | bool | `false` | Show spinner (disables button) |
| `href` | string | `null` | Render as `<a>` tag (ignored when disabled) |

### Slots

| Slot | Description |
|------|-------------|
| `default` | Button text/content |
| `icon` | Optional icon (shown when not loading) |

### Variants

| Variant | Description |
|---------|-------------|
| `primary` | Solid primary color background, white text |
| `secondary` | Input background with border |
| `danger` | Solid red background, white text |
| `ghost` | Transparent, no border |
| `link` | Text-only, underline on hover |

### Button with Icon

```blade
<x-hub-ui::button>
    <x-slot:icon>
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
        </svg>
    </x-slot:icon>
    Add Server
</x-hub-ui::button>
```

### Loading State

```blade
<x-hub-ui::button type="submit" :loading="$isSubmitting">
    Save
</x-hub-ui::button>
```

When `loading` is true, the button shows a spinner and is disabled.

## Complete Form Example

```blade
<x-hub-ui::card title="Create Server">
    <form action="{{ route('servers.store') }}" method="POST">
        @csrf

        <div class="space-y-4">
            <x-hub-ui::input name="name" label="Server Name" placeholder="my-server" required />
            <x-hub-ui::select name="region" label="Region" :options="$regions" required />
            <x-hub-ui::textarea name="notes" label="Notes" rows="3" />
            <x-hub-ui::checkbox name="auto_backup" label="Enable automatic backups" :checked="true" />
        </div>

        <x-slot:footer>
            <div class="flex justify-end gap-3">
                <x-hub-ui::button href="{{ route('servers.index') }}" variant="secondary">Cancel</x-hub-ui::button>
                <x-hub-ui::button type="submit">Create Server</x-hub-ui::button>
            </div>
        </x-slot:footer>
    </form>
</x-hub-ui::card>
```
