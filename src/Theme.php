<?php

declare(strict_types=1);

namespace HubUI;

class Theme
{
    /**
     * Generate all CSS custom property declarations for a given mode.
     */
    public static function cssVariables(string $mode = 'dark'): string
    {
        $colors = config('hub-ui.theme.colors', []);
        $semantic = self::buildSemanticVariables($colors);
        $surfaces = self::deriveSurfaces($colors, $mode);

        $vars = array_merge($semantic, $surfaces);

        return collect($vars)
            ->map(fn (string $value, string $key) => "    {$key}: {$value};")
            ->implode("\n");
    }

    /**
     * Build semantic color variables (same for both modes).
     */
    protected static function buildSemanticVariables(array $colors): array
    {
        $vars = [];

        foreach ($colors as $name => $hex) {
            $rgb = self::hexToRgb($hex);
            $vars["--ui-{$name}"] = $rgb;

            // Generate hover variant (slightly shifted lightness)
            $hoverHex = self::adjustLightness($hex, -8);
            $vars["--ui-{$name}-hover"] = self::hexToRgb($hoverHex);

            // Generate soft variant (for backgrounds/badges)
            $softHex = self::adjustLightness($hex, 15);
            $vars["--ui-{$name}-soft"] = self::hexToRgb($softHex);
        }

        return $vars;
    }

    /**
     * Derive surface, border, and text colors per mode.
     */
    protected static function deriveSurfaces(array $colors, string $mode): array
    {
        $primaryHex = $colors['primary'] ?? '#10b981';
        [$h] = self::hexToHsl($primaryHex);

        if ($mode === 'dark') {
            // Notion / Linear dark — slate-grey surfaces, not black-charcoal.
            // Lightness ladder is wide enough that body / card / input /
            // elevated each read as a distinct tier under typical screens.
            return [
                '--ui-bg-body'     => self::hslToRgb($h, 4, 13),
                '--ui-bg-sidebar'  => self::hslToRgb($h, 5, 11),
                '--ui-bg-card'     => self::hslToRgb($h, 4, 17),
                '--ui-bg-input'    => self::hslToRgb($h, 3, 20),
                '--ui-bg-elevated' => self::hslToRgb($h, 3, 23),
                '--ui-border'      => self::hslToRgb($h, 3, 28),
                '--ui-border-light' => self::hslToRgb($h, 3, 34),
                '--ui-text'        => '237 240 243',
                '--ui-text-muted'  => '170 175 185',
                '--ui-text-subtle' => '128 134 144',
                '--ui-ring-offset' => self::hslToRgb($h, 4, 13),
            ];
        }

        // Light mode
        return [
            '--ui-bg-body'     => self::hslToRgb($h, 5, 96),
            '--ui-bg-sidebar'  => self::hslToRgb($h, 5, 98),
            '--ui-bg-card'     => '255 255 255',
            '--ui-bg-input'    => '255 255 255',
            '--ui-bg-elevated' => '255 255 255',
            '--ui-border'      => self::hslToRgb($h, 3, 88),
            '--ui-border-light' => self::hslToRgb($h, 2, 92),
            '--ui-text'        => '23 23 23',
            '--ui-text-muted'  => '82 82 82',
            '--ui-text-subtle' => '140 140 140',
            '--ui-ring-offset' => self::hslToRgb($h, 5, 96),
        ];
    }

    /**
     * Convert hex color to space-separated RGB string: "16 185 129"
     */
    public static function hexToRgb(string $hex): string
    {
        $hex = ltrim($hex, '#');

        if (strlen($hex) === 3) {
            $hex = $hex[0].$hex[0].$hex[1].$hex[1].$hex[2].$hex[2];
        }

        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));

        return "{$r} {$g} {$b}";
    }

    /**
     * Convert hex to HSL array [h, s, l].
     */
    protected static function hexToHsl(string $hex): array
    {
        $hex = ltrim($hex, '#');
        $r = hexdec(substr($hex, 0, 2)) / 255;
        $g = hexdec(substr($hex, 2, 2)) / 255;
        $b = hexdec(substr($hex, 4, 2)) / 255;

        $max = max($r, $g, $b);
        $min = min($r, $g, $b);
        $l = ($max + $min) / 2;

        if ($max === $min) {
            return [0, 0, (int) round($l * 100)];
        }

        $d = $max - $min;
        $s = $l > 0.5 ? $d / (2 - $max - $min) : $d / ($max + $min);

        $h = match (true) {
            $max === $r => (($g - $b) / $d + ($g < $b ? 6 : 0)) * 60,
            $max === $g => (($b - $r) / $d + 2) * 60,
            default     => (($r - $g) / $d + 4) * 60,
        };

        return [(int) round($h), (int) round($s * 100), (int) round($l * 100)];
    }

    /**
     * Convert HSL values to space-separated RGB string.
     */
    protected static function hslToRgb(int $h, int $s, int $l): string
    {
        $s /= 100;
        $l /= 100;

        $c = (1 - abs(2 * $l - 1)) * $s;
        $x = $c * (1 - abs(fmod($h / 60, 2) - 1));
        $m = $l - $c / 2;

        [$r, $g, $b] = match (true) {
            $h < 60  => [$c, $x, 0],
            $h < 120 => [$x, $c, 0],
            $h < 180 => [0, $c, $x],
            $h < 240 => [0, $x, $c],
            $h < 300 => [$x, 0, $c],
            default  => [$c, 0, $x],
        };

        return sprintf(
            '%d %d %d',
            (int) round(($r + $m) * 255),
            (int) round(($g + $m) * 255),
            (int) round(($b + $m) * 255),
        );
    }

    /**
     * Adjust the lightness of a hex color by a percentage delta.
     */
    protected static function adjustLightness(string $hex, int $delta): string
    {
        [$h, $s, $l] = self::hexToHsl($hex);
        $l = max(0, min(100, $l + $delta));

        return self::hslToHex($h, $s, $l);
    }

    /**
     * Convert HSL values to hex string.
     */
    protected static function hslToHex(int $h, int $s, int $l): string
    {
        $rgb = self::hslToRgb($h, $s, $l);
        $parts = explode(' ', $rgb);

        return sprintf('#%02x%02x%02x', (int) $parts[0], (int) $parts[1], (int) $parts[2]);
    }
}
