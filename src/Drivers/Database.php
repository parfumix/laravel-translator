<?php

namespace Translator\Drivers;

use Illuminate\Support\Facades\Cache;
use Translator\Driver;
use Translator\DriverAssets\Database\LanguageRepository;
use Translator\DriverAssets\Database\Translation;
use Translator\DriverAssets\Database\TranslationsRepository;
use Translator\Translatable;

/**
 * Class Database
 * @package Translator\Drivers
 */
class Database extends Driver implements Translatable {

    /**
     * @var LanguageRepository
     */
    protected $translationRepository;

    /**
     * @var
     */
    protected $translations;

    public function __construct($attributes = array()) {
        parent::__construct($attributes);

        $this->translationRepository = app('translations-db-repo');

        $this->setTranslations();
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
     * Set translations .
     *
     * @return $this
     */
    protected function setTranslations() {
        if( $this->getAttribute('cache_time') ) {
            $translations = Cache::remember('users', $this->getAttribute('cache_time'), function() {
                $translations = $this->getRepository()
                    ->allTranslations()
                    ->toArray();

                return $this->prepareTranslations(
                    $translations
                );
            });
        } else {
            $translations = $this->getRepository()
                ->allTranslations()
                ->toArray();

            $translations = $this->prepareTranslations(
                $translations
            );
        }

        $this->translations = $translations;

        return $this;
    }

    /**
     * Prepare translations .
     *
     * @param $translations
     * @return array
     */
    protected function prepareTranslations($translations) {
        $return = [];

        foreach($translations as $translation)
            $return[$translation['locale']][!is_null($translation['group']) ? $translation['group']. '.' . $translation['key'] : ''. $translation['key']] = $translation['value'];

       return $return;
    }

    /**
     * Get all translations ..
     *
     * @return mixed
     */
    protected function getTranslations() {
        return $this->translations;
    }

    /**
     * Get translation by key .
     *
     * @param $key
     * @param $locale
     * @return mixed
     */
    protected function getTranslation($key, $locale) {
        if( isset($this->translations[$locale][$key]) )
            return $this->translations[$locale][$key];

        return $key;
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
        $locale = $this->locale($locale);

        $translation = $this->getTranslation($key, $locale);

        return $this->replace(
            $translation, $replacement
        );
    }

    /**
     * Check if has translation .
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
     * Delete translation by key .
     *
     * @param $key
     * @param null $group
     * @param null $locale
     * @return bool
     */
    public function delete($key, $group = null, $locale = null) {
        $locale = $this->locale($locale);

        $translation = $this->getRepository()
            ->getByKey($key, $locale, $group);

        if( isset($translation->id) )
            $this->getRepository()
                ->removeById($translation->id);

        #@todo need to refresh cache .

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
        #@todo need to store in database and return translation .

        return true;
    }

}