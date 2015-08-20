<?php

namespace Translator;

use Illuminate\Support\ServiceProvider;
use Symfony\Component\Yaml\Yaml;

class TranslatorServiceProvider extends ServiceProvider {

    public function boot() {
        $this->publishes([
            __DIR__.'/../configuration/general.yaml' => config_path('yaml/translator/general.yaml'),
        ]);

        $this->mergeConfigFrom(
            __DIR__.'/../configuration/general.yaml' , 'laravel-translator'
        );

        $this->publishDatabaseDriver();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        $this->loadConfiguration();

        /** Register driver manager */
        $this->app->bind('driver-translator-manager', function() {
            return (new Manager(
                config('laravel-translator')
            ));
        });

        /** Register translator . */
        $this->app->singleton('laravel-translator', function($app) {
            return new Translator(
                config('laravel-translator'),
                $app['driver-translator-manager']
            );
        });
    }

    /**
     * Publish database driver assets .
     *
     * @return $this
     */
    protected function publishDatabaseDriver() {

        $this->publishes([
            __DIR__.'/DriverAssets/Database/migrations' => database_path('migrations'),
        ]);

        $this->publishes([
            __DIR__.'/DriverAssets/Database/seeds' => database_path('seeds'),
        ]);

        return $this;
    }

    /**
     * Load conf .
     *
     * @return $this
     */
    protected function loadConfiguration() {
        $array = Yaml::parse(file_get_contents(
            __DIR__ . '/../configuration/general.yaml'
        ));

        $config = $this->app['config']->get('laravel-translator', []);

        $this->app['config']->set('laravel-translator', array_merge($array, $config));

        return $this;
    }
}