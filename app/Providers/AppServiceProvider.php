<?php

namespace App\Providers;

use App\Models\ContactMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
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
        $notificationCount = 0;
        
        try {
            // Cek koneksi database
            DB::connection()->getPdo();
            
            // Cek apakah tabel ada
            if (Schema::hasTable('contact_mails')) {
                $notificationCount = ContactMail::whereNull('read_at')->count();
            }
        } catch (\Exception $e) {
            // Jangan crash aplikasi
            Log::warning('Notification count error: ' . $e->getMessage());
        }
        
        view()->share([
            'notificationCount' => $notificationCount
        ]);
    }
}
