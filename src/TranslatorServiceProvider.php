<?php

namespace Translator;

use Illuminate\Support\ServiceProvider;
use Symfony\Component\Yaml\Yaml;

class TranslatorServiceProvider extends ServiceProvider {

    public function boot() {
        $this->loadConfiguration();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {

        /** Register driver manager */
        $this->app->bind('driver-translator-manager', function() {
            return (new Manager(
                config('laravel-translator')
            ));
        });

        /** Register translator . */
        $this->app->bind('translator', function($app) {
            return new Translator(
                config('laravel-translator'),
                $app['driver-translator-manager']
            );
        });
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