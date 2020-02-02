<?php

namespace App\Repositories;

use App\Translation as TranslationModel;
use App\Entities\Translation;
use App\TranslationKey;
use Illuminate\Contracts\Pagination\LengthAwarePaginator as LengthAwarePaginatorInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class TranslationRepository
{
    /**
     * @param int $pageNumber
     * @param int $pageSize
     * @return LengthAwarePaginatorInterface
     */
    public function get(int $pageNumber = 1, int $pageSize = 50): LengthAwarePaginatorInterface
    {
        $translations = TranslationKey::with(['translations' => function ($query) {
            return $query->whereIn('language', ['nl', 'en', 'fr', 'de']);
        }])->paginate($pageSize, ['*'], 'page[number]', $pageNumber);

        $items = collect();

        foreach ($translations as $translation) {
            $items->push(new Translation($translation->key, $translation->translations->keyBy('language')));
        }
        return new LengthAwarePaginator($items, $translations->total(), $pageSize, $pageNumber, ['']);
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

    public function store(string $key, array $data): Translation
    {
        /** @var TranslationKey $key */
        $translationKey = TranslationKey::create([
            'key' => $key
        ]);

        $languages = collect();
        foreach ($data as $language => $trans) {
            /** @var TranslationModel $translation */
            $translation = new TranslationModel();
            $translation->key_id = $translationKey->id;
            $translation->language = $language;
            $translation->translation = $trans['translation'];
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