<?php

namespace App\Providers;

use App\Accounts\Domain\Repositories\AccountRepository;
use App\Accounts\Persistence\Repositories\InMemoryAccountRepository;
use App\Accounts\Presentation\Http\Resources\FormatterRegistry;
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
