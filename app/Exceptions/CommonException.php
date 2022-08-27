<?php

namespace App\Exceptions;

/**
 * Class Exception
 * @package App\Common
 */
class CommonException extends \Exception
{
    /**
     * Create a new exception.
     *
     * @param string $message
     * @param string $code
     */
    public function __construct(string $message = 'Invalid coupon.')
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
            ? response()->json(['message' => $this->getMessage()], 400)
            : redirect()->guest(route('login'));
    }
}