<?php

namespace App\Domain\Accounts\UseCases\Events\Transfer\DTO;

use App\Presentation\Account\Http\Resources\Output;

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
