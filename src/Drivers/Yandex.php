<?php

namespace Translator\Drivers;

use Symfony\Component\Yaml\Yaml;
use Translator\Driver;
use Translator\Translatable;
use Flysap\Support;

class Yandex extends Driver implements Translatable {

    const FILE_NAME = 'yandex_translations';

    /**
     * @var
     */
    protected $translations;

    /**
     * @var
     */
    protected $loaded;

    public function __construct($attributes = array()) {
        parent::__construct($attributes);

        $this->setTranslations();

        register_shutdown_function(function() {
            $locales      = $this->getLocales();

            foreach($locales as $locale => $options) {
                $path = $this->getFileFullPath($locale);

                $translations = $this->translations[$locale];

                if( $translations != $this->loaded[$locale] ) {
                    $contents = Support\get_file_contents($path);
                    $contents = array_merge($translations, $contents);

                    $contents = Yaml::dump($contents, 1);
                    Support\dump_file($path, $contents);
                }
            }
        });
    }

    /**
     * Get file full path .
     *
     * @param $locale
     * @return string
     */
    protected function getFileFullPath($locale) {
        return app_path(
            '../resources' . DIRECTORY_SEPARATOR . 'lang' . DIRECTORY_SEPARATOR . $locale . DIRECTORY_SEPARATOR .  self::FILE_NAME . '.yaml'
        );
    }

    /**
     * Set translations .
     *
     * @return $this
     */
    public function setTranslations() {
        $locales      = $this->getLocales();
        $translations = [];

        foreach($locales as $locale => $options) {
            $path = $this->getFileFullPath($locale);

            $contents = Support\get_file_contents($path);

            $translations[$locale] = $contents;
        }

        $this->translations = $this->loaded = $translations;

        return $this;
    }

    /**
     * Get translation and cache it .
     *
     * @param $key
     * @param null $locale
     * @return mixed
     */
    protected function getStoreTranslation($key, $locale) {
        if( ! isset($this->translations[$locale][$key]) )  {
            $response = $this->apiRequest(
                $this->getAttribute('api_url'), [ 'text' => $key, 'lang' => $locale]
            );

            $response = json_decode($response, true);

            $this->translations[$locale][$key] = $response['text'][0];
        }

        return $this->translations[$locale][$key];
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
        $value = $this->getStoreTranslation($key, $this->locale($locale));

        return $this->replace($value, $replacement);
    }

    /**
     * Check if has translation by key .
     *
     * @param $key
     * @param null $locale
     * @return bool
     */
    public function has($key, $locale = null) {
        $locale = $this->locale($locale);

        return $this->get($key, [], $locale) !== $key;
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
        $this->translations[$this->locale($locale)][$key] = $translation;

        return $translation;
    }
}