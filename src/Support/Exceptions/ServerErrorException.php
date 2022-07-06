<?php

namespace Laravel\Asaas\Support\Exceptions;

class ServerErrorException extends \Exception {
    public function __construct()
    {
        parent::__construct("Internal server error", 500);
    }
}
