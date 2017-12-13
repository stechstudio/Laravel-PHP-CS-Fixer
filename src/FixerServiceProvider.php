<?php

namespace STS\Fixer;

use Illuminate\Support\ServiceProvider;
use STS\Fixer\Console\FixCommand;

class FixerServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;
    /**
     * Default path to configuration.
     *
     * @var string
     */
    protected $configPath = __DIR__.'/../config/fixer.php';

    public function boot()
    {
        // helps deal with Lumen vs Laravel differences
        if (function_exists('config_path')) {
            $publishPath = config_path('fixer.php');
        } else {
            $publishPath = base_path('config/fixer.php');
        }
        $this->publishes([$this->configPath => $publishPath], 'config');
    }

    public function register()
    {
        if (is_a($this->app, 'Laravel\Lumen\Application')) {
            $this->app->configure('fixer');
        }
        $this->mergeConfigFrom($this->configPath, 'fixer');

        $this->app->singleton('command.fixer.fix', function ($app) {
            return new FixCommand();
        });
        $this->commands('command.fixer.fix');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['command.fixer.fix'];
    }
}
