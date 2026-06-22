<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        \Illuminate\Support\Facades\Hash::extend('plaintext', function () {
            return new \App\Hashing\PlaintextHasher();
        });
        config(['hashing.driver' => 'plaintext']);
    }
}
