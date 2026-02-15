<?php

namespace App\Accounts\Domain\UseCases\Events\Withdraw;

use App\Accounts\Domain\Exceptions\NonExistingAccountException;
use App\Accounts\Domain\UseCases\Events\Withdraw\DTO\WithdrawBalanceInput;
use App\Accounts\Domain\UseCases\Events\Withdraw\DTO\WithdrawBalanceOutput;

class WithdrawBalanceUseCase
{
    public static array $existingAccounts = [
        100
    ];

    public function execute(WithdrawBalanceInput $input): WithdrawBalanceOutput
    {
        if (!in_array($input->accountId, self::$existingAccounts)) {
            throw new NonExistingAccountException();
        }

        return new WithdrawBalanceOutput($input->accountId, 15);
    }
}
