<?php

namespace Translator;

use Flysap\Support\DriverManager;

/**
 * Class Manager
 * @package Translator
 */
class Manager extends DriverManager {

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

}