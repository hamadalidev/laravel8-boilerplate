<?php

namespace App\Http\Requests;

use App\Models\AbstractModel;

/**
 * Interface FormRequestInterface
 * @package App\Contracts
 */
interface FormRequestInterface
{
    /**
     * tells if a model has been set
     *
     * @return bool
     */
    public function isModel(): bool;

    /**
     * get the current request model
     *
     * @return AbstractModel
     */
    public function getModel(): ?AbstractModel;

    /**
     * sets the current request model
     *
     * @param AbstractModel $model
     *
     * @return FormRequestInterface
     */
    public function setModel(AbstractModel $model): self;

    /**
     * get the current request model class
     *
     * @return string
     */
    public function getModelClass(): string;

    /**
     * sets the current request model class
     *
     * @param string $modelClass
     *
     * @return FormRequestInterface
     */
    public function setModelClass(string $modelClass): self;

    /**
     * get the route action name
     *
     * @return string
     */
    public function getActionName(): string;
}
