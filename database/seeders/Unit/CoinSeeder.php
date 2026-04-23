<?php

namespace Database\Seeders\Unit;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $coins = [
            [
                'id' => 1,
                'code' => 'brc',
                'symbol' => '',
                'sort_order' => 0,
                'locales' => [
                    'en' => [
                        'name' => 'BRC',
                        'long_name' => 'Brishna Coin',
                        'desc' => 'Brishna Coin is an internal virtual currency designed specifically for seamless transactions within the app environment. It serves as the exclusive medium of exchange for all in-app purchases, services, and activities.',
                    ],
                    'ps' => [
                        'name' => 'برښنا',
                        'long_name' => 'د برښنا سکه',
                        'desc' => 'برشنا کوین یوه داخلي مجازي سکه ده چې په ځانګړي ډول د اپلیکیشن چاپیریال کې د راکړې ورکړې د ترسره کولو لپاره ډیزاین شوې ده. دا سکه د اپلیکیشن دننه د ټولو پېرودنو، خدماتو او فعالیتونو لپاره د تبادلې یوازینۍ وسیله ده،',
                    ],
                    'fa' => [
                        'name' => 'برشنا',
                        'long_name' => 'سکه برشنا',
                        'desc' => 'برشنا کوین یک واحد پول مجازی داخلی است که به طور خاص برای انجام معاملات در محیط برنامه طراحی شده است. این ارز به عنوان تنها وسیله مبادله برای کلیه خریدها، خدمات و فعالیت‌های درون برنامه‌ای عمل می‌کند.',
                    ],
                ],
            ],
            [
                'id' => 2,
                'code' => 'afn',
                'symbol' => '؋',
                'sort_order' => 1,
                'locales' => [
                    'en' => [
                        'name' => 'AFN',
                        'long_name' => 'Afghani',
                        'desc' => 'Using the national currency of Afghanistan, the Afghani (AFN), is possible for direct local payments without any limitations.',
                    ],
                    'ps' => [
                        'name' => 'افغاني',
                        'long_name' => 'افغاني پیسې',
                        'desc' => 'زموږ د هېواد رسمي پولی واحد افغانۍ چې په آسانۍ سره د ټولو داخلي او محلي راکړو ورکړو لپاره کارول کیږي.',
                    ],
                    'fa' => [
                        'name' => 'افغانی',
                        'long_name' => 'افغانی',
                        'desc' => 'استفاده از واحد پول ملی افغانستان افغانی جهت پرداخت‌های مستقیم محلی بدون هیچ محدودیتی امکان‌پذیر است.',
                    ],
                ],
            ],
            [
                'id' => 3,
                'code' => 'usd',
                'symbol' => '$',
                'sort_order' => 2,
                'locales' => [
                    'en' => [
                        'name' => 'USD',
                        'long_name' => 'US Dollar',
                        'desc' => 'United States Dollar, accepted as a global stable currency for international transactions.',
                    ],
                    'ps' => [
                        'name' => 'ډالر',
                        'long_name' => 'امریکایی ډالر',
                        'desc' => 'امریکایي ډالر د نړیوال باثباته پولي واحد په توګه په راکړه ورکړه کې منل کیږي.',
                    ],
                    'fa' => [
                        'name' => 'دالر',
                        'long_name' => 'دالر آمریکایی',
                        'desc' => 'دالر ایالات متحده به عنوان یک واحد پولی معتبر جهانی برای معاملات بین‌المللی.',
                    ],
                ],
            ],
        ];

        foreach ($coins as $coin) {
            // insert into main coins table
            DB::table('coins')->insert([
                'id' => $coin['id'],
                'code' => $coin['code'],
                'symbol' => $coin['symbol'],
                'sort_order' => $coin['sort_order'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // insert into coin_translations table
            foreach ($coin['locales'] as $locale => $data) {
                DB::table('coin_translations')->insert([
                    'coin_id' => $coin['id'],
                    'locale' => $locale,
                    'name' => $data['name'],
                    'long_name' => $data['long_name'], // Moved from old desc
                    'description' => $data['desc'],      // New detailed content
                ]);
            }
        }
    }
}
