<?php

namespace App\Infraestructure\Account\Repositories\InMemory;

use App\Domain\Accounts\Repositories\AccountRepository;

class InMemoryAccountRepository implements AccountRepository
{
    private array $accounts = [];

    public function find(int $accountId): int
    {
        return $this->accounts[$accountId] ?? 0;
    }

    public function getBalance(int $accountId): int
    {
        return $this->accounts[$accountId] ?? 0;
    }

    public function deposit(int $accountId, int $amount): void
    {
        $this->accounts[$accountId] = $this->getBalance($accountId) + $amount;
    }

    public function withdraw(int $accountId, int $amount): void
    {
        $this->accounts[$accountId] = $this->getBalance($accountId) - $amount;
    }
}
