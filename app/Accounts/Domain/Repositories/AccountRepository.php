<?php

namespace App\Accounts\Domain\Repositories;

interface AccountRepository
{
    public function find(int $accountId): ?array;
    public function getBalance(int $accountId): int;
    public function deposit(int $accountId, int $amount): void;
    public function withdraw(int $accountId, int $amount): void;
}
