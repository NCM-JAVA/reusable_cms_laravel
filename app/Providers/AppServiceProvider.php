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

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //if (!in_array(request()->getHost(), ['125.20.102.85'])) {
		//if (!in_array(request()->getHost(), ['10.249.186.156'])) {
		if (!in_array(request()->getHost(), ['localhost', '164.100.117.174', 'consumeraffairs.gov.in'])) {
    abort(403, 'Invalid Host Header');
}
    }


}
