<?php

namespace App\Accounts\Domain\UseCases\Events\Deposit;

use App\Accounts\Domain\Repositories\AccountRepository;
use App\Accounts\Domain\UseCases\Events\Deposit\DTO\DepositAmountInput;
use App\Accounts\Domain\UseCases\Events\Deposit\DTO\DepositAmountOutput;

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
