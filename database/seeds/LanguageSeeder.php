<?php

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (['nl', 'en', 'fr', 'de'] as $key) {
            Language::firstOrCreate([
                'key' => $key
            ], [
                'admin' => 1
            ]);
        }
    }
}
