<?php

namespace Translator;

use Illuminate\Support\ServiceProvider;
use Flysap\Support;
use Translator\DriverAssets\Database\Language;
use Translator\DriverAssets\Database\LanguageRepository;
use Translator\DriverAssets\Database\Translation;
use Translator\DriverAssets\Database\TranslationsRepository;

class TranslatorServiceProvider extends ServiceProvider {

    public function boot() {
        $this->publishes([
            __DIR__.'/../configuration' => config_path('yaml/translator'),
        ]);

        $this->publishDatabaseDriver();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        $this->loadConfiguration();

        /** Register language repository . */
        $this->app->bind('lang-db-repo', function() {
            return new LanguageRepository(
                new Language()
            );
        });

        /** Register translations repository . */
        $this->app->bind('translations-db-repo', function() {
            return new TranslationsRepository(
                new Translation()
            );
        });

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
        Support\set_config_from_yaml(
            __DIR__ . '/../configuration/general.yaml' , 'laravel-translator'
        );

        Support\merge_yaml_config_from(
            config_path('yaml/translator/general.yaml') , 'laravel-translator'
        );

        return $this;
    }
}