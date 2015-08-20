<?php

namespace Translator\Drivers;

use Translator\Driver;
use Translator\Translatable;
use Lang;

class File extends Driver implements Translatable {

    /**
     * Get translation by key .
     *
     * @param $key
     * @param array $replacement
     * @param null $locale
     * @return bool
     */
    public function get($key, $replacement = array(), $locale = null) {
        return Lang::get($key, $replacement, $locale);
    }

    /**
     * Check if has translation by key .
     *
     * @param $key
     * @return bool
     */
    public function has($key) {
        return Lang::has($key);
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
        return Lang::get($key, null, $locale);
    }

    /**
     * Call function from translator ..
     *
     * @param $name
     * @param array $args
     * @return mixed
     */
    public function __call($name, $args = array()) {
        return call_user_func_array([app('translator'), $name], $args);
    }

}