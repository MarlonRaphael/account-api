<?php

namespace App\Domain\Accounts\UseCases\Events\Deposit;

use App\Domain\Accounts\Repositories\AccountRepository;
use App\Domain\Accounts\UseCases\Events\Deposit\DTO\DepositAmountInput;
use App\Domain\Accounts\UseCases\Events\Deposit\DTO\DepositAmountOutput;

class DepositAmountUseCase
{
    public function execute(
        DepositAmountInput $input,
        AccountRepository  $accountRepository
    ): DepositAmountOutput {
        $accountRepository->deposit($input->destination, $input->amount);

        $newBalance = $accountRepository->getBalance($input->destination);

        return new DepositAmountOutput($input->destination, $newBalance);
    }
}
