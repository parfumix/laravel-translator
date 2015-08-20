<?php

namespace Translator;

class Translator {

    /**
     * @var array
     */
    private $configurations;

    /**
     * @var Manager
     */
    private $driverManager;

    /**
     * @var
     */
    protected $driver;

    public function __construct(array $configurations = array(), Manager $driverManager) {

        $this->configurations = $configurations;

        $this->driverManager = $driverManager;

        $this->loadDriver(
            $configurations['default_driver']
        );
    }


    public function driver() {
        return $this->driver();
    }

    public function loadDriver($alias) {
        $this->driver = $this->getDriver($alias);

        return $this;
    }

    public function getDriver($alias) {
        return $this
            ->driverManager
            ->driver($alias);
    }


    public function get($key, $replacement = array(), $locale = null, $driver = null) {
        if(! is_null($driver))
            $driver = $this->getDriver($driver) ?: $this->driver();

        return $driver
            ->get($key, $replacement, $locale);
    }

    public function has($key, $locale = null, $driver = null) {
        if(! is_null($driver))
            $driver = $this->getDriver($driver) ?: $this->driver();

        return $driver
            ->has($key, $locale);
    }

    public function delete($key, $locale = null, $driver = null) {
        if(! is_null($driver))
            $driver = $this->getDriver($driver) ?: $this->driver();

        return $driver->delete(
            $key, $locale
        );
    }

    public function translate($key, $translation, $locale = null, $driver = null) {
        if(! is_null($driver))
            $driver = $this->getDriver($driver) ?: $this->driver();

        return $driver->translate(
            $key, $translation, $locale
        );
    }


    public function __get($key) {
        return $this->driver()
            ->get($key);
    }

}