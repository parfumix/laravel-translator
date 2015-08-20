<?php

namespace Translator\Drivers;

use Translator\Driver;
use Translator\Translatable;

class File extends Driver implements Translatable {

    public function get($key, $replacement = array(), $locale = null) {
        // TODO: Implement get() method.
    }

    public function has($key) {
        // TODO: Implement has() method.
    }

    public function delete($key, $locale = null) {
        // TODO: Implement delete() method.
    }

    public function translate($key, $translation, $locale = null) {
        // TODO: Implement translate() method.
    }
}