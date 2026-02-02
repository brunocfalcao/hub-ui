# Theming

UI Skeleton uses CSS custom properties (variables) for theming, making it easy to customize colors without modifying component files.

## CSS Custom Properties

The default theme is defined in `resources/css/ui-skeleton.css`:

```css
:root {
    /* Primary accent color (RGB values) */
    --ui-color-primary: 16 185 129;           /* emerald-500 */
    --ui-color-primary-hover: 5 150 105;      /* emerald-600 */
    --ui-color-primary-light: 110 231 183;    /* emerald-300 */

    /* Background colors */
    --ui-bg-body: 26 30 46;                   /* #1a1e2e */
    --ui-bg-sidebar: 21 24 32;               /* #151820 */
    --ui-bg-card: 26 35 50;                  /* #1a2332 */
    --ui-bg-input: 38 38 38;                 /* neutral-800 */

    /* Border colors */
    --ui-border: 64 64 64;                   /* neutral-700 */

    /* Text colors */
    --ui-text: 245 245 245;                  /* neutral-100 */
    --ui-text-muted: 163 163 163;            /* neutral-400 */
}
```

## Customizing Colors

Override these variables in your application's CSS:

```css
/* resources/css/app.css */
@import './vendor/ui-skeleton/ui-skeleton.css';

:root {
    /* Change primary color to blue */
    --ui-color-primary: 59 130 246;           /* blue-500 */
    --ui-color-primary-hover: 37 99 235;      /* blue-600 */
    --ui-color-primary-light: 147 197 253;    /* blue-300 */

    /* Darker background */
    --ui-bg-body: 15 23 42;                   /* slate-900 */
}
```

## Color Values

CSS custom properties use RGB values without the `rgb()` wrapper. This allows Tailwind's opacity modifiers to work:

```css
/* These RGB values... */
--ui-color-primary: 16 185 129;

/* ...can be used like this in Tailwind */
.custom-class {
    background-color: rgb(var(--ui-color-primary));
    background-color: rgb(var(--ui-color-primary) / 0.5); /* 50% opacity */
}
```

## Tailwind Integration

You can reference these variables in your Tailwind config:

```javascript
// tailwind.config.js
module.exports = {
    theme: {
        extend: {
            colors: {
                'ui-primary': 'rgb(var(--ui-color-primary) / <alpha-value>)',
                'ui-body': 'rgb(var(--ui-bg-body) / <alpha-value>)',
            },
        },
    },
}
```

Then use in your templates:

```blade
<div class="bg-ui-primary text-white">
    Custom themed element
</div>
```

## Common Color Schemes

### Blue Theme
```css
:root {
    --ui-color-primary: 59 130 246;
    --ui-color-primary-hover: 37 99 235;
    --ui-color-primary-light: 147 197 253;
}
```

### Purple Theme
```css
:root {
    --ui-color-primary: 168 85 247;
    --ui-color-primary-hover: 147 51 234;
    --ui-color-primary-light: 216 180 254;
}
```

### Rose Theme
```css
:root {
    --ui-color-primary: 244 63 94;
    --ui-color-primary-hover: 225 29 72;
    --ui-color-primary-light: 253 164 175;
}
```

## Dynamic Tailwind Classes

The `<x-ui::status>` component uses dynamic Tailwind classes. Add a safelist to your Tailwind config:

```javascript
// tailwind.config.js
module.exports = {
    safelist: [
        { pattern: /^(bg|text)-(red|green|blue|yellow|gray|emerald|amber)-(300|400|500)$/ },
    ],
}
```

## Dark Mode Only

UI Skeleton is designed as a dark-theme-only package. If you need light mode support, you'll need to:

1. Publish the views: `php artisan vendor:publish --tag=ui-skeleton-views`
2. Modify the components to support `dark:` variants
3. Update the CSS custom properties with `@media (prefers-color-scheme: light)` overrides
