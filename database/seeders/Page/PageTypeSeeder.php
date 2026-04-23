<?php

namespace Database\Seeders\Page;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class PageTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $types = [
            [
                'slug' => 'personal-business',
                'en' => ['label' => 'Personal Business', 'desc' => 'Individual or small-scale business pages.'],
                'fa' => ['label' => 'کسب و کار شخصی', 'desc' => 'صفحات مربوط به کسب و کارهای انفرادی یا کوچک.'],
                'ps' => ['label' => 'شخصي سوداګري', 'desc' => 'د انفرادي یا کوچني کچې سوداګرۍ پاڼې.'],
            ],
            [
                'slug' => 'electronics-technology',
                'en' => ['label' => 'Electronics & Tech', 'desc' => 'Gadgets, hardware, and modern technology services.'],
                'fa' => ['label' => 'الکترونیک و تکنالوژی', 'desc' => 'گجت‌ها، سخت‌افزار و خدمات تکنالوژی مدرن.'],
                'ps' => ['label' => 'برېښنايي توکي او تکنالوژي', 'desc' => 'ګجټونه، هارډویر او عصري ټیکنالوژي خدمات.'],
            ],
            [
                'slug' => 'software-digital',
                'en' => ['label' => 'Software & Digital', 'desc' => 'Apps, software development, and digital products.'],
                'fa' => ['label' => 'نرم‌افزار و دیجیتال', 'desc' => 'اپلیکیشن‌ها، توسعه نرم‌افزار و محصولات دیجیتال.'],
                'ps' => ['label' => 'سافټویر او ډیجیټل', 'desc' => 'اپلیکیشنونه، د سافټویر پراختیا او ډیجیټل محصولات.'],
            ],
            [
                'slug' => 'real-estate',
                'en' => ['label' => 'Real Estate', 'desc' => 'Buying, selling, and renting properties.'],
                'fa' => ['label' => 'املاک و مستغلات', 'desc' => 'خرید، فروش و اجاره املاک و مستغلات.'],
                'ps' => ['label' => 'املاک او جایدادونه', 'desc' => 'د ملکیتونو پیرود، پلور او کرایه کول.'],
            ],
            [
                'slug' => 'vehicle-dealership',
                'en' => ['label' => 'Vehicles & Motors', 'desc' => 'Cars, bikes, and automotive services.'],
                'fa' => ['label' => 'وسایط و موتر', 'desc' => 'خرید و فروش موتر، موتورسیکلت و خدمات خودرو.'],
                'ps' => ['label' => 'وسایط او موټر', 'desc' => 'د موټرو، موټرسایکلونو پلور او اړوند خدمات.'],
            ],
            [
                'slug' => 'restaurant-hotel',
                'en' => ['label' => 'Restaurant & Hotel', 'desc' => 'Dining services, hotels, and tourism hospitality.'],
                'fa' => ['label' => 'رستورانت و هتل', 'desc' => 'خدمات غذاخوری، هتل‌ها و مهمان‌نوازی گردشگری.'],
                'ps' => ['label' => 'رستورانت او هوټل', 'desc' => 'د خواړو خدمات، هوټلونه او د ګرځندوی میلمه پالنه.'],
            ],
            [
                'slug' => 'professional-services',
                'en' => ['label' => 'Professional Services', 'desc' => 'Consulting, legal, and other specialized services.'],
                'fa' => ['label' => 'خدمات حرفه‌ای', 'desc' => 'مشاوره، خدمات حقوقی و سایر خدمات تخصصی.'],
                'ps' => ['label' => 'مسلکي خدمتونه', 'desc' => 'مشورې، قانوني او نور تخصصي خدمات.'],
            ],
            [
                'slug' => 'healthcare-medical',
                'en' => ['label' => 'Healthcare & Medical', 'desc' => 'Clinics, pharmacies, and health-related services.'],
                'fa' => ['label' => 'بهداشت و درمان', 'desc' => 'کلینیک‌ها، داروخانه‌ها و خدمات مربوط به سلامت.'],
                'ps' => ['label' => 'روغتیا او درملنه', 'desc' => 'کلینیکونه، درملتونونه او روغتیا پورې اړوند خدمات.'],
            ],
            [
                'slug' => 'other',
                'en' => ['label' => 'Other Business', 'desc' => 'Categories that do not fit into specific types.'],
                'fa' => ['label' => 'سایر کسب و کارها', 'desc' => 'دسته‌بندی‌هایی که در انواع خاص قرار نمی‌گیرند.'],
                'ps' => ['label' => 'نورې سوداګرۍ', 'desc' => 'هغه کټګورۍ چې په ځانګړو ډولونو کې نه راځي.'],
            ],
        ];

        foreach ($types as $type) {
            $id = DB::table('page_types')->insertGetId([
                'slug' => $type['slug'],
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            DB::table('page_type_translations')->insert([
                [
                    'page_type_id' => $id,
                    'locale' => 'en',
                    'label' => $type['en']['label'],
                    'description' => $type['en']['desc'],
                ],
                [
                    'page_type_id' => $id,
                    'locale' => 'fa',
                    'label' => $type['fa']['label'],
                    'description' => $type['fa']['desc'],
                ],
                [
                    'page_type_id' => $id,
                    'locale' => 'ps',
                    'label' => $type['ps']['label'],
                    'description' => $type['ps']['desc'],
                ],
            ]);
        }
    }
}
