<?php

namespace App\Domain\Accounts\UseCases\Events\Withdraw\DTO;

final readonly class WithdrawBalanceInput
{
    public function __construct(
        public int $originAccountId,
        public float $amount,
    ) {}
}
