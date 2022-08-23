<?php

namespace App\Services;

use App\Http\Requests\GameTypeRequest;
use App\Repositories\GameTypeRepository;
use Illuminate\Contracts\Auth\Guard;

/**
 * Class for game type service
 *
 * @package App\Services
 *
 */
class GameTypeService extends AbstractService
{
    /**
     * PromotionService constructor.
     *
     * @param GameTypeRequest    $request
     * @param Guard            $auth
     * @param GameTypeRepository $repository
     */
    public function __construct(GameTypeRequest $request, Guard $auth, GameTypeRepository $repository)
    {
        parent::__construct($request, $auth, $repository);
    }

}
