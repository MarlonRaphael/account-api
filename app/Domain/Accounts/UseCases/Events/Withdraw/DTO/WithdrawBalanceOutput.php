<?php

namespace App\Domain\Accounts\UseCases\Events\Withdraw\DTO;

use App\Presentation\Account\Http\Resources\Output;

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
