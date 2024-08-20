<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */


public function mapWebRoutes()
{
    Route::middleware('web')
        ->group(base_path('routes/web.php'));

    // Register your custom route file
    Route::middleware('web')
        ->group(base_path('routes/teacher.php'));
        Route::get('/', function () {
            return "welcome to teacher route";
        });
} 
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        DB::listen(function($query){
            Log::info($query->sql);
            Log::info($query->bindings);
            Log::info($query->time);

        });

    }
}
