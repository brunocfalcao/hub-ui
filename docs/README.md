# Hub UI Documentation

Reusable Laravel admin panel UI components with dark/light theming, Alpine.js, and Tailwind CSS.

## Table of Contents

1. [Installation](installation.md) — Getting started
2. [Configuration](configuration.md) — All config options
3. [Theming](theming.md) — Colors, dark/light mode, CSS variables
4. **Components**
   - [Layouts](components/layouts.md) — Dashboard layout
   - [Sidebar](components/sidebar.md) — Navigation sidebar
   - [Forms](components/forms.md) — Input, Select, Textarea, Checkbox, Button
   - [Display](components/display.md) — Card, Badge, Alert, Status, Page Header, Empty State, Spinner, Data Table, Dropdown
   - [Modals](components/modals.md) — Modal and Confirmation Dialog
   - [Toast](components/toast.md) — Toast Notifications

## Quick Start

```blade
<x-hub-ui::layouts.dashboard title="My App">
    <x-slot:sidebar>
        <x-hub-ui::sidebar activeSection="dashboard">
            {{-- Navigation items --}}
        </x-hub-ui::sidebar>
    </x-slot:sidebar>

    <x-hub-ui::page-header title="Dashboard" description="Welcome back." />

    <x-hub-ui::card title="Stats">
        <p class="ui-text">Content here.</p>
    </x-hub-ui::card>
</x-hub-ui::layouts.dashboard>
```
