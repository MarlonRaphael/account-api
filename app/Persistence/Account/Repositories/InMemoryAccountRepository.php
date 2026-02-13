<?php

namespace App\Persistence\Account\Repositories;

use App\Domain\Accounts\Repositories\AccountRepository;

class InMemoryAccountRepository implements AccountRepository
{
    private const array INITIAL_STATE = [];

    public array $accounts = [];

    public function __construct()
    {
        if (empty($this->accounts)) {
            $this->accounts = self::INITIAL_STATE;
        }
    }

    public function reset(): void
    {
        $this->accounts = self::INITIAL_STATE;
    }

    public function find(int $accountId): ?array
    {
        return $this->accounts[$accountId] ?? null;
    }

    public function getBalance(int $accountId): int
    {
        return $this->accounts[$accountId] ?? 0;
    }

    public function deposit(int $accountId, int $amount): void
    {
        if (!isset($this->accounts[$accountId])) {
            $this->accounts[$accountId] = 0;
        }
        $this->accounts[$accountId] += $amount;
    }

    public function withdraw(int $accountId, int $amount): void
    {
        $this->accounts[$accountId] = $this->getBalance($accountId) - $amount;
    }
}

