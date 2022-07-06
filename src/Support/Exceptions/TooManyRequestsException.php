<?php

namespace Laravel\Asaas\Support\Exceptions;

class TooManyRequestsException extends \Exception {
    public function __construct()
    {
        parent::__construct("Too many requests. Probably you reach the rate limit for today.");
    }
}
