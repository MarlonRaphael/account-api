<?php

namespace App\Domain\Accounts\UseCases\GetAccountBalance;

use App\Domain\Exceptions\AccountNotFound;

class GetAccountBalanceUseCase
{
    public static array $availableAccounts = [
        100
    ];

    /**
     * @throws AccountNotFound
     */
    public function execute(int $accountId): int
    {
        if (!in_array($accountId, self::$availableAccounts)) {
            throw new AccountNotFound('Account not found');
        }

        return 20;
    }
}
