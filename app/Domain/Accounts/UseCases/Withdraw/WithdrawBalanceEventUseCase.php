<?php

namespace App\Domain\Accounts\UseCases\Withdraw;

use App\Domain\Accounts\Exceptions\NonExistingAccountException;
use App\Domain\Accounts\UseCases\Withdraw\DTO\WithdrawBalanceEventInput;
use App\Domain\Accounts\UseCases\Withdraw\DTO\WithdrawBalanceEventOutput;

class WithdrawBalanceEventUseCase
{
    public static array $existingAccounts = [
        100
    ];

    public function execute(WithdrawBalanceEventInput $input): WithdrawBalanceEventOutput
    {
        if (!in_array($input->originAccountId, self::$existingAccounts)) {
            throw new NonExistingAccountException();
        }

        return new WithdrawBalanceEventOutput($input->originAccountId, 15);
    }
}
