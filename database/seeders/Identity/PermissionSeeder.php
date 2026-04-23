<?php

namespace Database\Seeders\User;

use App\Enums\Identity\PermissionGroup;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();

        $data = [
            // --- USER MANAGEMENT ---
            ['group' => PermissionGroup::USER_MANAGEMENT, 'name' => 'user.view_any', 'labels' => ['en' => 'View All Users', 'ps' => 'ټول کاروونکي لیدل', 'fa' => 'مشاهده همه کاربران']],
            ['group' => PermissionGroup::USER_MANAGEMENT, 'name' => 'user.block', 'labels' => ['en' => 'Block Users', 'ps' => 'کاروونکي بلاک کول', 'fa' => 'بلاک کردن کاربران']],
            ['group' => PermissionGroup::USER_MANAGEMENT, 'name' => 'user.delete', 'labels' => ['en' => 'Delete Users', 'ps' => 'کاروونکي حذفول', 'fa' => 'حذف کاربران']],
            ['group' => PermissionGroup::USER_MANAGEMENT, 'name' => 'profile.view', 'labels' => ['en' => 'View Own Profile', 'ps' => 'خپل پروفایل لیدل', 'fa' => 'مشاهده پروفایل خود']],
            ['group' => PermissionGroup::USER_MANAGEMENT, 'name' => 'profile.edit', 'labels' => ['en' => 'Edit Own Profile', 'ps' => 'خپل پروفایل ایډېټ کول', 'fa' => 'ایدیټ کردن پروفایل خود']],
            ['group' => PermissionGroup::USER_MANAGEMENT, 'name' => 'profile.password', 'labels' => ['en' => 'Change Own Password', 'ps' => 'خپل پاسورډ بدلول', 'fa' => 'تغییر رمز عبور خود']],

            // --- CATEGORY MANAGEMENT ---
            ['group' => PermissionGroup::CATEGORY_MANAGEMENT, 'name' => 'category.view_any', 'labels' => ['en' => 'View Categories', 'ps' => 'د کتګوریو لیدل', 'fa' => 'مشاهده کتگوری‌ها']],
            ['group' => PermissionGroup::CATEGORY_MANAGEMENT, 'name' => 'category.create', 'labels' => ['en' => 'Create Category', 'ps' => 'کتګوری جوړول', 'fa' => 'ایجاد کتگوری']],
            ['group' => PermissionGroup::CATEGORY_MANAGEMENT, 'name' => 'category.edit_any', 'labels' => ['en' => 'Edit Any Category', 'ps' => 'د هر ډول کتګوری ایډېټ کول', 'fa' => 'ایدیټ کردن هر نوع کتگوری']],
            ['group' => PermissionGroup::CATEGORY_MANAGEMENT, 'name' => 'category.hide_any', 'labels' => ['en' => 'Hide Any Category', 'ps' => 'د هر ډول کتګوری پټول', 'fa' => 'مخفی کردن هر نوع کتگوری']],
            ['group' => PermissionGroup::CATEGORY_MANAGEMENT, 'name' => 'category.delete_any', 'labels' => ['en' => 'Delete Any Category', 'ps' => 'د هر ډول کتګوری حذف کول', 'fa' => 'حذف کردن هر نوع کتگوری']],

            // --- PAGE MANAGEMENT ---
            ['group' => PermissionGroup::PAGE_MANAGEMENT, 'name' => 'page.view_own', 'labels' => ['en' => 'View Own Pages', 'ps' => 'خپلې پاڼی لیدل', 'fa' => 'مشاهده صفحات خود']],
            ['group' => PermissionGroup::PAGE_MANAGEMENT, 'name' => 'page.view_any', 'labels' => ['en' => 'View All Pages', 'ps' => 'ټولې پاڼې لیدل', 'fa' => 'مشاهده همه صفحات']],
            ['group' => PermissionGroup::PAGE_MANAGEMENT, 'name' => 'page.create', 'labels' => ['en' => 'Create Page', 'ps' => 'پاڼه جوړول', 'fa' => 'ایجاد صفحه']],
            ['group' => PermissionGroup::PAGE_MANAGEMENT, 'name' => 'page.edit_own', 'labels' => ['en' => 'Edit Own Page', 'ps' => 'خپله پاڼه ایډېټ کول', 'fa' => 'ایدیټ کردن صفحه خود']],
            ['group' => PermissionGroup::PAGE_MANAGEMENT, 'name' => 'page.hide_own', 'labels' => ['en' => 'Hide Own Page', 'ps' => 'خپله پاڼه پټول', 'fa' => 'مخفی کردن صفحه خود']],
            ['group' => PermissionGroup::PAGE_MANAGEMENT, 'name' => 'page.delete_own', 'labels' => ['en' => 'Delete Own Page', 'ps' => 'خپله پاڼه حذف کول', 'fa' => 'حذف کردن صفحه خود']],
            ['group' => PermissionGroup::PAGE_MANAGEMENT, 'name' => 'page.edit_any', 'labels' => ['en' => 'Edit Any Page', 'ps' => 'د هر ډول پاڼې ایډیټ کول', 'fa' => 'ایدیت کردن هر نوع صفحه']],
            ['group' => PermissionGroup::PAGE_MANAGEMENT, 'name' => 'page.hide_any', 'labels' => ['en' => 'Hide Any Page', 'ps' => 'د هر ډول پاڼې پټول', 'fa' => 'مخفی کردن هر نوع صفحه']],
            ['group' => PermissionGroup::PAGE_MANAGEMENT, 'name' => 'page.delete_any', 'labels' => ['en' => 'Delete Any Page', 'ps' => 'د هر ډول پاڼې حذف کول', 'fa' => 'حذف کردن هر نوع صفحه']],
            ['group' => PermissionGroup::PAGE_MANAGEMENT, 'name' => 'page.verify', 'labels' => ['en' => 'Verify Pages', 'ps' => 'پاڼې تاییدول', 'fa' => 'تایید صفحات']],

            // --- BANNER MANAGEMENT ---
            ['group' => PermissionGroup::BANNER_MANAGEMENT, 'name' => 'banner.view_any', 'labels' => ['en' => 'View All Banners', 'ps' => 'ټول بنرونه لیدل', 'fa' => 'مشاهده همه بنرها']],
            ['group' => PermissionGroup::BANNER_MANAGEMENT, 'name' => 'banner.view_own', 'labels' => ['en' => 'View Own Banners', 'ps' => 'خپل بنرونه لیدل', 'fa' => 'مشاهده بنرهای خود']],
            ['group' => PermissionGroup::BANNER_MANAGEMENT, 'name' => 'banner.create', 'labels' => ['en' => 'Create Banner', 'ps' => 'بنر جوړول', 'fa' => 'ایجاد بنر']],
            ['group' => PermissionGroup::BANNER_MANAGEMENT, 'name' => 'banner.edit_own', 'labels' => ['en' => 'Edit Own Banners', 'ps' => 'خپل بنرونه ایډېټ کول', 'fa' => 'ایدیټ کردن بنرهای خود']],
            ['group' => PermissionGroup::BANNER_MANAGEMENT, 'name' => 'banner.hide_own', 'labels' => ['en' => 'Hide Own Banner', 'ps' => 'خپل بنر پټول', 'fa' => 'مخفی کردن بنر خود']],
            ['group' => PermissionGroup::BANNER_MANAGEMENT, 'name' => 'banner.delete_own', 'labels' => ['en' => 'Delete Own Banner', 'ps' => 'خپل بنر حذف کول', 'fa' => 'حذف کردن بنر خود']],
            ['group' => PermissionGroup::BANNER_MANAGEMENT, 'name' => 'banner.edit_any', 'labels' => ['en' => 'Edit Any ‌Banner', 'ps' => 'د هر ډول بنر ایډیټ کول', 'fa' => 'ایدیت کردن هر نوع بنر']],
            ['group' => PermissionGroup::BANNER_MANAGEMENT, 'name' => 'banner.hide_any', 'labels' => ['en' => 'Hide Any Banner', 'ps' => 'د هر ډول بنر پټول', 'fa' => 'مخفی کردن هر نوع بنر']],
            ['group' => PermissionGroup::BANNER_MANAGEMENT, 'name' => 'banner.delete_any', 'labels' => ['en' => 'Delete Any Banner', 'ps' => 'د هر ډول بنر حذف کول', 'fa' => 'حذف کردن هر نوع بنر']],

            // --- AD MANAGEMENT ---
            ['group' => PermissionGroup::AD_MANAGEMENT, 'name' => 'ad.view_any', 'labels' => ['en' => 'View All Ads', 'ps' => 'ټول اعلانونه لیدل', 'fa' => 'مشاهده همه تبلیغات']],
            ['group' => PermissionGroup::AD_MANAGEMENT, 'name' => 'ad.view_own', 'labels' => ['en' => 'View Own Ads', 'ps' => 'خپل اعلانونه لیدل', 'fa' => 'مشاهده تبلیغات خود']],
            ['group' => PermissionGroup::AD_MANAGEMENT, 'name' => 'ad.create', 'labels' => ['en' => 'Create Ad', 'ps' => 'اعلان جوړول', 'fa' => 'ایجاد تبلیغ']],
            ['group' => PermissionGroup::AD_MANAGEMENT, 'name' => 'ad.edit_own', 'labels' => ['en' => 'Edit Own Ads', 'ps' => 'خپل اعلانونه ایډېټ کول', 'fa' => 'ایدیټ کردن تبلیغات خود']],
            ['group' => PermissionGroup::AD_MANAGEMENT, 'name' => 'ad.hide_own', 'labels' => ['en' => 'Hide Own Ad', 'ps' => 'خپل اعلان پټول', 'fa' => 'مخفی کردن تبلیغ خود']],
            ['group' => PermissionGroup::AD_MANAGEMENT, 'name' => 'ad.delete_own', 'labels' => ['en' => 'Delete Own Ad', 'ps' => 'خپل اعلان حذف کول', 'fa' => 'حذف کردن تبلیغ خود']],
            ['group' => PermissionGroup::AD_MANAGEMENT, 'name' => 'ad.edit_any', 'labels' => ['en' => 'Edit Any Ad', 'ps' => 'د هر ډول اعلان ایډیټ کول', 'fa' => 'ایدیت کردن هر نوع تبلیغ']],
            ['group' => PermissionGroup::AD_MANAGEMENT, 'name' => 'ad.hide_any', 'labels' => ['en' => 'Hide Any Ad', 'ps' => 'د هر ډول اعلان پټول', 'fa' => 'مخفی کردن هر نوع تبلیغ']],
            ['group' => PermissionGroup::AD_MANAGEMENT, 'name' => 'ad.delete_any', 'labels' => ['en' => 'Delete Any Ad', 'ps' => 'د هر ډول اعلان حذف کول', 'fa' => 'حذف کردن هر نوع تبلیغ']],

            // --- SYSTEM MANAGEMENT ---
            ['group' => PermissionGroup::SYSTEM_MANAGEMENT, 'name' => 'system.settings_edit', 'labels' => ['en' => 'Edit System Settings', 'ps' => 'د سیسټم تنظیمات ایډېټ کول', 'fa' => 'ادیت کردن تنظیمات سیستم']],
            ['group' => PermissionGroup::SYSTEM_MANAGEMENT, 'name' => 'system.logs_view', 'labels' => ['en' => 'View Activity Logs', 'ps' => 'د فعالیت لاګونه لیدل', 'fa' => 'مشاهده لاگ‌های فعالیت']],
            ['group' => PermissionGroup::SYSTEM_MANAGEMENT, 'name' => 'system.cache_clear', 'labels' => ['en' => 'Clear System Cache', 'ps' => 'د سیسټم کیش پاکول', 'fa' => 'پاکسازی کش سیستم']],
        ];

        foreach ($data as $item) {
            // Create the base permission
            $permissionId = DB::table('permissions')->insertGetId([
                'group' => $item['group'],
                'name' => $item['name'],
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            // Prepare translations
            $translations = [];
            foreach ($item['labels'] as $locale => $label) {
                $translations[] = [
                    'permission_id' => $permissionId,
                    'locale' => $locale,
                    'label' => $label,
                ];
            }

            // Bulk insert translations for this permission
            DB::table('permission_translations')->insert($translations);
        }
    }
}
