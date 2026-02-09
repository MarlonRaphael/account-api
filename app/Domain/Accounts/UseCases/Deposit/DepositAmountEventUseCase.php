<?php

namespace App\Domain\Accounts\UseCases\Deposit;

use App\Domain\Accounts\Repositories\AccountRepository;
use App\Domain\Accounts\UseCases\Deposit\DTO\DepositAmountEventInput;
use App\Domain\Accounts\UseCases\Deposit\DTO\DepositAmountEventOutput;

class DepositAmountEventUseCase
{
    public function execute(
        DepositAmountEventInput $input,
        AccountRepository $accountRepository
    ): DepositAmountEventOutput {
        $accountRepository->deposit($input->destination, $input->amount);

        $newBalance = $accountRepository->getBalance($input->destination);

        return new DepositAmountEventOutput($input->destination, $newBalance);
    }
}
