<?php

namespace Laravel\Asaas\Support\Exceptions;

class RequestForbiddenException extends \Exception {
    public function __construct()
    {
        parent::__construct("Request not authorized. Probably use of not allowed params.", 403);
    }
}
