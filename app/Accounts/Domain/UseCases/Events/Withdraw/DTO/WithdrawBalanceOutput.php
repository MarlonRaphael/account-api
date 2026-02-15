<?php

namespace App\Accounts\Domain\UseCases\Events\Withdraw\DTO;

use App\Accounts\Presentation\Http\Resources\Output;

final readonly class WithdrawBalanceOutput implements Output
{
    public function __construct(
        public int $accountId,
        public int $amount,
    ) {}

    public function toArray(): array
    {
        return [
            'origin' => [
                'id' => $this->accountId,
                'balance' => $this->amount,
            ]
        ];
    }
}
