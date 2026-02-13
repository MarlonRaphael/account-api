<?php

namespace App\Domain\Accounts\UseCases\Events\Transfer;

use App\Domain\Accounts\Exceptions\NonExistingAccountException;
use App\Domain\Accounts\UseCases\Events\Transfer\DTO\TransferInput;
use App\Domain\Accounts\UseCases\Events\Transfer\DTO\TransferOutput;

class TransferUseCase
{
    public static array $existingAccounts = [
        100,
        300
    ];

    public function execute(TransferInput $input): TransferOutput
    {
        if (!in_array($input->originAccountId, self::$existingAccounts)
            || !in_array($input->destinationAccountId, self::$existingAccounts)) {
            throw new NonExistingAccountException();
        }

        return new TransferOutput(
            origin: [
                'id' => $input->originAccountId,
                'balance' => 0
            ],
            destination: [
                'id' => $input->destinationAccountId,
                'balance' => 15,
            ],
        );
    }
}
