<?php

namespace Database\Seeders\User;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
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
                'fixed_at' => $now,
                'sort_order' => 1,
                'en' => 'Admin',
                'fa' => 'مدیر سیستم',
                'ps' => 'د سیستم مدیر',
            ],
            [
                'name' => 'finance_manager',
                'fixed_at' => $now,
                'sort_order' => 2,
                'en' => 'Finance Manager',
                'fa' => 'مدیریت مالی',
                'ps' => 'مالي مدیریت',
            ],
            [
                'name' => 'moderator',
                'fixed_at' => $now,
                'sort_order' => 3,
                'en' => 'Moderator',
                'fa' => 'ناظر',
                'ps' => 'څارونکی',
            ],
            [
                'name' => 'editor',
                'fixed_at' => $now,
                'sort_order' => 4,
                'en' => 'Editor',
                'fa' => 'ایدیتور',
                'ps' => 'ایډیټر',
            ],
            [
                'name' => 'member',
                'fixed_at' => $now,
                'sort_order' => 5,
                'en' => 'Member',
                'fa' => 'عضو',
                'ps' => 'غړی',
            ],
        ];

        foreach ($roles as $role) {
            $roleId = DB::table('roles')->insertGetId([
                'name' => $role['name'],
                'sort_order' => $role['sort_order'],
                'fixed_at' => $role['fixed_at'],
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            DB::table('role_translations')->insert([
                ['role_id' => $roleId, 'locale' => 'en', 'label' => $role['en']],
                ['role_id' => $roleId, 'locale' => 'fa', 'label' => $role['fa']],
                ['role_id' => $roleId, 'locale' => 'ps', 'label' => $role['ps']],
            ]);
        }
    }
}
