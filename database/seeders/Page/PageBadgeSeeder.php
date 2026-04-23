<?php

namespace Database\Seeders\Page;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class PageBadgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $badges = [
            [
                'name' => 'blue',
                'color' => '#0000FF',
                'rank' => 1,
                'trans' => [
                    'en' => ['label' => 'Verified', 'desc' => 'Verified business page.'],
                    'ps' => ['label' => 'تایید شوې پاڼه', 'desc' => 'تایید شوې سوداګریزه پاڼه.'],
                    'fa' => ['label' => 'صفحه تایید شده', 'desc' => 'صفحه تجاری تایید شده.'],
                ],
            ],
            [
                'name' => 'green',
                'color' => '#008000',
                'rank' => 2,
                'trans' => [
                    'en' => ['label' => 'Verified Plus', 'desc' => 'Verified business page with a physical location.'],
                    'ps' => ['label' => 'غوره تایید شوې پاڼه', 'desc' => 'د فزیکي موقعیت لرونکې تایید شوې سوداګریزه پاڼه.'],
                    'fa' => ['label' => 'صفحه تایید شده ویژه', 'desc' => 'صفحه تجاری تایید شده با موقعیت فیزیکی.'],
                ],
            ],
            [
                'name' => 'gold',
                'color' => '#FFD700',
                'rank' => 3,
                'trans' => [
                    'en' => ['label' => 'Elite Brand', 'desc' => 'Recognized successful business page or influential brand.'],
                    'ps' => ['label' => 'طلایي برانډ', 'desc' => 'پیژندل شوې او بریالۍ سوداګریزه پاڼه.'],
                    'fa' => ['label' => 'برند طلایی', 'desc' => 'صفحه تجاری شناخته شده و موفق.'],
                ],
            ],
        ];

        foreach ($badges as $badge) {
            $badgeId = DB::table('page_badges')->insertGetId([
                'name' => $badge['name'],
                'color' => $badge['color'],
                'rank' => $badge['rank'],
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            foreach ($badge['trans'] as $locale => $data) {
                DB::table('page_badge_translations')->insert([
                    'page_badge_id' => $badgeId,
                    'locale' => $locale,
                    'label' => $data['label'],
                    'description' => $data['desc'],
                ]);
            }
        }
    }
}
