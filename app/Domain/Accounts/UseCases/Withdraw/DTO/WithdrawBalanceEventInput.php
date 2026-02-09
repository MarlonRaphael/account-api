<?php

namespace App\Domain\Accounts\UseCases\Withdraw\DTO;

final readonly class WithdrawBalanceEventInput
{
    public function __construct(
        public int $originAccountId,
        public float $amount,
    ) {}
}
