<?php

namespace Database\Seeders\Asset;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AssetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        // create the base 'page' asset
        $assetId = DB::table('assets')->insertGetId([
            'slug' => 'page', // System identifier
            'settings' => json_encode([
                'version' => '1.0',
                'is_core' => true,
            ]),
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        // create the translations for the 'page' asset
        DB::table('asset_translations')->insert([
            [
                'asset_id' => $assetId,
                'locale' => 'en',
                'label' => 'Page',
                'description' => 'The basic tool for making your own business or personal pages.',
                'meta' => json_encode(['category' => 'system']),
            ],
            [
                'asset_id' => $assetId,
                'locale' => 'fa',
                'label' => 'صفحه',
                'description' => 'ابزاری ساده برای ساختن صفحه‌های شخصی یا تجاری شما.',
                'meta' => json_encode(['category' => 'system']),
            ],
            [
                'asset_id' => $assetId,
                'locale' => 'ps',
                'label' => 'پاڼه',
                'description' => 'ستاسو د شخصي یا سوداګریزو پاڼو د جوړولو لپاره یوه ساده وسیله.',
                'meta' => json_encode(['category' => 'system']),
            ],
        ]);
    }
}
