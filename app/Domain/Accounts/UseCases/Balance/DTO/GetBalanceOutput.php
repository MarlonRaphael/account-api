<?php

namespace App\Domain\Accounts\UseCases\Balance\DTO;

use App\Presentation\Account\Http\Resources\Output;

final readonly class GetBalanceOutput implements Output
{
    public function __construct(public int $balance) {}

    public function toArray(): array
    {
        return [
            'balance' => $this->balance,
        ];
    }
}
