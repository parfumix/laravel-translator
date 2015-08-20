<?php

namespace Translator;

interface Translatable {

    /**
     * Get translation by key .
     *
     * @param $key
     * @param array $replacement
     * @param null $locale
     * @return mixed
     */
    public function get($key, $replacement = array(), $locale = null);

    /**
     * Check if has translation by key .
     *
     * @param $key
     * @return mixed
     */
    public function has($key);

    /**
     * Delete translation by key .
     *
     * @param $key
     * @param null $locale
     * @return mixed
     */
    public function delete($key, $locale = null);

    /**
     * Translate translation by key .
     *
     * @param $key
     * @param $translation
     * @param null $locale
     * @return mixed
     */
    public function translate($key, $translation, $locale = null);
}