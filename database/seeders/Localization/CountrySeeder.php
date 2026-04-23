<?php

namespace Database\Seeders\Localization;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();

        // insert the main Country record
        $countryId = DB::table('countries')->insertGetId([
            'id' => 1,
            'short_code' => 'AF',
            'long_code' => 'AFG',
            'isd_code' => '+93',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        // insert the localized names into the translations table
        DB::table('country_translations')->insert([
            [
                'country_id' => $countryId,
                'locale' => 'en',
                'name' => 'Afghanistan',
            ],
            [
                'country_id' => $countryId,
                'locale' => 'ps',
                'name' => 'افغانستان',
            ],
            [
                'country_id' => $countryId,
                'locale' => 'fa',
                'name' => 'افغانستان',
            ],
        ]);
    }
}
