<?php namespace Ucer\Entrust;

/**
 * This file is part of Entrust,
 * a role & permission management solution for Laravel.
 *
 * @license MIT
 * @package Zizaco\Entrust
 */

use Illuminate\Support\ServiceProvider;
use Ucer\Entrust\command\MigrationCommand;

class EntrustServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        // Publish config files
        $this->publishes([
            __DIR__ . '/../config/config.php' => config_path('entrust.php'),
        ], 'config');

        // Register commands
        $this->commands('command.entrust.migration');

        // Register blade directives
        $this->bladeDirectives();

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerEntrust();

        $this->registerCommands();

    }

    /**
     * Register the blade directives
     *
     * @return void
     */
    private function bladeDirectives()
    {
        // Call to Entrust::hasRole
        \Blade::directive('role', function ($expression) {
            return "<?php if (\\Entrust::hasRole{$expression}) : ?>";
        });

        \Blade::directive('endrole', function ($expression) {
            return "<?php endif; // Entrust::hasRole ?>";
        });

        // Call to Entrust::can
        \Blade::directive('permission', function ($expression) {
            return "<?php if (\\Entrust::can{$expression}) : ?>";
        });

        \Blade::directive('endpermission', function ($expression) {
            return "<?php endif; // Entrust::can ?>";
        });

        // Call to Entrust::ability
        \Blade::directive('ability', function ($expression) {
            return "<?php if (\\Entrust::ability{$expression}) : ?>";
        });

        \Blade::directive('endability', function ($expression) {
            return "<?php endif; // Entrust::ability ?>";
        });
    }

    /**
     * Register the application bindings.
     *
     * @return void
     */
    private function registerEntrust()
    {
        $this->app->bind('entrust', function ($app) {
            return new Entrust($app);
        });

    }

    /**
     * Register the artisan commands.
     *
     * @return void
     */
    private function registerCommands()
    {
        $this->app->singleton('command.entrust.migration', function ($app) {
            return new MigrationCommand();
        });
    }
}
