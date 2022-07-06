<?php

namespace Laravel\Asaas\Support\Exceptions;

class UnauthorizedException extends \Exception {
    public function __construct()
    {
        parent::__construct("The API key were not sent or are invalid.", 401);
    }
}
