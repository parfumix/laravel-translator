<?php

namespace Translator;

use Localization;
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
     * @param null $locale
     * @return bool
     */
    public function has($key, $locale = null) {
        return true;
    }

    /**
     * Delete translation by key .
     *
     * @param $key
     * @param null $group
     * @param null $locale
     * @return bool
     */
    public function delete($key, $group = null, $locale = null) {
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

    /**
     * Make replacement .
     *
     * @param $translation
     * @param array $replacement
     * @return mixed
     */
    protected function replace($translation, $replacement = []) {
        foreach ($replacement as $key => $value) {
            $translation = str_replace(':'.$key, $value, $translation);
        }

        return $translation;
    }


    /**
     * Get the default locale being used.
     *
     * @param null $default
     * @return string
     */
    public function locale($default = null) {
        return $this->getLocale($default);
    }

    /**
     * Get the default locale being used.
     *
     * @param null $default
     * @return string
     */
    public function getLocale($default = null) {
        return !is_null(Localization\get_active_locale()) ? Localization\get_active_locale() : $default;
    }
}