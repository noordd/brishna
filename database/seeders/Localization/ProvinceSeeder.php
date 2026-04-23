<?php

namespace Database\Seeders\Localization;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();

        $provinces = [
            ['id' => 1, 'country_id' => 1, 'en' => 'Badakhshan', 'ps' => 'بدخشان', 'fa' => 'بدخشان'],
            ['id' => 2, 'country_id' => 1, 'en' => 'Badghis', 'ps' => 'بادغیس', 'fa' => 'بادغیس'],
            ['id' => 3, 'country_id' => 1, 'en' => 'Baghlan', 'ps' => 'بغلان', 'fa' => 'بغلان'],
            ['id' => 4, 'country_id' => 1, 'en' => 'Balkh', 'ps' => 'بلخ', 'fa' => 'بلخ'],
            ['id' => 5, 'country_id' => 1, 'en' => 'Bamyan', 'ps' => 'بامیان', 'fa' => 'بامیان'],
            ['id' => 6, 'country_id' => 1, 'en' => 'Daykundi', 'ps' => 'دایکندی', 'fa' => 'دایکندی'],
            ['id' => 7, 'country_id' => 1, 'en' => 'Farah', 'ps' => 'فراه', 'fa' => 'فراه'],
            ['id' => 8, 'country_id' => 1, 'en' => 'Faryab', 'ps' => 'فاریاب', 'fa' => 'فاریاب'],
            ['id' => 9, 'country_id' => 1, 'en' => 'Ghazni', 'ps' => 'غزنی', 'fa' => 'غزنی'],
            ['id' => 10, 'country_id' => 1, 'en' => 'Ghor', 'ps' => 'غور', 'fa' => 'غور'],
            ['id' => 11, 'country_id' => 1, 'en' => 'Helmand', 'ps' => 'هلمند', 'fa' => 'هلمند'],
            ['id' => 12, 'country_id' => 1, 'en' => 'Herat', 'ps' => 'هرات', 'fa' => 'هرات'],
            ['id' => 13, 'country_id' => 1, 'en' => 'Jowzjan', 'ps' => 'جوزجان', 'fa' => 'جوزجان'],
            ['id' => 14, 'country_id' => 1, 'en' => 'Kabul', 'ps' => 'کابل', 'fa' => 'کابل'],
            ['id' => 15, 'country_id' => 1, 'en' => 'Kandahar', 'ps' => 'کندهار', 'fa' => 'کندهار'],
            ['id' => 16, 'country_id' => 1, 'en' => 'Kapisa', 'ps' => 'کاپیسا', 'fa' => 'کاپیسا'],
            ['id' => 17, 'country_id' => 1, 'en' => 'Khost', 'ps' => 'خوست', 'fa' => 'خوست'],
            ['id' => 18, 'country_id' => 1, 'en' => 'Kunar', 'ps' => 'کنړ', 'fa' => 'کنر'],
            ['id' => 19, 'country_id' => 1, 'en' => 'Kunduz', 'ps' => 'کندز', 'fa' => 'کندز'],
            ['id' => 20, 'country_id' => 1, 'en' => 'Laghman', 'ps' => 'لغمان', 'fa' => 'لغمان'],
            ['id' => 21, 'country_id' => 1, 'en' => 'Logar', 'ps' => 'لوگر', 'fa' => 'لوگر'],
            ['id' => 22, 'country_id' => 1, 'en' => 'Maidan Wardak', 'ps' => 'میدان وردک', 'fa' => 'میدان وردک'],
            ['id' => 23, 'country_id' => 1, 'en' => 'Nangarhar', 'ps' => 'ننګرهار', 'fa' => 'ننګرهار'],
            ['id' => 24, 'country_id' => 1, 'en' => 'Nimruz', 'ps' => 'نیمروز', 'fa' => 'نیمروز'],
            ['id' => 25, 'country_id' => 1, 'en' => 'Nuristan', 'ps' => 'نورستان', 'fa' => 'نورستان'],
            ['id' => 26, 'country_id' => 1, 'en' => 'Paktia', 'ps' => 'پکتیا', 'fa' => 'پکتیا'],
            ['id' => 27, 'country_id' => 1, 'en' => 'Paktika', 'ps' => 'پکتیکا', 'fa' => 'پکتیکا'],
            ['id' => 28, 'country_id' => 1, 'en' => 'Panjshir', 'ps' => 'پنجشیر', 'fa' => 'پنجشیر'],
            ['id' => 29, 'country_id' => 1, 'en' => 'Parwan', 'ps' => 'پروان', 'fa' => 'پروان'],
            ['id' => 30, 'country_id' => 1, 'en' => 'Samangan', 'ps' => 'سمنگان', 'fa' => 'سمنگان'],
            ['id' => 31, 'country_id' => 1, 'en' => 'Sar-e-Pol', 'ps' => 'سرپل', 'fa' => 'سرپل'],
            ['id' => 32, 'country_id' => 1, 'en' => 'Takhar', 'ps' => 'تخار', 'fa' => 'تخار'],
            ['id' => 33, 'country_id' => 1, 'en' => 'Uruzgan', 'ps' => 'روزګان', 'fa' => 'اروزگان'],
            ['id' => 34, 'country_id' => 1, 'en' => 'Zabul', 'ps' => 'زابل', 'fa' => 'زابل'],
        ];

        foreach ($provinces as $province) {
            // 1. Insert into provinces table
            DB::table('provinces')->insert([
                'id' => $province['id'],
                'country_id' => $province['country_id'],
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            // 2. Insert translations
            $translations = [
                ['locale' => 'en', 'name' => $province['en']],
                ['locale' => 'ps', 'name' => $province['ps']],
                ['locale' => 'fa', 'name' => $province['fa']],
            ];

            foreach ($translations as $translation) {
                DB::table('province_translations')->insert([
                    'province_id' => $province['id'],
                    'locale' => $translation['locale'],
                    'name' => $translation['name'],
                ]);
            }
        }
    }
}
