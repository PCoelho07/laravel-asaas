<?php

namespace Laravel\Asaas\Support\Exceptions;

class NotFoundException extends \Exception {
    public function __construct()
    {
        parent::__construct("The resource requested does not exists.", 404);
    }
}
