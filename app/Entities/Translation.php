<?php

namespace App\Entities;

use App\Traits\HandleToJson;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Collection;

class Translation implements Arrayable, \ArrayAccess, Jsonable, \JsonSerializable
{
    use HandleToJson;

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

    public function toArray(): array
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