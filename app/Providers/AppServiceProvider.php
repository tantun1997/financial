<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

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
    public function boot()
    {
        Paginator::useBootstrapFive();

        View::composer('*', function ($view) {
            $count_request = DB::table('แผนทั้งหมด')
                ->where('Plan_REQUEST_APPROVAL', 1)
                ->where('Plan_ENABLE', 1)
                ->count();
            $view->with('count_request', $count_request);
        });
    }
}