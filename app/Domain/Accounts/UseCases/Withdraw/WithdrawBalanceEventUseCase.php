<?php

namespace App\Domain\Accounts\UseCases\Withdraw;

use App\Domain\Accounts\UseCases\Withdraw\DTO\WithdrawBalanceEventInput;
use App\Domain\Accounts\UseCases\Withdraw\Exceptions\NonExistingAccountException;

class WithdrawBalanceEventUseCase
{
    public static array $existingAccounts = [
        100
    ];

    public function execute(WithdrawBalanceEventInput $input): array
    {
        if (!in_array($input->originAccountId, self::$existingAccounts)) {
            throw new NonExistingAccountException();
        }
    }
}
