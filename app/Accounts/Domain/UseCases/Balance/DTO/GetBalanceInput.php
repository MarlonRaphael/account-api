<?php

namespace App\Accounts\Domain\UseCases\Balance\DTO;

final readonly class GetBalanceInput
{
    public function __construct(public int $accountId) {}
}
