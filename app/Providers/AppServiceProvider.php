<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // The asterisk '*' means SHARE this data with every single view/page in the whole app!
        View::composer('*', function ($view) {

            // 1. Get the real total of registered accounts in your users table
            $totalAccounts = DB::table('users')->count();

            // 2. Simulate "Players Online" based on registrations
            $playersOnline = $totalAccounts > 1 ? rand(min(2, $totalAccounts), $totalAccounts) : 1;

            $view->with([
                'totalAccounts' => $totalAccounts,
                'playersOnline' => $playersOnline,
            ]);
        });
    }
}
