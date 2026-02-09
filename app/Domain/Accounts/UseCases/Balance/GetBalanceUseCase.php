<?php

namespace App\Domain\Accounts\UseCases\Balance;

use App\Domain\Accounts\Exceptions\AccountNotFound;

class GetBalanceUseCase
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
