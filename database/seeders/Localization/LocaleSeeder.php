<?php

namespace Database\Seeders\Localization;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert Base Locales First
        // This is necessary because the translations table restricts on translation_locale
        $locales = [
            ['code' => 'en', 'dir' => 'ltr', 'sort_order' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'fa', 'dir' => 'rtl', 'sort_order' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'ps', 'dir' => 'rtl', 'sort_order' => 3, 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('locales')->insert($locales);

        // Insert Translations
        // Each locale needs a label for every other supported language
        $translations = [
            // English labels
            ['locale_code' => 'en', 'translation_locale' => 'en', 'label' => 'English'],
            ['locale_code' => 'en', 'translation_locale' => 'fa', 'label' => 'انگلیسی'],
            ['locale_code' => 'en', 'translation_locale' => 'ps', 'label' => 'انګلیسي'],

            // Persian/Farsi labels
            ['locale_code' => 'fa', 'translation_locale' => 'en', 'label' => 'Farsi (Persian)'],
            ['locale_code' => 'fa', 'translation_locale' => 'fa', 'label' => 'فارسی'],
            ['locale_code' => 'fa', 'translation_locale' => 'ps', 'label' => 'فارسي'],

            // Pashto labels
            ['locale_code' => 'ps', 'translation_locale' => 'en', 'label' => 'Pashto'],
            ['locale_code' => 'ps', 'translation_locale' => 'fa', 'label' => 'پشتو'],
            ['locale_code' => 'ps', 'translation_locale' => 'ps', 'label' => 'پښتو'],
        ];

        DB::table('locale_translations')->insert($translations);
    }
}
