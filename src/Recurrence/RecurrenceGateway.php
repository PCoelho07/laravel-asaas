<?php

namespace Laravel\Asaas\Recurrence;

use Laravel\Asaas\Support\BaseGateway;

class RecurrenceGateway extends BaseGateway {

    public function __construct()
    {
        parent::__construct();
    }

    public function path(): string
    {
        return '/subscriptions';
    }

    /**
     * Create a new subscription
     * @param RecurrenceDto $recurrence
     * @return RecurrenceDto
     */
    public function create(RecurrenceDto $recurrence): RecurrenceDto
    {
        $payload = [
            "description" => $recurrence->description ?? "",
            "customer" => $recurrence->customerId,
            "billingType" => $recurrence->billingType,
            "nextDueDate" => $recurrence->nextDueDate,
            "value" => $recurrence->value,
            "cycle" => $recurrence->cycle,
            "description" => $recurrence->description,
            "creditCard" => [
                "holderName" => $recurrence->creditCardHolderName,
                "number" => $recurrence->creditCardNumber,
                "expiryMonth" => $recurrence->creditCardExpiryMonth,
                "expiryYear" => $recurrence->creditCardExpiryYear,
                "ccv" => $recurrence->creditCardCvv
            ],
            "creditCardHolderInfo" => [
                "name" => $recurrence->creditCardHolderInfoName,
                "email" => $recurrence->creditCardHolderInfoEmail,
                "cpfCnpj" => $recurrence->creditCardHolderInfoCpfCnpj,
                "postalCode" => $recurrence->creditCardHolderInfoPostalCode,
                "addressNumber" => $recurrence->creditCardHolderInfoAddressNumber,
                "addressComplement" => null,
                "phone" => $recurrence->creditCardHolderInfoPhone,
                "mobilePhone" => $recurrence->creditCardHolderInfoPhone
            ],
            "creditCardToken" => $recurrence->creditCardToken
        ];

        $response = $this->makeRequest($payload, self::POST);

        $newSubscription = $response->json();
        return $this->parseRecurrenceDto($newSubscription);
    }

    /**
     * Delete a subscription
     * @param string $id
     * @return void
     */
    public function delete(string $id)
    {
        $this->makeRequest([], self::DELETE, $id);
    }

    /**
     * Parse to DTO
     * @param array $params
     * @return RecurrenceDto
     */
    public function parseRecurrenceDto(array $params): RecurrenceDto
    {
        return new RecurrenceDto(
            id: $params['id'],
            customerId: $params['customer'],
            billingType: $params['billingType'],
            value: $params['value'],
            cycle: $params['cycle'],
            creditCardHolderName: $params['creditCardHolderName'] ?? "",
            creditCardToken: $params['creditCard']['creditCardToken'] ?? "",
            creditCardNumber: $params['creditCard']['creditCardNumber'] ?? "",
            creditCardExpiryMonth: $params['creditCardExpiryMonth'] ?? "",
            creditCardExpiryYear: $params['creditCardExpiryYear'] ?? "",
            creditCardCvv: $params['creditCardCvv'] ?? "",
            creditCardHolderInfoName: $params['creditCardHolderInfoName'] ?? "",
            creditCardHolderInfoEmail: $params['creditCardHolderInfoEmail'] ?? "",
            creditCardHolderInfoCpfCnpj: $params['creditCardHolderInfoCpfCnpj'] ?? "",
            creditCardHolderInfoPostalCode: $params['creditCardHolderInfoPostalCode'] ?? "",
            creditCardHolderInfoAddressNumber: $params['creditCardHolderInfoAddressNumber'] ?? "",
            creditCardHolderInfoPhone: $params['creditCardHolderInfoPhone'] ?? "",
            remoteIp: $params['remoteIp'] ?? "",
            nextDueDate: $params['nextDueDate'] ?? "",
        );
    }
}
