<?php

namespace Translator\Drivers;

use Illuminate\Support\Facades\Cache;
use Translator\Driver;
use Translator\Translatable;

class Yandex extends Driver implements Translatable {

    const CACHE_NAME = 'yandex_translations';

    /**
     * Get translation and cache it .
     *
     * @param $key
     * @param null $locale
     * @return mixed
     */
    protected function getStoreTranslation($key, $locale = null) {
        return Cache::get(self::CACHE_NAME, function() use($locale, $key) {
            $response = $this->apiRequest(
                $this->getAttribute('api_url'), [ 'text' => $key, 'lang' => $locale]
            );

            $response = json_decode($response, true);

            return $response['text'][0];
        });
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
}