<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;

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
        Collection::macro('validate', function (array $rules) {
            /** @var $this Collection */
            return $this->values()->reject(function ($array) use ($rules) {
                return Validator::make($array, $rules)->fails();
            });
        });
    }
}
