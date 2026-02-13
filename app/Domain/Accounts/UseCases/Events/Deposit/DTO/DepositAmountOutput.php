<?php

namespace App\Domain\Accounts\UseCases\Events\Deposit\DTO;

use App\Presentation\Account\Http\Resources\Output;

final readonly class DepositAmountOutput implements Output
{
    public function __construct(
        public int $id,
        public int $balance,
    ) {}

    public function toArray(): array
    {
        return [
            'destination' => [
                'id' => $this->id,
                'balance' => $this->balance,
            ]
        ];
    }
}
