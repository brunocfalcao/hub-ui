# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.1.0] - 2026-02-16

### Improvements

- [IMPROVED] Sidebar — added animated sliding background tile that follows the active navigation item with smooth transitions
- [IMPROVED] Sidebar sections — removed per-item background highlights in favor of the shared sliding tile
- [IMPROVED] Sidebar links — added `name` prop and `data-nav-item` attribute for tile tracking
- [IMPROVED] Sidebar child links — click now updates highlight immediately with 300ms delay before Turbo navigation for visual feedback
- [IMPROVED] Sidebar accordion — changed collapse animation to 300ms duration (`x-collapse.duration.300ms`)

## [1.0.0] - 2026-02-02

### Added

- **Dashboard Layout** (`<x-hub-ui::layouts.dashboard>`)
  - Responsive layout with collapsible sidebar
  - Mobile-friendly with hamburger menu
  - Configurable background colors
  - Optional head and scripts slots

- **Sidebar System**
  - `<x-hub-ui::sidebar>` - Main wrapper with Alpine.js state management
  - `<x-hub-ui::sidebar.section>` - Accordion sections with collapsible children
  - `<x-hub-ui::sidebar.link>` - Navigation links with icon support
  - `<x-hub-ui::sidebar.logo>` - Default logo (configurable)
  - LocalStorage persistence for accordion state

- **Form Components**
  - `<x-hub-ui::input>` - Text input with validation and hints
  - `<x-hub-ui::select>` - Dropdown select with options
  - `<x-hub-ui::textarea>` - Multi-line text input
  - `<x-hub-ui::checkbox>` - Checkbox with label
  - `<x-hub-ui::button>` - Button with variants (primary, secondary, danger, ghost, link)

- **Display Components**
  - `<x-hub-ui::card>` - Container with title, subtitle, and footer
  - `<x-hub-ui::badge>` - Label/tag with color types and dot indicator
  - `<x-hub-ui::alert>` - Notification banner with dismissible option
  - `<x-hub-ui::status>` - Inline status indicator with animation option
  - `<x-hub-ui::page-header>` - Page title with description
  - `<x-hub-ui::empty-state>` - Placeholder for empty lists

- **Modal Components**
  - `<x-hub-ui::modal>` - Generic modal with Alpine.js
  - `<x-hub-ui::modal-confirmation>` - Pre-built confirmation dialog

- **Toast Notification System**
  - `<x-hub-ui::toast>` - Container component
  - `window.showToast()` - JavaScript API
  - `window.hideAllToasts()` - Clear all toasts
  - Stackable notifications with auto-dismiss
  - Types: success, error, warning, info

- **Dropdown Components**
  - `<x-hub-ui::dropdown>` - Click-triggered dropdown menu
  - `<x-hub-ui::dropdown-link>` - Dropdown menu item

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

[1.0.0]: https://github.com/brunocfalcao/hub-ui/releases/tag/v1.0.0
