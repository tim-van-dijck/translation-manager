<?php

namespace App\Entities;

use Illuminate\Support\Collection;

class Translation
{
    /** @var string */
    private $key;
    /** @var Collection */
    private $languages;

    /**
     * Translation constructor.
     * @param string $key
     * @param Collection $languages
     */
    public function __construct(string $key, Collection $languages)
    {
        $this->key = $key;
        $this->languages = $languages;
    }

    public function toArray()
    {
        $languages = [];

        foreach ($this->languages as $language) {
            $languages[$language->language] = $language->translation;
        }

        return [
            'key' => $this->key,
            'languages' => $languages
        ];
    }
}