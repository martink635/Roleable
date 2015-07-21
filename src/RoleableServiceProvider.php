<?php

namespace Koterle\Roleable;

use Illuminate\Support\ServiceProvider;

class RoleableServiceProvider extends ServiceProvider
{
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
            __DIR__.'/../database/migrations/create_roles_table.php' => database_path("migrations/{$this->getDatePrefix('-15 seconds')}_create_roles_table.php"),
            __DIR__.'/../database/migrations/create_permissions_table.php' => database_path("migrations/{$this->getDatePrefix('-10 seconds')}_create_permissions_table.php"),
            __DIR__.'/../database/migrations/create_role_user_table.php' => database_path("migrations/{$this->getDatePrefix('-5 seconds')}_create_role_user_table.php"),
            __DIR__.'/../database/migrations/create_permission_role_table.php' => database_path("migrations/{$this->getDatePrefix()}_create_permission_role_table.php")
        ]);
    }

    /**
     * Get the date prefix for the migration.
     *
     * @return string
     */
    private function getDatePrefix($time = "now")
    {
        return date('Y_m_d_His', strtotime($time));
    }
}
