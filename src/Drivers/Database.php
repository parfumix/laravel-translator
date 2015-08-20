<?php

namespace Translator\Drivers;

use Translator\Driver;
use Translator\DriverAssets\Database\Language;
use Translator\DriverAssets\Database\LanguageRepository;
use Translator\DriverAssets\Database\Translation;
use Translator\DriverAssets\Database\TranslationsRepository;
use Translator\Translatable;

class Database extends Driver implements Translatable {

    /**
     * @var LanguageRepository
     */
    protected $translationRepository;

    public function __construct() {
        $this->translationRepository = new TranslationsRepository(
            new Translation()
        );
    }

    /**
     * Get repository .
     *
     * @return LanguageRepository
     */
    protected function getRepository() {
        return $this->translationRepository;
    }

    /**
     * Set repository .
     *
     * @param $repository
     * @return $this
     */
    protected function setRepository($repository) {
        $this->translationRepository = $repository;

        return $this;
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
        $locale = ! is_null($locale) ? $locale : $this->locale();

        $translation = $this->translationRepository
            ->get($key, $locale);

        if( isset($translation->value) )
            return $translation->value;
    }

    /**
     * Check if has translation .
     *
     * @param $key
     * @return bool
     */
    public function has($key) {
        return ! is_null($this->get($key));
    }
}