<?php

namespace App\Exceptions\Api;

use Exception;
use Illuminate\Http\Request;

class InvalidRequestException extends Exception
{
    public function __construct($message = '', $code = 400)
    {
        parent::__construct($message, $code);
    }

    public function render(Request $request)
    {
        return response()->json(['message' => $this->message], $this->code);
    }
}
