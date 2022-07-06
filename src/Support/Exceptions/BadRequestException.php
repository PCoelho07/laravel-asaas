<?php

namespace Laravel\Asaas\Support\Exceptions;

class BadRequestException extends \Exception {
    public function __construct(private array $errors)
    {
        parent::__construct("Some required params were not sent or are invalid.", 400);
    }

    public function errors(): array
    {
        return $this->errors;
    }
}
