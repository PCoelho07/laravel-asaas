<?php

namespace Laravel\Asaas\Customer;

use Laravel\Asaas\Support\BaseGateway;
use Http;

class CustomerGateway extends BaseGateway {
    public function __construct()
    {
        parent::__construct();

    }

    protected function path(): string
    {
        return "/customers";
    }

    /**
     * Create a new customer
     * @param CustomerDto $customer
     * @return CustomerDto Customer created
     */
    public function create(CustomerDto $customer): CustomerDto
    {
        $payload = [
            "name" => $customer->name,
            "email" => $customer->email,
            "phone" => $customer->phone,
            "mobilePhone" => $customer->mobilePhone,
            "cpfCnpj" => $customer->cpf,
            "postalCode" => $customer->postalCode,
            "address" => $customer->address,
            "addressNumber" => $customer->addressNumber,
            "complement" => $customer->complement,
            "province" => $customer->province,
            "externalReference" => $customer->externalReference,
            "notificationDisabled" => false,
            "observations" => $customer->observations
        ];

        $response = $this->makeRequest($payload, self::POST);

        $newCustomer = $response->json();

        return $this->parseCustomer($newCustomer);
    }

    /**
     * Find a customer
     * @param CustomerDto $customer
     * @return CustomerDto
     */
    public function find(CustomerDto $customer): CustomerDto
    {
        $response = $this->makeRequest([], self::GET, $customer->id);
        $customerFound = $response->json();

        return $this->parseCustomer($customerFound);
    }

    /**
     * Update a customer
     * @param string $id
     * @param CustomerDto $customer
     * @return CustomerDto
     */
    public function updateCustomer(CustomerDto $customer): CustomerDto
    {
        $payload = [
            "name" => $customer->name,
            "email" => $customer->email,
            "phone" => $customer->phone,
            "mobilePhone" => $customer->mobilePhone,
            "cpfCnpj" => $customer->cpf,
            "postalCode" => $customer->postalCode,
            "address" => $customer->address,
            "addressNumber" => $customer->addressNumber,
            "complement" => $customer->complement,
            "province" => $customer->province,
            "externalReference" => $customer->externalReference,
            "notificationDisabled" => false,
            "observations" => $customer->observations
        ];

        $response = $this->makeRequest($payload, self::POST, $customer->id);
        $customerUpdated = $response->json();

        return $this->parseCustomer($customerUpdated);
    }

    private function parseCustomer(array $customer): CustomerDto
    {
        return new CustomerDto(
            id: $customer['id'] ?? "",
            name: $customer['name'] ?? "",
            email: $customer['email'] ?? "",
            phone: $customer['phone'] ?? "",
            mobilePhone: $customer['mobilePhone'] ?? "",
            address: $customer['address'] ?? "",
            addressNumber: $customer['addressNumber'] ?? "",
            complement: $customer['complement'] ?? "",
            province: $customer['province'] ?? "",
            postalCode: $customer['postalCode'] ?? "",
            cpf: $customer['cpfCnpj'] ?? "",
            observations: $customer['observations'] ?? "",
        );
    }
}
