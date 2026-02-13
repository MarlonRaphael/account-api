<?php

namespace App\Domain\Accounts\UseCases\Events\Transfer\DTO;

final readonly class TransferInput
{
    public function __construct(
        public int $originAccountId,
        public int $amount,
        public int $destinationAccountId,
    ) {}
}
