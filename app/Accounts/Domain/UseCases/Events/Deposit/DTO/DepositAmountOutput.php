<?php

namespace App\Accounts\Domain\UseCases\Events\Deposit\DTO;

use App\Accounts\Presentation\Http\Resources\Output;

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
