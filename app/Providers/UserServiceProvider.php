<?php

namespace App\Providers;

use App\Services\Impl\UserServiceImpl;
use App\Services\UserServices;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons = [
        UserServices::class => UserServiceImpl::class        
    ];

    public function provides(): array
    {
        return [UserServices::class];
    }
    /**
     * Register services.
     */
    public function register(): void
    {
        
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
