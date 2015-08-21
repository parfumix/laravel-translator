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
     * @param null $locale
     * @return mixed
     */
    public function has($key, $locale = null);

    /**
     * Delete translation by key .
     *
     * @param $key
     * @param null $group
     * @param null $locale
     * @return mixed
     */
    public function delete($key, $group = null, $locale = null);

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