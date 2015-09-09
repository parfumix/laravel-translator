<?php

namespace Translator\DriverAssets\Database;

use Illuminate\Database\Eloquent\Model;

class LanguageRepository {

    /**
     * @var Model
     */
    private $source;

    public function __construct(Model $source) {
        $this->source = $source;
    }

    /**
     * Get assoc locales .
     *
     * @param $key
     * @param $value
     * @return mixed
     */
    public function getAssocLocales($key, $value) {
        return $this->source
            ->lists($key, $value);
    }

    /**
     * Get locale by id .
     *
     * @param $id
     * @return null
     */
    public function getLocaleById($id) {
        $locale = $this->source
            ->where('id', $id)
            ->first();

        return isset($locale->id) ? $locale->locale : null;
    }

    /**
     * Get all languages .
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll() {
        return $this->source
            ->all();
    }

    /**
     * Get active languages .
     *
     * @return mixed
     */
    public function getActive() {
        return $this->source
            ->whereActive(true)
            ->first();
    }

    /**
     * get by slug language .
     *
     * @param $locale
     * @return mixed
     */
    public function getBySlug($locale) {
        return $this->source
            ->whereSlug($locale)
            ->first();
    }
}