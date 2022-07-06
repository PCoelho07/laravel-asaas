<?php

namespace Laravel\Asaas\Recurrence;

class RecurrenceDto {

    const BANK_SLIP = 'BOLETO';
    const CREDIT_CARD = 'CREDIT_CARD';
    const PIX = 'PIX';

    const CYCLE_WEEKLY = 'WEEKLY';
    const CYCLE_BIWEEKLY = 'BIWEEKLY';
    const CYCLE_MONTHLY = 'MONTHLY';
    const CYCLE_QUARTERLY = 'QUARTERLY';
    const CYCLE_SEMIANNUALLY = 'SEMIANNUALLY';
    const CYCLE_YEARLY = 'YEARLY';

    public function __construct(
        public string $customerId = "",
        public string $billingType,
        public float $value,
        public string $cycle,
        public string $creditCardHolderName,
        public string $creditCardNumber,
        public string $creditCardExpiryMonth,
        public string $creditCardExpiryYear,
        public string $creditCardCvv,
        public string $creditCardHolderInfoName,
        public string $creditCardHolderInfoEmail,
        public string $creditCardHolderInfoCpfCnpj,
        public string $creditCardHolderInfoPostalCode,
        public string $creditCardHolderInfoAddressNumber,
        public string $creditCardHolderInfoPhone,
        public string $remoteIp,
        public string $nextDueDate,
        public ?string $id = "",
        public ?string $description = "",
        public ?string $endDate = "",
        public ?string $externalReference = "",
        public ?string $creditCardToken = "",

    ) {}
}
