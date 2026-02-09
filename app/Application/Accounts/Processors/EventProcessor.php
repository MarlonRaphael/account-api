<?php

namespace App\Application\Accounts\Processors;

use App\Domain\Accounts\Enums\EventTypes;
use App\Domain\Accounts\Repositories\AccountRepository;
use App\Domain\Accounts\UseCases\Deposit\DepositAmountEventUseCase;
use App\Domain\Accounts\UseCases\Deposit\DTO\DepositAmountEventInput;
use App\Domain\Accounts\UseCases\Deposit\DTO\DepositAmountEventOutput;
use App\Domain\Accounts\UseCases\Withdraw\DTO\WithdrawBalanceEventInput;
use App\Domain\Accounts\UseCases\Withdraw\DTO\WithdrawBalanceEventOutput;
use App\Domain\Accounts\UseCases\Withdraw\WithdrawBalanceEventUseCase;
use App\Infraestructure\Account\Repositories\InMemory\InMemoryAccountRepository;
use App\Infraestructure\DTO\Output;

class EventProcessor
{
    public function __construct(
        private WithdrawBalanceEventUseCase $withdrawBalanceEventUseCase,
        private DepositAmountEventUseCase   $depositAmountEventUseCase,
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
     * @return WithdrawBalanceEventOutput
     */
    private function handleWithdraw(array $withdrawData): WithdrawBalanceEventOutput
    {
        $input = new WithdrawBalanceEventInput(
            originAccountId: $withdrawData['origin'],
            amount: $withdrawData['amount']
        );

        return $this->withdrawBalanceEventUseCase->execute($input);
    }

    private function handleDeposit(array $validated, AccountRepository $repository): DepositAmountEventOutput
    {
        $input = new DepositAmountEventInput(
            $validated['type'],
            $validated['destination'],
            $validated['amount']
        );

        return $this->depositAmountEventUseCase->execute($input, $repository);
    }
}
