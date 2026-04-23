<?php

namespace Database\Seeders\Asset;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AssetRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $roles = [
            [
                'name' => 'admin',
                'sort_order' => 1,
                'translations' => [
                    ['locale' => 'en', 'label' => 'Admin'],
                    ['locale' => 'fa', 'label' => 'مدیر'],
                    ['locale' => 'ps', 'label' => 'مدیر'],
                ],
            ],
            [
                'name' => 'editor',
                'sort_order' => 2,
                'translations' => [
                    ['locale' => 'en', 'label' => 'Editor'],
                    ['locale' => 'fa', 'label' => 'ایدیتور'],
                    ['locale' => 'ps', 'label' => 'ایډیټر'],
                ],
            ],
            [
                'name' => 'member',
                'sort_order' => 3,
                'translations' => [
                    ['locale' => 'en', 'label' => 'Member'],
                    ['locale' => 'fa', 'label' => 'عضو'],
                    ['locale' => 'ps', 'label' => 'غړی'],
                ],
            ],
        ];

        foreach ($roles as $role) {
            // 1. Insert the base Asset Role
            $roleId = DB::table('asset_roles')->insertGetId([
                'name' => $role['name'],
                'sort_order' => $role['sort_order'],
                'fixed_at' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            // 2. Prepare translations for insertion
            $roleTranslations = array_map(function ($trans) use ($roleId) {
                return [
                    'asset_role_id' => $roleId,
                    'locale' => $trans['locale'],
                    'label' => $trans['label'],
                ];
            }, $role['translations']);

            // 3. Insert the translations
            DB::table('asset_role_translations')->insert($roleTranslations);
        }
    }
}
