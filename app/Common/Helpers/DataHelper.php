<?php

namespace App\Common\Helpers;

use Illuminate\Http\Request;

/**
 * Trait RequestHelper
 * @package App\Common\Helpers
 */
trait DataHelper
{
    /**
     * @var array
     */
    private $formFields = [];

    /**
     * @var array
     */
    private $appendedData = [];

    /**
     * @var array
     */
    private $replacedData = [];

    /**
     * @return array
     */
    public function getFormFields(): array
    {
        return $this->formFields;
    }

    /**
     * @param array $formFields
     *
     * @return DataHelper
     */
    public function setFormFields(array $formFields): self
    {
        $this->formFields = $formFields;

        return $this;
    }

    /**
     * @param array $formFields
     *
     * @return DataHelper
     */
    public function addFormFields(array $formFields): self
    {
        $this->formFields = array_merge($this->getFormFields(), $formFields);

        return $this;
    }

    /**
     * @return array
     */
    public function getAppendedData(): array
    {
        return $this->appendedData;
    }

    /**
     * @param array $appendedData
     *
     * @return DataHelper
     */
    public function setAppendedData(array $appendedData): self
    {
        $this->appendedData = $appendedData;

        return $this;
    }

    /**
     * @return array
     */
    public function getReplacedData(): array
    {
        return $this->replacedData;
    }

    /**
     * @param array $replacedData
     *
     * @return DataHelper
     */
    public function setReplacedData(array $replacedData): self
    {
        $this->replacedData = $replacedData;

        return $this;
    }

    /**
     *
     * @return array
     */
    public function processFields(): array
    {
        $data        = [];
        $replaceData = $this->getReplacedData();
        $fields      = $this->getFormFields();

        foreach ($fields as $property => $value) {
            if (is_null($value)) {
                continue;
            }

            if (array_key_exists($property, $replaceData)) {
                $replaceValue = ($replaceData[$property] instanceof \Closure) ? $replaceData[$property]($value, $fields) : $replaceData[$property];

                if ($replaceValue instanceof DataReplacerModel) {
                    $property = $replaceValue->property;
                    $value    = $replaceValue->value;
                } else {
                    $value = $replaceValue;
                }
            }

            if (!is_null($value)) {
                $data[$property] = $value;
            }
        }

        return $data;
    }

    /**
     * @param Request $request
     * @param array   $fields
     *
     * @return array
     */
    public function getRequestFields(Request $request, array $fields): array
    {
        $data = [];
        foreach ($fields as $name => $defaultValue) {
            $data[$name] = $this->getRequestField($request, $name, $defaultValue);
        }

        return $data;
    }

    /**
     * @param Request $request
     * @param         $name
     * @param string  $defaultValue
     *
     * @return bool|null
     */
    public function getRequestField(Request $request, $name, $defaultValue = null)
    {
        $value = $request->has($name) ? $request->input($name) : null;

        return is_null($value) ? $defaultValue : $value;
    }
}