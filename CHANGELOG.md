# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.4.0] - 2026-04-20

### Features

- [NEW FEATURE] `<x-hub-ui::live-header>` — page header with title, description, subtitle, actions slot, and pulsing live indicator with auto-refresh cadence
- [NEW FEATURE] `<x-hub-ui::tabs>` — Alpine-driven tab bar with active underline, icon support via feathericons
- [NEW FEATURE] `<x-hub-ui::pager>` — pagination with first/prev/numbered/next/last and per-page selector
- [NEW FEATURE] `<x-hub-ui::stat-metric>` — labeled number tile with semantic colors and size variants
- [NEW FEATURE] `<x-hub-ui::secondary-sidebar>` — resizable flyout sidebar wrapper with drag handle
- [NEW FEATURE] `<x-hub-ui::number>` — animated counter with cubic ease-out, tabular numerics, locale formatting
- [NEW FEATURE] `<x-hub-ui::trend-delta>` — up/down/stable delta indicator with auto-colored arrows
- [NEW FEATURE] `hubUiCounter()` Alpine factory exported from the package JS entry, powers the `<number>` component
- [NEW FEATURE] `.ui-kbd` keycap utility, `.ui-tabular` tabular-nums helper, `.ui-pulse-ring` and `.ui-shimmer` animations

## [1.3.0] - 2026-04-11

### Features

- [NEW FEATURE] Gauge component (`<x-hub-ui::gauge>`) — circular progress indicator with configurable size, color, thickness, and labels

## [1.2.1] - 2026-04-06

### Improvements

- [IMPROVED] Sidebar section — fixed accordion animation using Alpine `x-collapse` instead of manual max-height transitions
- [IMPROVED] Dashboard layout — added toast container to layout
- [IMPROVED] Scripts partial — added `hubUiFetch` JS helper and toast initialization

## [1.2.0] - 2026-04-05

### Features

- [NEW FEATURE] Dynamic theme system via `Theme` class — generates CSS variables from hex config colors for both dark and light modes
- [NEW FEATURE] Theme toggle component (`<x-hub-ui::theme-toggle>`) with localStorage persistence
- [NEW FEATURE] Data table component (`<x-hub-ui::data-table>`) — simple table from arrays with row count
- [NEW FEATURE] Spinner component (`<x-hub-ui::spinner>`) — animated loading indicator
- [NEW FEATURE] Navigate fade animation (configurable via `features.navigate_fade`)

### Improvements

- [IMPROVED] Scrollbar styling — thicker 8px scrollbar with hover states, Firefox fallback via `@supports`
- [IMPROVED] Sidebar — added `activeHighlight` prop for independent tile tracking
- [IMPROVED] Configuration — restructured `theme.colors` with hex values, added `default_mode` option
- [IMPROVED] CSS utilities — added semantic color classes for all configured colors
- [IMPROVED] Documentation — complete rewrite to match actual component props and behavior

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

[1.3.0]: https://github.com/brunocfalcao/hub-ui/compare/v1.2.1...v1.3.0
[1.2.1]: https://github.com/brunocfalcao/hub-ui/compare/v1.2.0...v1.2.1
[1.2.0]: https://github.com/brunocfalcao/hub-ui/compare/v1.1.0...v1.2.0
[1.1.0]: https://github.com/brunocfalcao/hub-ui/compare/v1.0.0...v1.1.0
[1.0.0]: https://github.com/brunocfalcao/hub-ui/releases/tag/v1.0.0
