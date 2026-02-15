<?php

namespace App\Accounts\Presentation\Http\Resources;

use App\Accounts\Domain\UseCases\Balance\DTO\GetBalanceOutput;
use App\Accounts\Domain\UseCases\Events\Deposit\DTO\DepositAmountOutput;
use App\Accounts\Domain\UseCases\Events\Transfer\DTO\TransferOutput;
use App\Accounts\Domain\UseCases\Events\Withdraw\DTO\WithdrawBalanceOutput;
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

