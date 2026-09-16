<?php

namespace App\Providers;

use App\Http\Controllers\Admin\HomepageVideoController;
use Illuminate\Support\Facades\Route;
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
        $this->app->booted(function () {
            if (Route::has('admin.homepage-video.edit')) {
                return;
            }

            Route::middleware(['web', 'auth', 'admin'])
                ->prefix('admin')
                ->name('admin.')
                ->group(function () {
                    Route::get('homepage-video', [HomepageVideoController::class, 'edit'])->name('homepage-video.edit');
                    Route::put('homepage-video', [HomepageVideoController::class, 'update'])->name('homepage-video.update');
                    Route::patch('homepage-video/toggle', [HomepageVideoController::class, 'toggle'])->name('homepage-video.toggle');
                });
        });
    }
}
