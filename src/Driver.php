<?php

namespace Translator;

use Flysap\Support\Traits\ElementAttributes;

abstract class Driver {

    use ElementAttributes;

    public function __construct($attributes = array()) {
        $this->setAttributes($attributes);
    }

    /**
     * Get translation by key .
     *
     * @param $key
     * @param array $replacement
     * @param null $locale
     * @return bool
     */
    public function get($key, $replacement = array(), $locale = null) {
        return true;
    }

    /**
     * Check if has translation by key .
     *
     * @param $key
     * @return bool
     */
    public function has($key) {
        return true;
    }

    /**
     * Delete translation by key .
     *
     * @param $key
     * @param null $locale
     * @return bool
     */
    public function delete($key, $locale = null) {
        return true;
    }

    /**
     * Translate key .
     *
     * @param $key
     * @param $translation
     * @param null $locale
     * @return bool
     */
    public function translate($key, $translation, $locale = null) {
        return true;
    }
}