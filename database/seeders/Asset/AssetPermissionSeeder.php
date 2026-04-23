<?php

namespace Database\Seeders\Asset;

use App\Domains\Asset\Enums\Authorization\AssetPermissionGroup;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AssetPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $permissions = [
            // --- AD MANAGEMENT ---
            ['group' => AssetPermissionGroup::ADS, 'name' => 'asset.ad.view_any', 'en' => 'View Any Ad', 'fa' => 'مشاهده همه تبلیغات', 'ps' => 'د ټولو اعلاناتو لیدل'],
            ['group' => AssetPermissionGroup::ADS, 'name' => 'asset.ad.view_own', 'en' => 'View Own Ads', 'fa' => 'مشاهده تبلیغات خود', 'ps' => 'د خپلو اعلاناتو لیدل'],
            ['group' => AssetPermissionGroup::ADS, 'name' => 'asset.ad.create', 'en' => 'Create Ads', 'fa' => 'ایجاد تبلیغات', 'ps' => 'د اعلاناتو جوړول'],
            ['group' => AssetPermissionGroup::ADS, 'name' => 'asset.ad.edit_any', 'en' => 'Edit Any Ad', 'fa' => 'ایدیت همه تبلیغات', 'ps' => 'د ټولو اعلاناتو ایډېټ'],
            ['group' => AssetPermissionGroup::ADS, 'name' => 'asset.ad.edit_own', 'en' => 'Edit Own Ads', 'fa' => 'ایدیت تبلیغات خود', 'ps' => 'د خپلو اعلاناتو ایډېټ'],
            ['group' => AssetPermissionGroup::ADS, 'name' => 'asset.ad.delete_any', 'en' => 'Delete Any Ad', 'fa' => 'حذف همه تبلیغات', 'ps' => 'د ټولو اعلاناتو حذفول'],
            ['group' => AssetPermissionGroup::ADS, 'name' => 'asset.ad.delete_own', 'en' => 'Delete Own Ads', 'fa' => 'حذف تبلیغات خود', 'ps' => 'د خپلو اعلاناتو حذفول'],
            ['group' => AssetPermissionGroup::ADS, 'name' => 'asset.ad.hide_any', 'en' => 'Hide Any Ad', 'fa' => 'پنهان‌سازی همه تبلیغات', 'ps' => 'د ټولو اعلاناتو پټول'],
            ['group' => AssetPermissionGroup::ADS, 'name' => 'asset.ad.hide_own', 'en' => 'Hide Own Ads', 'fa' => 'پنهان‌سازی تبلیغات خود', 'ps' => 'د خپلو اعلاناتو پټول'],

            // --- SETTINGS ---
            ['group' => AssetPermissionGroup::SETTINGS, 'name' => 'asset.settings.info_update', 'en' => 'Update Asset Info', 'fa' => 'اپدیت اطلاعات دارایی', 'ps' => 'د اثاثو معلوماتو اپډیټ'],
            ['group' => AssetPermissionGroup::SETTINGS, 'name' => 'asset.settings.contact_manage', 'en' => 'Manage Contact Info', 'fa' => 'مدیریت اطلاعات تماس', 'ps' => 'د اړیکو معلوماتو مدیریت'],
            ['group' => AssetPermissionGroup::SETTINGS, 'name' => 'asset.settings.analytics_view', 'en' => 'View Analytics', 'fa' => 'مشاهده آمار', 'ps' => 'د احصایې لیدل'],
        ];

        foreach ($permissions as $perm) {
            // Note: 'group' is now a string column storing the Enum value (e.g., 'ads')
            $permissionId = DB::table('asset_permissions')->insertGetId([
                'group' => $perm['group']->value,
                'name' => $perm['name'],
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            DB::table('asset_permission_translations')->insert([
                ['asset_permission_id' => $permissionId, 'locale' => 'en', 'label' => $perm['en']],
                ['asset_permission_id' => $permissionId, 'locale' => 'fa', 'label' => $perm['fa']],
                ['asset_permission_id' => $permissionId, 'locale' => 'ps', 'label' => $perm['ps']],
            ]);
        }

        $this->command->info('Asset Permissions seeded successfully using Enums.');

    }
}
