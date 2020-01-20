<?php

namespace Repositories;

use App\Translation as TranslationModel;
use Entities\Translation;

class TranslationRepository
{
    public function get()
    {
        Translation::get();
    }

    /**
     * @param string $key
     * @return Translation
     */
    public function find(string $key): Translation
    {
        $translations = TranslationModel::where('key', $key)->get()->keyBy('language');
        return new Translation($key, $translations);
    }

    public function store(string $key, array $data)
    {
        $languages = collect();
        foreach ($data as $language => $trans) {
            /** @var TranslationModel $translation */
            $translation = new TranslationModel();
            $translation->key = $key;
            $translation->language = $language;
            $translation->translation = $trans;
            $translation->save();
            $languages->push($translation);
        }

        return new Translation($key, $languages->keyBy('language'));
    }

    public function update(string $key, array $data)
    {
        $languages = collect();
        $translations = TranslationModel::where('key', $key)->get()->keyBy('language');

        foreach ($data as $language => $trans) {
            /** @var TranslationModel $translation */
            $translation = $translations[$language];
            $translation->translation = $trans;
            $translation->save();
            $languages->push($translation);
        }

        return new Translation($key, $languages->keyBy('language'));
    }

    public function destroy(string $key)
    {
        TranslationModel::where('key', $key)->delete();
    }
}