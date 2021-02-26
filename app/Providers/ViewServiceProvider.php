<?php

namespace App\Providers;

use App\Http\Controllers\Helpers\CategoryHelper;
use App\Models\Brand;
use App\Models\Setting;
use App\Models\Social;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
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
        View::composer(['includes.header', 'includes.sidebar.sidebar'], function ($view) {
            $main_categories = CategoryHelper::getMainCategories(false);
            $view->with('main_categories', $main_categories);
        });

        View::composer(['includes.sidebar.sidebar'], function ($view) {
            $brands = Brand::latest()->get();
            $view->with('brands', $brands);
        });

        // social icon all data get here
        View::composer(['includes.footer'], function ($view){
            $globalSocialInfo = Social::status()->get();
            $view->with('globalSocialInfo', $globalSocialInfo);
        });

        // setting all data get here
        View::composer(['includes.footer', 'includes.header', 'home', 'admin.includes.sidebar'], function ($view){
            $globalSettingInfo = Setting::status()->first();
            $view->with('globalSettingInfo', $globalSettingInfo);
        });
    }
}
