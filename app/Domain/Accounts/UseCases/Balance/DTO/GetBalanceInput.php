<?php

namespace App\Domain\Accounts\UseCases\Balance\DTO;

final readonly class GetBalanceInput
{
    public function __construct(public int $accountId) {}
}
