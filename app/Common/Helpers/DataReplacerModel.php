<?php

namespace App\Common\Helpers;

/**
 * Class DataReplacerModel
 * @package App\Common\Helpers
 */
class DataReplacerModel
{
    /**
     * @var string
     */
    public $property;

    /**
     * @var mixed
     */
    public $value;

    public static function create(string $property, $value): DataReplacerModel
    {
        $instance           = new static;
        $instance->property = $property;
        $instance->value    = $value;

        return $instance;
    }
}