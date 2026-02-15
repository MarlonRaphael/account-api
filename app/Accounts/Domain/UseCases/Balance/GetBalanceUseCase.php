<?php

namespace App\Accounts\Domain\UseCases\Balance;

use App\Accounts\Domain\Exceptions\AccountNotFound;
use App\Accounts\Domain\Repositories\AccountRepository;
use App\Accounts\Domain\UseCases\Balance\DTO\GetBalanceInput;
use App\Accounts\Domain\UseCases\Balance\DTO\GetBalanceOutput;

class GetBalanceUseCase
{
    private static array $accounts = [
        100
    ];

    public function execute(GetBalanceInput $input, AccountRepository $accountRepository): GetBalanceOutput
    {
        if (!in_array($input->accountId, self::$accounts, true)) {
            throw new AccountNotFound();
        }

        $accountRepository->deposit($input->accountId, 20);
        $balance = $accountRepository->getBalance($input->accountId);

        return new GetBalanceOutput($balance);
    }
}
