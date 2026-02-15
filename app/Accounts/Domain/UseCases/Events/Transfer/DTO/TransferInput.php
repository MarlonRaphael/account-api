<?php

namespace App\Accounts\Domain\UseCases\Events\Transfer\DTO;

final readonly class TransferInput
{
    public function __construct(
        public int $origin,
        public int $amount,
        public int $destination,
    ) {}
}
