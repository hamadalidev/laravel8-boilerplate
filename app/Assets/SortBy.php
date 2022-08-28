<?php

namespace App\Assets;

/**
 * Class SortBy
 * @package App\Assets
 */
class SortBy
{
    /**
     * @var string
     */
    private $field;

    /**
     * @var string
     */
    private $direction;

    /**
     * @param $field
     * @param $direction
     *
     * @return SortBy
     */
    public static function make($field, $direction): SortBy
    {
        $instance = new static;
        $instance->setField($field);
        $instance->setDirection($direction);

        return $instance;
    }

    /**
     * @return string
     */
    public function getField(): string
    {
        return $this->field;
    }

    /**
     * @param string $field
     *
     * @return SortBy
     */
    public function setField(string $field): SortBy
    {
        $this->field = $field;

        return $this;
    }

    /**
     * @return string
     */
    public function getDirection(): string
    {
        return $this->direction;
    }

    /**
     * @param string $direction
     *
     * @return SortBy
     */
    public function setDirection(string $direction): SortBy
    {
        $this->direction = $direction;

        return $this;
    }
}