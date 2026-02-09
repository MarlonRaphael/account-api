<?php

namespace App\Application\Accounts\Processors;

use App\Domain\Accounts\Enums\EventTypes;
use App\Domain\Accounts\Repositories\AccountRepository;
use App\Domain\Accounts\UseCases\Events\Deposit\DepositAmountUseCase;
use App\Domain\Accounts\UseCases\Events\Deposit\DTO\DepositAmountInput;
use App\Domain\Accounts\UseCases\Events\Deposit\DTO\DepositAmountOutput;
use App\Domain\Accounts\UseCases\Events\Withdraw\DTO\WithdrawBalanceInput;
use App\Domain\Accounts\UseCases\Events\Withdraw\DTO\WithdrawBalanceOutput;
use App\Domain\Accounts\UseCases\Events\Withdraw\WithdrawBalanceUseCase;
use App\Infraestructure\Account\Repositories\InMemory\InMemoryAccountRepository;
use App\Infraestructure\DTO\Output;

class EventProcessor
{
    public function __construct(
        private WithdrawBalanceUseCase $withdrawBalanceEventUseCase,
        private DepositAmountUseCase   $depositAmountEventUseCase,
    ) {}

    public function process(array $event): Output
    {
        $eventType = EventTypes::tryFrom($event['type']);

        return match ($eventType) {
            EventTypes::DEPOSIT => $this->handleDeposit($event, new InMemoryAccountRepository()),
            EventTypes::WITHDRAW => $this->handleWithdraw($event),
            default => null,
        };
    }

    /**
     * @param array $withdrawData
     * @return WithdrawBalanceOutput
     */
    private function handleWithdraw(array $withdrawData): WithdrawBalanceOutput
    {
        $input = new WithdrawBalanceInput(
            originAccountId: $withdrawData['origin'],
            amount: $withdrawData['amount']
        );

        return $this->withdrawBalanceEventUseCase->execute($input);
    }

    private function handleDeposit(array $validated, AccountRepository $repository): DepositAmountOutput
    {
        $input = new DepositAmountInput(
            $validated['type'],
            $validated['destination'],
            $validated['amount']
        );

        return $this->depositAmountEventUseCase->execute($input, $repository);
    }
}
