<?php

namespace App\Providers;

use App\Domain\Accounts\Repositories\AccountRepository;
use App\Infraestructure\Account\Repositories\InMemory\InMemoryAccountRepository;
use Illuminate\Support\ServiceProvider;

class AccountServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(
            AccountRepository::class,
            fn () => new InMemoryAccountRepository()
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
