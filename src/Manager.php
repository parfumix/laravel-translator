<?php

namespace Translator;

use Flysap\Support\DriverManager;

class Manager extends DriverManager {

    /**
     * @var
     */
    protected $configuration;

    /**
     * @param array $configuration
     */
    public function __constructor(array $configuration) {
        $this->configuration = $configuration;

        $this->setDrivers(
            $configuration['drivers']
        );
    }

    /**
     * Get the default driver name.
     *
     * @return string
     */
    public function getDefaultDriver() {
        return $this->configuration['default_driver'];
    }

    /**
     * Set drivers .
     *
     * @param array $drivers
     * @return $this
     */
    function setDrivers(array $drivers) {
        $this->drivers = $drivers;

        return $this;
    }
}