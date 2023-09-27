<?php

namespace Brunocfalcao\NovaAddressFinder;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;

class FieldServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Nova::serving(function (ServingNova $event) {
            Nova::script('nova-address-finder', __DIR__.'/../dist/js/field.js');
            Nova::style('nova-address-finder', __DIR__.'/../dist/css/field.css');

            Nova::provideToScript([
                'googleMapsApiKey' => config('services.address_finder.google_maps_key'),
            ]);

            // Define your routes here
            Route::middleware(['nova'])
            ->prefix('nova-api')
            ->group(function () {
                Route::post('/update-location', 'LocationController@updateLocation');
            });
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
