<?php

namespace App\Exceptions;

use App\Helpers\ResponseFormatter;
use Termwind\Components\Dd;

class InvariantError extends ClientError
{
    public function __construct($message)
    {
        $this->message = $message;
        $this->code = 400;
        $this->name = 'InvariantError';
    }

    public function render()
    {
        // dd($this->message);
        return parent::render();
    }
}
