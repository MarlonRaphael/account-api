<?php

namespace App\Domain\Accounts\UseCases\Withdraw\DTO;

final readonly class WithdrawBalanceEventOutput
{
    public function __construct(
        public int $originAccountId,
        public int $amount,
    ) {}

    public function toArray(): array
    {
        return [
            'origin' => [
                'id' => $this->originAccountId,
                'balance' => $this->amount,
            ]
        ];
    }
}
