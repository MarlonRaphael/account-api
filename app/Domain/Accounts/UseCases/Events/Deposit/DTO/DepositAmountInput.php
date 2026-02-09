<?php

namespace App\Domain\Accounts\UseCases\Events\Deposit\DTO;

final readonly class DepositAmountInput
{
    public function __construct(
        public string $type,
        public int $destination,
        public int $amount,
    ) {}
}
