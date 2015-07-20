<?php namespace Koterle\Roleable;

use Illuminate\Support\ServiceProvider;

class RoleableServiceProvider extends ServiceProvider {
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/config.php' => config_path('roleable.php'),
            __DIR__.'/../database/migrations/' => database_path('migrations')
        ]);
    }
}
