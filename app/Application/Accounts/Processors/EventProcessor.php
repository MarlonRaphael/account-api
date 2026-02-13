<?php

namespace App\Application\Accounts\Processors;

use App\Domain\Accounts\Enums\EventTypes;
use App\Domain\Accounts\Repositories\AccountRepository;
use App\Domain\Accounts\UseCases\Events\Deposit\DepositAmountUseCase;
use App\Domain\Accounts\UseCases\Events\Deposit\DTO\DepositAmountInput;
use App\Domain\Accounts\UseCases\Events\Deposit\DTO\DepositAmountOutput;
use App\Domain\Accounts\UseCases\Events\Transfer\DTO\TransferInput;
use App\Domain\Accounts\UseCases\Events\Transfer\DTO\TransferOutput;
use App\Domain\Accounts\UseCases\Events\Transfer\TransferUseCase;
use App\Domain\Accounts\UseCases\Events\Withdraw\DTO\WithdrawBalanceInput;
use App\Domain\Accounts\UseCases\Events\Withdraw\DTO\WithdrawBalanceOutput;
use App\Domain\Accounts\UseCases\Events\Withdraw\WithdrawBalanceUseCase;
use App\Presentation\Account\Http\Resources\Output;

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
            originAccountId: $event['origin'],
            amount: $event['amount']
        );

        return $this->withdrawBalanceEventUseCase->execute($input);
    }

    private function handleDeposit(array $event): DepositAmountOutput
    {
        $input = new DepositAmountInput(
            $event['type'],
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
