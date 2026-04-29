# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.6.3] - 2026-04-29

### Improvements

- [IMPROVED] `<x-hub-ui::input>`, `<x-hub-ui::select>`, `<x-hub-ui::textarea>` — hint, notice, and error helper text gets an inline icon + smaller (11px) layout with `leading-snug` and `flex items-start`. Info-circle for hint/notice, warning triangle for error. Helper messages now read as compact metadata rather than another body paragraph.
- [IMPROVED] `<x-hub-ui::sidebar.section>` — parent toggle button stamps `data-nav-item` and updates `highlight` on click. The sliding highlight tile now lands on the section parent when no child is active yet, giving a continuous slide animation when the operator hops between sections.

## [1.6.2] - 2026-04-26

### Features

- [NEW FEATURE] `<x-hub-ui::layouts.dashboard>` exposes a `topbar` slot rendered above the scrollable content (sticky border-bottom strip, `ui-bg-sidebar` background) — used by admin.kraite.com for the global navbar (user, theme toggle, profile, logout, notifications).
- [NEW FEATURE] `<x-hub-ui::layouts.dashboard>` exposes a `footerbar` slot rendered below the scrollable content (sticky border-top strip, `ui-bg-sidebar` background) — used for version, disclaimer, and helper links.

### Improvements

- [IMPROVED] `<x-hub-ui::sidebar>` always renders the `mt-auto` footer spacer so the nav vertically centers regardless of whether the consumer passes a `footer` slot. Previously the nav slid to the bottom of the column when the footer was omitted.
- [IMPROVED] `<x-hub-ui::select>` strips browser-default chrome (`appearance: none`) and stamps an inline SVG chevron via background-image. Adds `text-overflow: ellipsis` + `cursor: pointer` so long option labels truncate cleanly and the cursor reads as interactive on hover.

## [1.6.1] - 2026-04-26

### Improvements

- [IMPROVED] Dark palette retuned to a Notion / Linear slate-grey ladder. `bg-body` lifted from 5% → 13% lightness, `bg-card` 9% → 17%, `bg-input` 12% → 20%, `bg-elevated` 14% → 23%, `border` 20% → 28%. Each surface now reads as a distinct tier instead of collapsing into near-black.
- [IMPROVED] `<x-hub-ui::input>` / `<textarea>` / `<select>` focus state replaced with a soft 3px primary glow + faint border tint (was the high-contrast Tailwind `--tw-ring-2` outline). Removed `focus:ring-2 focus:ring-offset-2 shadow-sm` from the component class lists; focus is now CSS-driven via `.ui-input:focus` so the visual ramp stays consistent.
- [IMPROVED] `.ui-sidebar-tile` recoloured to the brand primary at 12% alpha + 22% border tint — the sliding highlight is no longer a neutral elevated grey.
- [IMPROVED] `<x-hub-ui::sidebar>` initial-paint reliability — the initial-highlight tile now polls position for ~400ms (`trackTile()`) instead of one-shot `updateTile()` in `nextTick()`. Fixes the "no tile rendered" race when the active highlight lives inside an `x-collapse`d section that's still animating open on first paint.
- [IMPROVED] `<x-hub-ui::layouts.dashboard>` stamps the theme class on `<html>` server-side (`config('hub-ui.theme.default_mode')`) so first paint matches the resolved theme — no flash of dark before the inline script runs.

### Fixes

- [BUG FIX] `confirmation.js` no longer logs "Confirmation modal not found in DOM" when consumers (e.g. login) intentionally omit the confirmation modal. Silent no-op instead of console warning.

### Breaking

- [SECURITY] LocalStorage theme key bumped from `hub-ui-theme` → `hub-ui-theme-v2` to invalidate stale dark/light selections from the prior palette. Fresh visitors honour `config('hub-ui.theme.default_mode')`.

## [1.6.0] - 2026-04-23

### Features

- [NEW FEATURE] `<x-hub-ui::progress-bar>` — segmented tick progress bar. Alpine-expression value, configurable tick count / width / height / gap, stale + empty states, same color ramp as speedometer.
- [NEW FEATURE] `<x-hub-ui::pulse-dot>` — standalone colored dot primitive with optional ping ring. Uses `absolute inset-0` so ring + solid dot stay perfectly concentric regardless of parent layout.

### Improvements

- [IMPROVED] `<x-hub-ui::switch>` rewrite — explicit pixel-sized pill track with absolutely-positioned thumb that slides between two `left` values. Fixes Alpine string-`:style` overwriting the inline static style (which previously collapsed the track dimensions when inactive). Object-form `:style` merges instead of replaces.
- [IMPROVED] `<x-hub-ui::badge>` — bumped inner padding (sm `px-2.5 py-1`, md `px-3 py-1`, lg `px-4 py-1.5`) for better visual weight; added `whitespace-nowrap` so multi-word labels like "DB only" don't wrap inside tight columns.
- [IMPROVED] `<x-hub-ui::data-table>` — header cells now default to `text-align: left` (with opt-in `text-center` / `text-right` class overrides) so values and headers align under the same gutter.
- [IMPROVED] `<x-hub-ui::modal>` — dropped the `sm:` prefix from `w-full` / `mx-auto` so modals size correctly on mobile viewports.
- [IMPROVED] `<x-hub-ui::toast>` container — spans left-to-right edge with `max-w-full` on mobile, docks to the right with `max-w-sm` from sm+. Long toasts no longer extend off-screen.
- [IMPROVED] `<x-hub-ui::empty-state>` — responsive vertical padding (`py-8 sm:py-12 md:py-16`) + horizontal `px-4` so tiny screens don't burn 128px of dead space.

### Fixes

- [BUG FIX] Global caret/selection defaults — `body { user-select: none; caret-color: transparent }` with opt-in for inputs, textareas, code/pre, and `.ui-table td/th`. Stops the "blinking cursor appears wherever I click" behaviour reported after the sidebar / store refactor.

## [1.5.0] - 2026-04-22

### Features

- [NEW FEATURE] `<x-hub-ui::speedometer>` — horizontal progress speedometer with live/stale/empty tri-state rendering; Alpine expression props let it drop straight into `x-for` loops
- [NEW FEATURE] `registerSidebarStore()` Alpine factory — global `$store.sidebar` replaces scope-bound `sidebarOpen` so wire:navigate + `@persist` swaps don't strand bindings

### Improvements

- [IMPROVED] Primary sidebar mobile drawer: keyboard Escape dismiss, auto-close on `livewire:navigated`, aria-expanded/aria-label, defensive CSS transitions before Alpine boots
- [IMPROVED] Secondary sidebar gained a mobile toggle + overlay flyout for sub-lg screens
- [IMPROVED] Dashboard layout content padding is now responsive (`px-4 py-6 pt-16 sm:px-6 sm:py-8 lg:px-12 lg:py-12`)
- [IMPROVED] `<x-hub-ui::live-header>` wraps actions and hides descriptive subtext on mobile to keep the header compact
- [IMPROVED] `<x-hub-ui::page-header>` uses responsive heading sizing (`text-3xl sm:text-4xl lg:text-5xl`)

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
