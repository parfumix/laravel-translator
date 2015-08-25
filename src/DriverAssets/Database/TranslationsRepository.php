<?php

namespace Translator\DriverAssets\Database;

use Illuminate\Database\Eloquent\Model;

class TranslationsRepository {

    /**
     * @var Model
     */
    private $source;

    public function __construct(Model $source) {
        $this->source = $source;

        $this->languageRepository = app('lang-db-repo');
    }

    /**
     * Get all translations .
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function allTranslations() {
        return $this->source
            ->select('languages.slug as locale', 'translations.*')
            ->join('languages', 'languages.id', '=','translations.language_id')
            ->get();
    }

    /**
     * Remove by id .
     *
     * @param $id
     */
    public function removeById($id) {
        $this->source
            ->find($id)
            ->delete();
    }

    /**
     * Get local by key .
     *
     * @param $key
     * @param $locale
     * @param null $group
     * @return mixed
     */
    public function getByKey($key, $locale, $group = null) {
        $query = $this->source
            ->select('languages.slug as locale', 'translations.*')
            ->join('languages', 'languages.id', '=','translations.language_id')
            ->where('languages.slug', $locale)
            ->whereKey($key);

        if($group)
            $query->where('group', $group);

        return $query
            ->first();
    }
}