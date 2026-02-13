<?php

namespace App\Domain\Accounts\UseCases\Balance;

use App\Domain\Accounts\Exceptions\AccountNotFound;
use App\Domain\Accounts\Repositories\AccountRepository;
use App\Domain\Accounts\UseCases\Balance\DTO\GetBalanceInput;
use App\Domain\Accounts\UseCases\Balance\DTO\GetBalanceOutput;

class GetBalanceUseCase
{
    public function execute(GetBalanceInput $input, AccountRepository $accountRepository): GetBalanceOutput
    {
        $balance = $accountRepository->getBalance($input->accountId);

        if (!$balance) {
            throw new AccountNotFound();
        }

        return new GetBalanceOutput($balance);
    }
}
