<?php

namespace WesselPerik\StatusField;

use Laravel\Nova\Fields\Field;

class StatusField extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'status-field';

    /**
     * Map the values to custom attributes or conditions.
     *
     * @param array $values
     * @return $this
     */
    public function values(array $values = null)
    {
        return $this->withMeta(['values' => $values]);
    }
}
