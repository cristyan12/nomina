<?php

namespace App\Providers;

use App\Channel;
use App\Http\View\Composers\ChannelComposer;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Carbon\Carbon::setLocale(config('app.locale'));

        Schema::defaultStringLength(191);

        // Opción #1, se comparte en cada vista
        // View::share('channels', Channel::orderBy('name')->get());

        // Opción #2, en algunas vistas. Con comodin
        // View::composer(['posts.*', 'channels.index'], function ($view) {
        //     $view->with('channels', Channel::all());
        // });

        // Opción #3, clase dedicada
        View::composer('partials.channels.*', ChannelComposer::class);
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
