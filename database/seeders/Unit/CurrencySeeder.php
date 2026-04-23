<?php

namespace Database\Seeders\Unit;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currencies = [
            [
                'id' => 1,
                'code' => 'AFN',
                'numeric_code' => '971',
                'symbol' => '؋',
                'minor_unit' => 2,
                'locales' => [
                    'en' => [
                        'name' => 'AFN',
                        'long_name' => 'Afghani',
                        'desc' => 'The official currency of Afghanistan.',
                    ],
                    'ps' => [
                        'name' => 'افغانی',
                        'long_name' => 'افغانۍ',
                        'desc' => 'د افغانستان رسمي پولي واحد.',
                    ],
                    'fa' => [
                        'name' => 'افغانی',
                        'long_name' => 'افغانی',
                        'desc' => 'واحد پول رسمی افغانستان.',
                    ],
                ],
            ],
            [
                'id' => 2,
                'code' => 'USD',
                'numeric_code' => '840',
                'symbol' => '$',
                'minor_unit' => 2,
                'locales' => [
                    'en' => [
                        'name' => 'USD',
                        'long_name' => 'US Dollar',
                        'desc' => 'The official currency of the United States and a global reserve currency.',
                    ],
                    'ps' => [
                        'name' => 'ډالر',
                        'long_name' => 'امریکایی ډالر',
                        'desc' => 'د امریکا د متحدو ایالتونو رسمي پولي واحد.',
                    ],
                    'fa' => [
                        'name' => 'دالر',
                        'long_name' => 'دالر آمریکایی',
                        'desc' => 'واحد پول رسمی ایالات متحده آمریکا.',
                    ],
                ],
            ],
        ];

        foreach ($currencies as $currency) {
            // insert into main currencies table
            DB::table('currencies')->insert([
                'id' => $currency['id'],
                'code' => $currency['code'],
                'numeric_code' => $currency['numeric_code'],
                'symbol' => $currency['symbol'],
                'minor_unit' => $currency['minor_unit'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // insert localized translations
            foreach ($currency['locales'] as $locale => $data) {
                DB::table('currency_translations')->insert([
                    'currency_id' => $currency['id'],
                    'locale' => $locale,
                    'name' => $data['name'],
                    'long_name' => $data['long_name'], // Moved from old desc
                    'description' => $data['desc'],      // New detailed description
                ]);
            }
        }
    }
}
