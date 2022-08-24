<?php

namespace App\Http\Requests;

use App\Exceptions\AuthorizationException;
use App\Models\GameType;
use App\Repositories\GameTypeRepository;
use Illuminate\Validation\Rule;

class GameTypeRequest
{
    /**
     * @var array
     */
    protected array $allowedActions = [
        'index',
        'show',
        'store',
        'update',
        'destroy'
    ];

    /**
     * @var string
     */
    private string $ownModelParam = 'gameType';

    /**
     * @param GameTypeRepository $repository
     *
     * @return bool
     * @throws AuthorizationException
     */
    public function authorize(GameTypeRepository $repository): bool
    {
        $this->getActionName();

        switch ($this->actionName) {
            case 'show':
            case 'update':
            case 'destroy':
                $this->setModel($repository->getByIdOrFail($this->route($this->ownModelParam)));
                break;
            default:
                $this->setModelClass(get_class($repository->getResource()));
                break;
        }

        return $this->isActionAuthorized();
    }

    protected function globalRules(): array
    {
        return [
            'name'             => ['string', 'max:250']
        ];
    }

    /**
     * @return array
     */
    protected function storeRules(): array
    {
        return $this->addRequiredRule(
            $this->globalRules(),
            [],
            [
            ]
        );
    }
}

