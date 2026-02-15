<?php

namespace App\Accounts\Domain\UseCases\Events\Transfer\DTO;

use App\Accounts\Presentation\Http\Resources\Output;

final readonly class TransferOutput implements Output
{
    public function __construct(
        public array $origin,
        public array $destination,
    ) {}

    public function toArray(): array
    {
        return [
            'origin' => [
                'id' => $this->origin['id'],
                'balance' => $this->origin['balance']
            ],
            'destination' => [
                'id' => $this->destination['id'],
                'balance' => $this->destination['balance']
            ]
        ];
    }
}
