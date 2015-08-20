<?php

namespace Translator;

interface Translatable {

    public function get($key, $replacement = array(), $locale = null);

    public function has($key);

    public function delete($key, $locale = null);

    public function translate($key, $translation, $locale = null);
}