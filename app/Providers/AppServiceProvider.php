<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Category;
use App\GeneralSetting;
use App\LocalizationSetting;
use App\Order;
use Cart;
use App;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        \View::composer('*', function($view){
            if ($view->getName() != 'admin.category.index') {
                $view->with(
                    [
                        'cartcount' => Cart::count(),
                        'general_setting' => GeneralSetting::first(),
                        'localization_setting' => LocalizationSetting::first(),
                        'ordercount' => Order::salescount(auth()->id()) + Order::transactioncount(auth()->id()),
                    ]
                );
            }

            $localization_setting = LocalizationSetting::first();
            App::setLocale($localization_setting->language);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
