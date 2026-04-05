# Theming

Hub UI uses a dynamic CSS custom property system. Define your brand colors as hex values in config, and the `Theme` class generates all surface, border, and text variables automatically for both dark and light modes.

## How It Works

1. You set hex colors in `config/hub-ui.php` under `theme.colors`
2. `Theme::cssVariables($mode)` generates CSS variables at runtime
3. Variables are injected via the `styles.blade.php` partial
4. Dark mode uses `:root`, light mode uses `:root.light`

## CSS Custom Properties

### Semantic Colors (same in both modes)

For each configured color (primary, secondary, success, warning, danger, info):

| Variable | Description |
|----------|-------------|
| `--ui-{name}` | Base color as RGB (e.g., `16 185 129`) |
| `--ui-{name}-hover` | Darker variant (lightness - 8) |
| `--ui-{name}-soft` | Lighter variant (lightness + 15) |

### Surface Colors (mode-dependent)

| Variable | Dark Mode | Light Mode |
|----------|-----------|------------|
| `--ui-bg-body` | Very dark (5% L) | Very light (96% L) |
| `--ui-bg-sidebar` | Darker than body (4% L) | Lighter than body (98% L) |
| `--ui-bg-card` | Slightly lighter (9% L) | White |
| `--ui-bg-input` | Input background (12% L) | White |
| `--ui-bg-elevated` | Elevated surface (14% L) | White |
| `--ui-border` | Subtle border (20% L) | Light border (88% L) |
| `--ui-border-light` | Lighter border (26% L) | Very light border (92% L) |
| `--ui-text` | Light (`245 245 245`) | Dark (`23 23 23`) |
| `--ui-text-muted` | Medium (`163 163 163`) | Medium (`82 82 82`) |
| `--ui-text-subtle` | Dim (`115 115 115`) | Dim (`140 140 140`) |
| `--ui-ring-offset` | Same as body | Same as body |

Surface colors are derived from the primary color's hue, giving a subtle brand tint.

## Using CSS Variables

All values are RGB without the `rgb()` wrapper, enabling Tailwind opacity modifiers:

```css
/* Solid color */
background-color: rgb(var(--ui-primary));

/* With opacity */
background-color: rgb(var(--ui-primary) / 0.12);

/* In Tailwind arbitrary values */
<div class="bg-[rgb(var(--ui-primary)/0.1)]">
```

## CSS Utility Classes

### Surfaces
`.ui-bg-body`, `.ui-bg-sidebar`, `.ui-bg-card`, `.ui-bg-input`, `.ui-bg-elevated`

### Borders
`.ui-border`, `.ui-border-light`

### Text
`.ui-text`, `.ui-text-muted`, `.ui-text-subtle`

### Semantic Colors
For each color (primary, secondary, success, warning, danger, info):
- `.ui-text-{color}` — text color
- `.ui-bg-{color}` — background color

## Dark/Light Mode

The theme toggle is built in via `<x-hub-ui::theme-toggle />`. It:

1. Toggles the `light` class on `<html>`
2. Persists preference in `localStorage['hub-ui-theme']`
3. Runs a synchronous script to prevent FOUC

### JavaScript API

```javascript
window.hubUiSetTheme('light');  // Set to light mode
window.hubUiSetTheme('dark');   // Set to dark mode
window.hubUiToggleTheme();      // Toggle between modes
window.hubUiGetTheme();         // Returns 'light' or 'dark'
```

## Customizing Colors

Change the brand colors in config:

```php
// config/hub-ui.php
'theme' => [
    'colors' => [
        'primary' => '#3b82f6', // Blue
        // ... other colors
    ],
],
```

All surface colors, hover states, and soft variants are derived automatically.

## Blade Directives

If building a custom layout without the dashboard component:

```blade
@hubUiStyles   {{-- Outputs theme CSS variables --}}
@hubUiScripts  {{-- Outputs theme toggle JavaScript --}}
```
