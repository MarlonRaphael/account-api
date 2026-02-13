<?php

namespace App\Providers;

use App\Domain\Accounts\Repositories\AccountRepository;
use App\Persistence\Account\Repositories\InMemoryAccountRepository;
use App\Presentation\Account\Http\Resources\FormatterRegistry;
use Illuminate\Support\ServiceProvider;

class AccountServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(AccountRepository::class, fn () => new InMemoryAccountRepository());
        $this->app->singleton(FormatterRegistry::class, fn () => new FormatterRegistry());
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
