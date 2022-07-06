<?php

namespace Laravel\Asaas;

use Laravel\Asaas\Http\Controllers\ReceiveWebhookController;
use Illuminate\Support\ServiceProvider;
use Route;

class AsaasServiceProvider extends ServiceProvider {
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
        $this->registerRouterMacro();
    }

    private function registerRouterMacro()
    {
        Route::macro('webhooks', function (string $url) {
            return Route::post($url, [ReceiveWebhookController::class, 'index']);
        });
    }
}
