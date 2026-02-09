<?php

namespace App\Domain\Accounts\UseCases\Deposit\DTO;

final readonly class DepositAmountEventInput
{
    public function __construct(
        public string $type,
        public int $destination,
        public int $amount,
    ) {}
}
