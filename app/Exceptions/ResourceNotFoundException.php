<?php

namespace App\Exceptions;

/**
 * Class Exception
 * @package App\Common
 */
class ResourceNotFoundException extends \Exception
{
    /**
     * Create a new exception.
     *
     * @param string $message
     * @param string $code
     */
    public function __construct(string $message = 'Resource not found.', string $code = '')
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