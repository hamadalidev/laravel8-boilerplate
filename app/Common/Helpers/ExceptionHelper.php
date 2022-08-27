<?php

namespace App\Common\Helpers;

use App\Exceptions\AuthorizationException;
use App\Exceptions\CommonException;

/**
 * Trait ExceptionHelper
 * @package App\Common\Helpers
 */
trait ExceptionHelper
{
    /**
     * @throws AuthorizationException
     */
    public function noAuthorizationException()
    {
        throw new AuthorizationException;
    }

    /**
     * @throws CommonException
     */
    public function invalidFormDataException()
    {
        throw new CommonException('Invalid data to save');
    }

    /**
     * @throws CommonException
     */
    public function dataNotSavedException()
    {
        throw new CommonException('Data was not saved.');
    }
}