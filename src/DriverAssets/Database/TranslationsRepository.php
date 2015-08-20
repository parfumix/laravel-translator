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

        $this->languageRepository = new LanguageRepository(
            new Language
        );
    }

    /**
     * Get local by key .
     *
     * @param $key
     * @param $locale
     * @return mixed
     */
    public function getByKey($key, $locale) {
        return $this->source
            ->select()
            ->join('languages', 'languages.id', '=','translations.language_id')
            ->where('languages.slug', $locale)
            ->whereKey($key)
            ->first();
    }
}