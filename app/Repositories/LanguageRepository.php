<?php

namespace App\Repositories;


use App\Entities\Language;
use App\Models\Language as LanguageModel;
use Illuminate\Support\Collection;

class LanguageRepository
{
    /**
     * @param bool|null $admin
     * @return Collection
     */
    public function get(): Collection
    {
        $languages = LanguageModel::orderBy('admin', 'desc')->get();
        $result = collect();
        /** @var LanguageModel $language */
        foreach ($languages as $language) {
            $result->push(new Language($language->key, $language->admin));
        }
        return $result;
    }
}