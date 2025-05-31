<?php

namespace App\Providers;

use App\Models\Deposit;
use App\Models\Withdrawal;
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

    /**
     * Bootstrap any application services.
     */
    // Di AppServiceProvider.php
    public function boot()
    {
        Deposit::created(function ($deposit) {
            $deposit->memberAccount->increment('balance', $deposit->total_price);
        });

        Withdrawal::updated(function ($withdrawal) {
            if ($withdrawal->isDirty('status') && $withdrawal->status === 'approved') {
                $withdrawal->memberAccount->decrement('balance', $withdrawal->amount);
            }
        });
    }
}
