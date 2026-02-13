<?php

namespace App\Application\Accounts\Processors;

use App\Domain\Accounts\Repositories\AccountRepository;
use App\Domain\Accounts\UseCases\Balance\DTO\GetBalanceInput;
use App\Domain\Accounts\UseCases\Balance\DTO\GetBalanceOutput;
use App\Domain\Accounts\UseCases\Balance\GetBalanceUseCase;

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
