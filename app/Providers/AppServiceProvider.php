<?php

namespace App\Providers;

use App\Models\ContactMail;
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
    public function boot(): void
    {
        $notificationCount = ContactMail::whereNull('read_at')->count();

        view()->share([
            'notificationCount' => $notificationCount
        ]);
    }
}
