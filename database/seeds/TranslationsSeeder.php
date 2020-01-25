<?php

use App\Translation;
use App\TranslationKey;
use Illuminate\Database\Seeder;

class TranslationsSeeder extends Seeder
{
    const LANGUAGES = ['nl', 'fr', 'en', 'de'];

    private $keys = [];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->keys = TranslationKey::get()->keyBy('key');
        foreach (self::LANGUAGES as $language) {
            $url = "http://s3-eu-west-1.amazonaws.com/viafutura-halito-translations/current/public/translations_{$language}.json";
            $json = json_decode(file_get_contents($url), true);
            $this->importTranslations($language, $json);
        }
    }

    /**
     * @param string $language
     * @param array $json
     */
    private function importTranslations(string $language, array $json)
    {
        foreach ($json as $key => $translation) {
            $translationKey = $this->getTranslationKey($key);
            Translation::create([
                'language' => $language,
                'key_id' => $translationKey->id,
                'translation' => $translation
            ]);
        }
        echo "Added translations for language code {$language}.\n";
    }

    /**
     * @param string $key
     * @return TranslationKey
     */
    private function getTranslationKey(string $key): TranslationKey
    {
        if (empty($this->keys[$key])) {
            $translationKey = TranslationKey::create([
                'key' => $key
            ]);
            $this->keys[$key] = $translationKey;
        }
        return $this->keys[$key];
    }
}
