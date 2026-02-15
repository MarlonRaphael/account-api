<?php

namespace App\Accounts\Application\Processors;

use App\Accounts\Domain\Repositories\AccountRepository;
use App\Accounts\Domain\UseCases\Balance\DTO\GetBalanceInput;
use App\Accounts\Domain\UseCases\Balance\DTO\GetBalanceOutput;
use App\Accounts\Domain\UseCases\Balance\GetBalanceUseCase;

class BalanceProcessor
{
    public function __construct(
        private GetBalanceUseCase $getBalanceUseCase,
        private AccountRepository $accountRepository
    ) {}

    public function process(int $accountId): GetBalanceOutput
    {
        $input = new GetBalanceInput($accountId);

        return $this->getBalanceUseCase->execute($input, $this->accountRepository);
    }
}
