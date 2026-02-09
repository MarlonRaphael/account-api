<?php

namespace App\Domain\Accounts\UseCases\Events\Withdraw;

use App\Domain\Accounts\Exceptions\NonExistingAccountException;
use App\Domain\Accounts\UseCases\Events\Withdraw\DTO\WithdrawBalanceInput;
use App\Domain\Accounts\UseCases\Events\Withdraw\DTO\WithdrawBalanceOutput;

class WithdrawBalanceUseCase
{
    public static array $existingAccounts = [
        100
    ];

    public function execute(WithdrawBalanceInput $input): WithdrawBalanceOutput
    {
        if (!in_array($input->originAccountId, self::$existingAccounts)) {
            throw new NonExistingAccountException();
        }

        return new WithdrawBalanceOutput($input->originAccountId, 15);
    }
}
