<?php

namespace Translator;

use Flysap\Support\DriverManager;

class Manager extends DriverManager {

    protected $drivers;

    /**
     * @var
     */
    protected $configuration;

    /**
     * @param array $configuration
     */
    public function __construct(array $configuration) {
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
    protected function getDefaultDriver() {
        return $this->configuration['default_driver'];
    }

    /**
     * Set drivers .
     *
     * @param array $drivers
     * @return $this
     */
    public function setDrivers(array $drivers) {
        $this->drivers = $drivers;

        return $this;
    }

    public function getDrivers() {
        return $this->drivers;
    }
}