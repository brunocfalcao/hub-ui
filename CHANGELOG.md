# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.0.0] - 2026-02-02

### Added

- **Dashboard Layout** (`<x-ui::layouts.dashboard>`)
  - Responsive layout with collapsible sidebar
  - Mobile-friendly with hamburger menu
  - Configurable background colors
  - Optional head and scripts slots

- **Sidebar System**
  - `<x-ui::sidebar>` - Main wrapper with Alpine.js state management
  - `<x-ui::sidebar.section>` - Accordion sections with collapsible children
  - `<x-ui::sidebar.link>` - Navigation links with icon support
  - `<x-ui::sidebar.logo>` - Default logo (configurable)
  - LocalStorage persistence for accordion state

- **Form Components**
  - `<x-ui::input>` - Text input with validation and hints
  - `<x-ui::select>` - Dropdown select with options
  - `<x-ui::textarea>` - Multi-line text input
  - `<x-ui::checkbox>` - Checkbox with label
  - `<x-ui::button>` - Button with variants (primary, secondary, danger, ghost, link)

- **Display Components**
  - `<x-ui::card>` - Container with title, subtitle, and footer
  - `<x-ui::badge>` - Label/tag with color types and dot indicator
  - `<x-ui::alert>` - Notification banner with dismissible option
  - `<x-ui::status>` - Inline status indicator with animation option
  - `<x-ui::page-header>` - Page title with description
  - `<x-ui::empty-state>` - Placeholder for empty lists

- **Modal Components**
  - `<x-ui::modal>` - Generic modal with Alpine.js
  - `<x-ui::modal-confirmation>` - Pre-built confirmation dialog

- **Toast Notification System**
  - `<x-ui::toast>` - Container component
  - `window.showToast()` - JavaScript API
  - `window.hideAllToasts()` - Clear all toasts
  - Stackable notifications with auto-dismiss
  - Types: success, error, warning, info

- **Dropdown Components**
  - `<x-ui::dropdown>` - Click-triggered dropdown menu
  - `<x-ui::dropdown-link>` - Dropdown menu item

- **CSS Theming**
  - Custom properties for colors
  - Dark theme by default
  - Custom scrollbar styling
  - Alpine.js x-cloak support

- **Configuration System**
  - Customizable component prefix
  - App name and logo settings
  - Theme primary color
  - Feature toggles (toast, confirmation)
  - Sidebar width and persistence settings
  - Layout colors

- **Documentation**
  - Installation guide
  - Configuration reference
  - Theming guide
  - Component documentation with examples

### Dependencies

- PHP 8.2+
- Laravel 11 or 12
- Alpine.js 3.x (with collapse plugin)
- Tailwind CSS 3.x

[1.0.0]: https://github.com/brunocfalcao/ui-skeleton/releases/tag/v1.0.0
