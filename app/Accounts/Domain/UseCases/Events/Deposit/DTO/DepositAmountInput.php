<?php

namespace App\Accounts\Domain\UseCases\Events\Deposit\DTO;

final readonly class DepositAmountInput
{
    public function __construct(
        public int $destination,
        public int $amount,
    ) {}
}
