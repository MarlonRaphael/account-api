<?php

namespace Tests;

use App\Accounts\Domain\Repositories\AccountRepository;
use App\Accounts\Persistence\Repositories\InMemoryAccountRepository;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{

    protected function setUp(): void
    {
        parent::setUp();

        $repository = $this->app->get(AccountRepository::class);
        if ($repository instanceof InMemoryAccountRepository) {
            $repository->reset();
        }
    }
}
