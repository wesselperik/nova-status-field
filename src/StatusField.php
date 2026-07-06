<?php

namespace WesselPerik\StatusField;

use Laravel\Nova\Fields\Field;

class StatusField extends Field
{
    public $showOnCreation = false;
    public $showOnUpdate = false;

    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'nova-status-field';

    /**
     * Define the icons to use for each status.
     * Accepts an array of icon => status value pairs.
     *
     * @since 2.1.0
     *
     * @return $this
     */
    public function icons(?array $icons = null): static
    {
        return $this->withMeta(['values' => $icons]);
    }

    /**
     * Add a tooltip to the field.
     *
     * @return $this
     */
    public function tooltip(string|array|\BackedEnum|null $value = null): static
    {
        return $this->withMeta([
            'tooltip' => ($value instanceof \BackedEnum) ? $value->value : $value,
        ]);
    }

    /**
     * Add some extra field information on the detail view.
     *
     * @return $this
     */
    public function info(string|array|\BackedEnum|null $value = null, bool $displayTooltip = false): static
    {
        return $this->withMeta([
            'info' => ($value instanceof \BackedEnum) ? $value->value : $value,
            'display_tooltip' => $displayTooltip,
        ]);
    }

    /**
     * Add custom color(s) to the status icon.
     * Accepts a single color, or an array of icon => color value pairs.
     *
     * @since 3.1.0
     *
     * @return $this
     */
    public function iconColor(string|array $color = 'current'): static
    {
        return $this->withMeta(['color' => $color]);
    }

    /**
     * Add custom color(s) to the status icon.
     * Accepts a single color, or an array of icon => color value pairs.
     *
     * Shorthand for iconColor().
     * 
     * @since 2.1.0
     *
     * @return $this
     */
    public function color(string|array $color = 'current'): static
    {
        return $this->iconColor($color);
    }

    /**
     * Define whether the icon should be solid or not.
     *
     * @return $this
     */
    public function solid(bool $solid = false): static
    {
        return $this->withMeta(['solid_icon' => $solid]);
    }

    /**
     * Set the background color of the tooltip popup.
     * Accepts a single color, or an array of icon => color pairs.
     *
     * Values matching a Nova palette token (e.g. "green-500") are mapped to the
     * corresponding theme variable so they respect Nova's light/dark palette;
     * any other value (hex, rgb(), hsl(), named color) is used as a raw CSS color.
     *
     * @since 3.1.0
     *
     * @return $this
     */
    public function background(string|array|null $color = null): static
    {
        return $this->withMeta(['background' => $this->resolveColorValue($color)]);
    }

    /**
     * Set the text color of the tooltip popup.
     * Accepts a single color, or an array of icon => color pairs.
     *
     * Uses the same value resolution as background(): Nova palette tokens are
     * mapped to theme variables, and any other value is used as a raw CSS color.
     *
     * @since 3.1.0
     *
     * @return $this
     */
    public function textColor(string|array|null $color = null): static
    {
        return $this->withMeta(['text_color' => $this->resolveColorValue($color)]);
    }

    /**
     * Resolve a single color, or an array of icon => color pairs, to CSS color string(s).
     */
    protected function resolveColorValue(string|array|null $color = null): string|array|null
    {
        if (is_array($color)) {
            return array_map([self::class, 'resolveColor'], $color);
        }

        return $color === null ? null : self::resolveColor($color);
    }

    /**
     * Resolve a color value to a CSS color string.
     *
     * Nova palette tokens (e.g. "green-500") become "rgba(var(--colors-green-500))";
     * everything else is returned unchanged as a raw CSS color.
     */
    public static function resolveColor(string $color): string
    {
        return preg_match('/^[a-z]+-\d{2,3}$/', $color)
            ? "rgba(var(--colors-{$color}))"
            : $color;
    }

    /**
     * Define the icon values to use for each status.
     *
     * @deprecated since version 2.1.0. Use icons() instead.
     *
     * @return $this
     */
    public function values(?array $values = null): static
    {
        return $this->withMeta([
            'values' => $this->iconAliases($values),
            'color' => [
                'x-circle' => 'red-500',
                'check-circle' => 'green-500',
                'clock' => 'blue-500',
                'info-circle' => 'primary-500',
                'exclamation-circle' => 'blue-700',
                'question-mark-circle' => 'primary-500',
                'minus-circle' => 'grey-500',
            ],
        ]);
    }

    /**
     * Get the icon aliases. Used by the deprecated values() method,
     * to support backwards compatibility.
     */
    private function iconAliases(array $values): array
    {
        $aliases = [
            'inactive' => 'x-circle',
            'active' => 'check-circle',
            'pending' => 'clock',
            'info' => 'info-circle',
            'warning' => 'exclamation-circle',
            'help' => 'question-mark-circle',
            'disabled' => 'minus-circle',
        ];

        $newValues = [];
        array_walk($values, function (&$value, $key) use ($aliases, &$newValues) {
            // replace old keys with new keys
            $newValues[$aliases[$key] ?? $key] = $value;
        });

        return $newValues;
    }
}
