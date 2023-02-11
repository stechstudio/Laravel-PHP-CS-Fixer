<?php

namespace STS\Fixer;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use STS\Fixer\Console\FixCommand;
use STS\Fixer\Console\UpdateRulesCommand;

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
    protected $configPath = __DIR__ . '/../config/fixer.php';

    public function boot()
    {
        $this->publish();
        $this->addCommands();
    }

    public function register()
    {
        $this->config();
    }

    /**
     * Add any package commands if we are running in the console.
     *
     * @return void
     */
    protected function addCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                FixCommand::class
            ]);
        }
    }

    /**
     * Handles configuation for Luman or Laravel
     *
     * @return void
     */
    protected function config()
    {
        if (is_a($this->app, 'Laravel\Lumen\Application')) {
            $this->app->configure('fixer');
        }
        $this->mergeConfigFrom($this->configPath, 'fixer');
        Config::set('laravel_cs_sha1_checksum', '3f504802e3b3d9dd5eeb08ce34c2073d77fc59c6');
    }

    /**
     * Handles publishing the configuration class for Luman or Laravel
     *
     * @return void
     * @throws BindingResolutionException
     */
    protected function publish()
    {
        // helps deal with Lumen vs Laravel differences
        if (function_exists('config_path')) {
            $publishPath = config_path('fixer.php');
        } else {
            $publishPath = base_path('config/fixer.php');
        }

        $this->publishes([$this->configPath => $publishPath], 'config');
    }
}
