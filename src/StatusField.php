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
     * @param array $icons
     * @return $this
     */
    public function icons(array $icons = null)
    {
        return $this->withMeta(['values' => $icons]);
    }

    /**
     * Add a tooltip to the field.
     *
     * @param string|array|\BackedEnum $value
     * @return $this
     */
    public function tooltip(string|array|\BackedEnum $value = null)
    {
        return $this->withMeta([
            'tooltip' => ($value instanceof \BackedEnum) ? $value->value : $value,
        ]);
    }

    /**
     * Add some extra field information on the detail view.
     *
     * @param string|array|\BackedEnum $value
     * @param bool $displayTooltip
     * @return $this
     */
    public function info(string|array|\BackedEnum $value = null, bool $displayTooltip = false)
    {
        return $this->withMeta([
            'info' => ($value instanceof \BackedEnum) ? $value->value : $value,
            'display_tooltip' => $displayTooltip
        ]);
    }

    /**
     * Add custom color(s) to icons.
     * Accepts a single color, or an array of icon => color value pairs.
     * 
     * @since 2.1.0
     *
     * @param string|array $color
     * @return $this
     */
    public function color(string|array $color = 'current')
    {
        return $this->withMeta(['color' => $color]);
    }

    /**
     * Define whether the icon should be solid or not.
     *
     * @param bool $solid
     * @return $this
     */
    public function solid(bool $solid = false)
    {
        return $this->withMeta(['solid_icon' => $solid]);
    }

    /**
     * Force display on index view
     *
     * @param bool $solid
     * @return $this
     */
    public function displayInfoOnIndex($maxlength = 50)
    {
        return $this->withMeta(['info_on_index' => true, 'info_on_index_maxlength' => $maxlength ]);
    }

    /**
     * Define the icon values to use for each status.
     * 
     * @deprecated since version 2.1.0. Use icons() instead.
     * 
     * @param array $values
     * @return $this
     */
    public function values(array $values = null)
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
     * 
     * @param array $values
     * 
     * @return array
     */
    private function iconAliases(array $values)
    {
        $aliases = [
            'inactive' => 'x-circle',
            'active' => 'check-circle',
            'pending' => 'clock',
            'info' => 'info-circle',
            'warning' => 'exclamation-circle', 
            'help' => 'question-mark-circle',
            'disabled' => 'minus-circle'
        ];

        $newValues = [];
        array_walk($values, function (&$value, $key) use ($aliases, &$newValues) {
            // replace old keys with new keys
            $newValues[$aliases[$key] ?? $key] = $value;
        });

        return $newValues;
    }
}
