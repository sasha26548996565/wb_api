<?php

declare(strict_types=1);

namespace App\Providers;

use GuzzleHttp\Client;
use App\Services\WildberriesApiClient;
use Illuminate\Support\ServiceProvider;
use App\Contracts\WildberriesApiClientContract;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(WildberriesApiClientContract::class, function () {
            return new WildberriesApiClient(
                new Client(),
                config('api.api_url'),
                config('api.api_key'),
            );
        });
    }

    public function boot(): void {}
}
