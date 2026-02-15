<?php

namespace App\Accounts\Domain\UseCases\Events\Transfer;

use App\Accounts\Domain\Exceptions\NonExistingAccountException;
use App\Accounts\Domain\UseCases\Events\Transfer\DTO\TransferInput;
use App\Accounts\Domain\UseCases\Events\Transfer\DTO\TransferOutput;

class TransferUseCase
{
    public static array $existingAccounts = [
        100,
        300
    ];

    public function execute(TransferInput $input): TransferOutput
    {
        if (!in_array($input->origin, self::$existingAccounts)
            || !in_array($input->destination, self::$existingAccounts)) {
            throw new NonExistingAccountException();
        }

        return new TransferOutput(
            origin: [
                'id' => $input->origin,
                'balance' => 0
            ],
            destination: [
                'id' => $input->destination,
                'balance' => 15,
            ],
        );
    }
}
