<?php

namespace App\Infraestructure\Http\Formatters;

use App\Domain\Accounts\UseCases\Deposit\DTO\DepositAmountEventOutput;
use App\Domain\Accounts\UseCases\Withdraw\DTO\WithdrawBalanceEventOutput;
use RuntimeException;

class FormatterRegistry
{
    private array $formatters = [];

    public function __construct()
    {
        $this->register(WithdrawBalanceEventOutput::class, new WithdrawOutputFormatter());
        $this->register(DepositAmountEventOutput::class, new DepositOutputFormatter());
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
