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

    public function __construct(array $configurations = array(), Manager $driverManager) {

        $this->configurations = $configurations;

        $this->driverManager = $driverManager;
    }

    public function loadDriver($alias) {

    }

    public function get($key, $replacement = array(), $locale = null, $driver = null) {

    }

}