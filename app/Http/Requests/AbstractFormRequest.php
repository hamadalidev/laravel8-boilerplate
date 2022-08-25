<?php

namespace App\Http\Requests;

use App\Exceptions\AuthorizationException;
use App\Models\AbstractModel;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

/**
 * Class AbstractFormRequest
 * @package App\Http\Requests
 */
abstract class AbstractFormRequest extends FormRequest implements FormRequestInterface
{
    /**
     * @var AbstractModel
     */
    protected $model = null;

    /**
     * @var string
     */
    protected $modelClass;

    /**
     * @var string
     */
    protected string $actionName;

    /**
     * @var array
     */
    protected array $allowedActions = [];

    /**
     * @var array
     */
    protected array $publicActions = [];

    /**
     * @var array
     */
    protected array $aliasActions = [
        'tables'  => 'index',
        'home'    => 'index',
        'display' => 'show',
        'search'  => 'index',
        'restore' => 'update'
    ];

    /**
     * @var string
     */
    protected string $originalAction;

    /**
     * @return bool
     */
    public function isModel(): bool
    {
        return !empty($this->model);
    }

    /**
     * @return AbstractModel
     */
    public function getModel(): ?AbstractModel
    {
        return $this->model;
    }

    /**
     * @param AbstractModel $model
     *
     * @return FormRequestInterface
     */
    public function setModel(AbstractModel $model): FormRequestInterface
    {
        $this->model = $model;

        return $this;
    }

    /**
     * @return string
     */
    public function getModelClass(): string
    {
        return $this->modelClass;
    }

    /**
     * @param string $modelClass
     *
     * @return FormRequestInterface
     */
    public function setModelClass(string $modelClass): FormRequestInterface
    {
        $this->modelClass = $modelClass;

        return $this;
    }

    /**
     * @return string
     * @throws AuthorizationException
     */
    public function getActionName(): string
    {
        if (empty($this->actionName)) {
            $this->actionName = $this->detectActionName();
        }

        if (!$this->isActionAllowed()) {
            $this->failedAuthorization();
        }

        return $this->actionName;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     * @throws AuthorizationException
     */
    public function rules(): array
    {
        switch ($this->getActionName()) {
            case 'update':
                return $this->updateRules();
            case 'store':
                return $this->storeRules();
            default:
                return [];
        }
    }

    /**
     * @param string $actionName
     *
     * @return bool
     */
    protected function isAuthorized(string $actionName): bool
    {
        return Gate::forUser($this->user())->allows($actionName, $this->isModel() ? $this->getModel() : $this->getModelClass());
    }

    /**
     * Handle a failed authorization attempt.
     *
     * @return void
     *
     * @throws AuthorizationException
     */
    protected function failedAuthorization()
    {
        throw new AuthorizationException();
    }

    /**
     * @return array
     */
    protected function globalRules(): array
    {
        return [];
    }

    /**
     * @return array
     */
    protected function storeRules(): array
    {
        return $this->globalRules();
    }

    /**
     * @return array
     */
    protected function updateRules(): array
    {
        return $this->globalRules();
    }

    /**
     * @param array $rules
     * @param array $requiredFields
     * @param array $skipFields
     *
     * @return array
     */
    protected function addRequiredRule(array $rules = [], array $requiredFields = [], $skipFields = []): array
    {
        if (empty($requiredFields)) {
            $requiredFields = array_keys($rules);
        }

        foreach ($requiredFields as $field) {
            if (!array_key_exists($field, $rules) || in_array($field, $skipFields)) {
                continue;
            }

            array_unshift($rules[$field], 'required');
        }

        return $rules;
    }

    /**
     * @return bool
     */
    protected function isSiteRequest(): bool
    {
        return $this->hasSession();
    }

    /**
     * @return bool
     */
    protected function isActionAuthorized(): bool
    {
        return ($this->isSiteRequest() && in_array($this->actionName, $this->publicActions)) ? true : $this->isAuthorized($this->actionName);
    }

    /**
     * @return bool
     */
    protected function isActionAllowed(): bool
    {
        if (array_get($this->allowedActions, 0) === '*') {
            return true;
        }

        return in_array($this->actionName, $this->allowedActions);
    }

    /**
     * @return bool
     */
    protected function isRestoreAction(): bool
    {
        return ($this->originalAction === 'restore');
    }

    /**
     * @return string
     * @throws AuthorizationException
     */
    private function detectActionName(): string
    {
        $namespace = explode('.', $this->route()->getName());
        $action    = end($namespace);

        if (empty($action)) {
            $this->failedAuthorization();
        }

        $this->originalAction = $action;

        if (array_key_exists($action, $this->aliasActions)) {
            $action = $this->aliasActions[$action];
        }

        return $action;
    }
}
