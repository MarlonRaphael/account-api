<?php

namespace App\Domain\Accounts\UseCases\Deposit\DTO;

use App\Infraestructure\DTO\Output;

final readonly class DepositAmountEventOutput implements Output
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
