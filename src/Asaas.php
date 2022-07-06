<?php

namespace Laravel\Asaas;

use Laravel\Asaas\Customer\CustomerGateway;
use Laravel\Asaas\Recurrence\RecurrenceGateway;

class Asaas {

    public static function customer(): CustomerGateway
    {
        return new CustomerGateway();
    }

    public static function subscription(): RecurrenceGateway
    {
        return new RecurrenceGateway();
    }
}
