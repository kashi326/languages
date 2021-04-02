<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        $langaugeLevel = [
            'totalbeginner'=> '<p id="level-red">C -</p>',
            'beginner'=> '<p id="level-yellow">C</p>',
            'upperbeginner'=> '<p id="level-green">C +</p>',
            'totalintermediate'=> '<p id="level-red">B -</p>',
            'intermediate'=> '<p id="level-yellow">B</p>',
            'upperintermediate'=> '<p id="level-green">B +</p>',
            'totaladvanced'=> '<p id="level-red">A -</p>',
            'advanced'=> '<p id="level-yellow">A</p>',
            'totaladvanced'=> '<p id="level-green">A +</p>',
        ];
        view()->share('languageLevel', $langaugeLevel);
    }
}
