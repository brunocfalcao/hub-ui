# Form Components

## Input

Text input with label, validation, and hints.

```blade
<x-ui::input
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
| `name` | string | **required** | Input name/id |
| `label` | string | `null` | Label text |
| `type` | string | `'text'` | Input type (text, email, password, etc.) |
| `value` | string | `null` | Default value |
| `placeholder` | string | `null` | Placeholder text |
| `hint` | string | `null` | Help text below input |
| `error` | string | `null` | Error message (or uses `$errors` bag) |
| `notice` | string | `null` | Notice message (blue text) |
| `required` | bool | `false` | Mark as required |
| `disabled` | bool | `false` | Disable input |
| `readonly` | bool | `false` | Read-only input |
| `autocomplete` | string | `null` | Autocomplete attribute |
| `autofocus` | bool | `false` | Auto-focus on page load |

### Validation Errors

The component automatically shows errors from Laravel's `$errors` bag:

```blade
{{-- If validation fails for 'email', error shows automatically --}}
<x-ui::input name="email" label="Email" type="email" />
```

## Select

Dropdown select with options.

```blade
<x-ui::select
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
| `name` | string | **required** | Select name/id |
| `label` | string | `null` | Label text |
| `value` | string | `null` | Selected value |
| `options` | array | `[]` | Options as `[value => label]` |
| `placeholder` | string | `'Select an option'` | Placeholder option |
| `hint` | string | `null` | Help text |
| `error` | string | `null` | Error message |
| `notice` | string | `null` | Notice message |
| `required` | bool | `false` | Mark as required |
| `disabled` | bool | `false` | Disable select |

### Dynamic Options

```blade
@php
$serverTypes = App\Models\ServerType::pluck('name', 'id')->toArray();
@endphp

<x-ui::select
    name="server_type_id"
    label="Server Type"
    :options="$serverTypes"
/>
```

## Textarea

Multi-line text input.

```blade
<x-ui::textarea
    name="notes"
    label="Notes"
    rows="5"
    placeholder="Enter notes..."
/>
```

### Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `name` | string | **required** | Textarea name/id |
| `label` | string | `null` | Label text |
| `value` | string | `null` | Default value |
| `placeholder` | string | `null` | Placeholder text |
| `rows` | int | `3` | Number of rows |
| `hint` | string | `null` | Help text |
| `error` | string | `null` | Error message |
| `notice` | string | `null` | Notice message |
| `required` | bool | `false` | Mark as required |
| `disabled` | bool | `false` | Disable textarea |
| `readonly` | bool | `false` | Read-only textarea |

## Checkbox

Single checkbox with label.

```blade
<x-ui::checkbox
    name="agree_terms"
    label="I agree to the terms and conditions"
    required
/>
```

### Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `name` | string | **required** | Checkbox name/id |
| `label` | string | `null` | Label text |
| `value` | string | `'1'` | Value when checked |
| `checked` | bool | `false` | Default checked state |
| `hint` | string | `null` | Help text |
| `error` | string | `null` | Error message |
| `disabled` | bool | `false` | Disable checkbox |

## Button

Styled button with variants and sizes.

```blade
<x-ui::button type="submit" variant="primary">
    Save Changes
</x-ui::button>

<x-ui::button variant="danger" onclick="confirmDelete()">
    Delete
</x-ui::button>

<x-ui::button href="/servers" variant="secondary">
    Cancel
</x-ui::button>
```

### Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `type` | string | `'button'` | Button type (button, submit, reset) |
| `variant` | string | `'primary'` | Style variant |
| `size` | string | `'md'` | Size (sm, md, lg) |
| `disabled` | bool | `false` | Disable button |
| `loading` | bool | `false` | Show loading spinner |
| `href` | string | `null` | Render as anchor link |

### Variants

- `primary` - Emerald/green background
- `secondary` - Transparent with border
- `danger` - Red background
- `ghost` - Transparent, no border
- `link` - Text link style

### Loading State

```blade
<x-ui::button
    type="submit"
    :loading="$isSubmitting"
    x-bind:disabled="isSubmitting"
>
    <span x-show="!isSubmitting">Save</span>
    <span x-show="isSubmitting">Saving...</span>
</x-ui::button>
```

## Complete Form Example

```blade
<x-ui::card title="Create Server">
    <form action="{{ route('servers.store') }}" method="POST">
        @csrf

        <div class="space-y-4">
            <x-ui::input
                name="name"
                label="Server Name"
                placeholder="my-server"
                required
            />

            <x-ui::select
                name="region"
                label="Region"
                :options="$regions"
                required
            />

            <x-ui::textarea
                name="notes"
                label="Notes"
                rows="3"
            />

            <x-ui::checkbox
                name="auto_backup"
                label="Enable automatic backups"
                :checked="true"
            />
        </div>

        <x-slot:footer>
            <div class="flex justify-end gap-3">
                <x-ui::button href="{{ route('servers.index') }}" variant="secondary">
                    Cancel
                </x-ui::button>
                <x-ui::button type="submit">
                    Create Server
                </x-ui::button>
            </div>
        </x-slot:footer>
    </form>
</x-ui::card>
```
