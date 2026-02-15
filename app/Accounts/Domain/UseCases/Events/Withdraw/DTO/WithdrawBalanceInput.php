<?php

namespace App\Accounts\Domain\UseCases\Events\Withdraw\DTO;

final readonly class WithdrawBalanceInput
{
    public function __construct(
        public int   $accountId,
        public float $amount,
    ) {}
}
