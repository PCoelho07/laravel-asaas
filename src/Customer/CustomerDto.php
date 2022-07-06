<?php

namespace Laravel\Asaas\Customer;

class CustomerDto {
    public function __construct(
        public ?string $id = "",
        public ?string $name = "",
        public ?string $cpf = "",
        public ?string $email = "",
        public ?string $phone = "",
        public ?string $mobilePhone = "",
        public ?string $postalCode = "",
        public ?string $address = "",
        public ?string $addressNumber = "",
        public ?string $complement = "",
        public ?string $province = "",
        public ?string $externalReference = "",
        public ?string $observations = "",
    ) {}
}
