<?php

namespace App\Accounts\Application\Processors;

use App\Accounts\Domain\Enums\EventTypes;
use App\Accounts\Domain\Repositories\AccountRepository;
use App\Accounts\Domain\UseCases\Events\Deposit\DepositAmountUseCase;
use App\Accounts\Domain\UseCases\Events\Deposit\DTO\DepositAmountInput;
use App\Accounts\Domain\UseCases\Events\Deposit\DTO\DepositAmountOutput;
use App\Accounts\Domain\UseCases\Events\Transfer\DTO\TransferInput;
use App\Accounts\Domain\UseCases\Events\Transfer\DTO\TransferOutput;
use App\Accounts\Domain\UseCases\Events\Transfer\TransferUseCase;
use App\Accounts\Domain\UseCases\Events\Withdraw\DTO\WithdrawBalanceInput;
use App\Accounts\Domain\UseCases\Events\Withdraw\DTO\WithdrawBalanceOutput;
use App\Accounts\Domain\UseCases\Events\Withdraw\WithdrawBalanceUseCase;
use App\Accounts\Presentation\Http\Resources\Output;

class EventProcessor
{
    public function __construct(
        private WithdrawBalanceUseCase $withdrawBalanceEventUseCase,
        private DepositAmountUseCase   $depositAmountEventUseCase,
        private TransferUseCase        $transferUseCase,
        private AccountRepository      $accountRepository,
    ) {}

    public function process(array $event): Output
    {
        $eventType = EventTypes::tryFrom($event['type']);

        return match ($eventType) {
            EventTypes::DEPOSIT => $this->handleDeposit($event),
            EventTypes::WITHDRAW => $this->handleWithdraw($event),
            EventTypes::TRANSFER => $this->handleTransfer($event),
            default => null,
        };
    }

    /**
     * @param array $event
     * @return WithdrawBalanceOutput
     */
    private function handleWithdraw(array $event): WithdrawBalanceOutput
    {
        $input = new WithdrawBalanceInput(
            accountId: $event['origin'],
            amount: $event['amount']
        );

        return $this->withdrawBalanceEventUseCase->execute($input);
    }

    private function handleDeposit(array $event): DepositAmountOutput
    {
        $input = new DepositAmountInput(
            $event['destination'],
            $event['amount']
        );

        return $this->depositAmountEventUseCase->execute($input, $this->accountRepository);
    }

    private function handleTransfer(array $event): TransferOutput
    {
        $input = new TransferInput(
            $event['origin'],
            $event['amount'],
            $event['destination']
        );

        return $this->transferUseCase->execute($input);
    }
}
