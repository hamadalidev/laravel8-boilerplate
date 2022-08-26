<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException as ParentException;

/**
 * Class Exception
 * @package App\Common
 */
class AuthorizationException extends ParentException
{
    /**
     * Create a new authentication exception.
     *
     * @param string $message
     * @param string $code
     */
    public function __construct(string $message = 'This action is unauthorized.', string $code = '')
    {
        parent::__construct($message);
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        return $request->expectsJson()
            ? response()->json(['message' => $this->getMessage()], 401)
            : redirect()->guest(route('login'));
    }
}