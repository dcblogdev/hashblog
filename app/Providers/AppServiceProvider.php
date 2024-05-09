<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\HashnodeService;
use Illuminate\Support\Facades\View;

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
    public function boot(HashnodeService $hashnodeService): void
    {
        View::composer('layouts.app', function ($view) use($hashnodeService) {
            $view->with('pages', $hashnodeService->getPages());
        });
    }
}
