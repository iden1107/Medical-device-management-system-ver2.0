<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use App\Models\Setting;

// class AppServiceProvider extends ServiceProvider
class AppServiceProvider extends AuthServiceProvider
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
        // bladeで使える共通データ
        // $setting = Setting::first();
        // View::share('setting', $setting);

        $this->registerPolicies();
        
        Gate::define('all', function ($user) {
            return ($user->permission <= 1);
        });

        Gate::define('admin', function ($user) {
            return ($user->permission == 1);
        });
    }
}
