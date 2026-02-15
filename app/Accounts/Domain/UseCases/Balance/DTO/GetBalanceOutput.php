<?php

namespace App\Accounts\Domain\UseCases\Balance\DTO;

use App\Accounts\Presentation\Http\Resources\Output;

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
