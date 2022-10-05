<?php

namespace App\Providers;

use App\Models\Sheet;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        App::singleton('get_sheet_data',function (){
          return collect(Sheet::getData());
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
