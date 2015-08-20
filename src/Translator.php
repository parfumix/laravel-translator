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


    /**
     * Get current active driver .
     * @return mixed
     * @throws TranslatorException
     */
    public function driver() {
        if(! $this->hasDriver())
            throw new TranslatorException(_('No active drivers.'));

        return $this->driver();
    }

    /**
     * Check if translator has active driver .
     *
     * @return bool
     */
    public function hasDriver() {
        return isset($this->driver);
    }

    /**
     * Load driver by alias .
     *
     * @param $alias
     * @return $this
     */
    public function loadDriver($alias) {
        $this->driver = $this->getDriver($alias);

        return $this;
    }

    /**
     * Get driver by alias .
     *
     * @param $alias
     * @return mixed
     */
    public function getDriver($alias) {
        return $this
            ->driverManager
            ->driver($alias);
    }


    /**
     * Get translation by key .
     *
     * @param $key
     * @param array $replacement
     * @param null $locale
     * @param null $driver
     * @return mixed
     */
    public function get($key, $replacement = array(), $locale = null, $driver = null) {
        if(! is_null($driver))
            $driver = $this->getDriver($driver) ?: $this->driver();

        return $driver
            ->get($key, $replacement, $locale);
    }

    /**
     * Check if has translation by key .
     *
     * @param $key
     * @param null $locale
     * @param null $driver
     * @return mixed
     */
    public function has($key, $locale = null, $driver = null) {
        if(! is_null($driver))
            $driver = $this->getDriver($driver) ?: $this->driver();

        return $driver
            ->has($key, $locale);
    }

    /**
     * Delete translation by key .
     *
     * @param $key
     * @param null $locale
     * @param null $driver
     * @return mixed
     */
    public function delete($key, $locale = null, $driver = null) {
        if(! is_null($driver))
            $driver = $this->getDriver($driver) ?: $this->driver();

        return $driver->delete(
            $key, $locale
        );
    }

    /**
     * Translate a key .
     *
     * @param $key
     * @param $translation
     * @param null $locale
     * @param null $driver
     * @return mixed
     */
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