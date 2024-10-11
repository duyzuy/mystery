<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Http\View\Composers\StoresComposer;
use App\Http\View\Composers\HomepageComposer;
use App\Http\View\Composers\DashboardComposer;


use App\Components\FlashMessages;

class AppServiceProvider extends ServiceProvider
{

    use FlashMessages;
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
        //
        Schema::defaultStringLength(191);
        
        view()->composer('partials.messages', function ($view) {

            $messages = self::messages();
  
            return $view->with('messages', $messages);
        });
       
        view::composer(
            ['frontend.survey.show', 'welcome'], StoresComposer::class
            
        );

        view::composer(
            ['welcome', 'frontend._include.footer'], HomepageComposer::class
            
        );
  

        view::composer(
            ['*'], DashboardComposer::class
            
        );


    }
}
