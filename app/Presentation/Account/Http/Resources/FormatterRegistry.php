<?php

namespace App\Presentation\Account\Http\Resources;

use App\Domain\Accounts\UseCases\Balance\DTO\GetBalanceOutput;
use App\Domain\Accounts\UseCases\Events\Deposit\DTO\DepositAmountOutput;
use App\Domain\Accounts\UseCases\Events\Transfer\DTO\TransferOutput;
use App\Domain\Accounts\UseCases\Events\Withdraw\DTO\WithdrawBalanceOutput;
use RuntimeException;

class FormatterRegistry
{
    private array $formatters = [];

    public function __construct()
    {
        $this->register(WithdrawBalanceOutput::class, new WithdrawOutputFormatter());
        $this->register(DepositAmountOutput::class, new DepositOutputFormatter());
        $this->register(GetBalanceOutput::class, new GetBalanceFormatter());
        $this->register(TransferOutput::class, new TransferOutputFormatter());
    }

    public function register(string $outputClass, OutputFormatter $formatter): void
    {
        $this->formatters[$outputClass] = $formatter;
    }

    public function getFormatter(object $output): OutputFormatter
    {
        $class = $output::class;

        if (!isset($this->formatters[$class])) {
            throw new RuntimeException("No formatter registered for {$class}");
        }

        return $this->formatters[$class];
    }
}

