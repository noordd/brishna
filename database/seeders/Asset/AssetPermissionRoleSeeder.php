<?php

namespace Database\Seeders\Asset;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssetPermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fetch Role IDs
        $editorRoleId = DB::table('asset_roles')->where('name', 'editor')->value('id');
        $memberRoleId = DB::table('asset_roles')->where('name', 'member')->value('id');

        if (! $editorRoleId || ! $memberRoleId) {
            $this->command->error("Roles 'editor' or 'member' not found. Seed roles first!");

            return;
        }

        // Fetch All Permission IDs using Dot Notation names
        $permissions = DB::table('asset_permissions')->pluck('id', 'name');

        $rolePermissions = [];

        // --- EDITOR ASSIGNMENTS ---
        $editorPermissions = [
            'ads.view.any',
            'ads.view.own',
            'ads.create',
            'ads.edit.any',
            'ads.edit.own',
            'ads.delete.any',
            'ads.delete.own',
            'ads.hide.any',
            'ads.hide.own',
            'settings.analytics.view',
        ];

        foreach ($editorPermissions as $name) {
            if (isset($permissions[$name])) {
                $rolePermissions[] = [
                    'asset_role_id' => $editorRoleId,
                    'asset_permission_id' => $permissions[$name],
                ];
            }
        }

        // --- MEMBER ASSIGNMENTS ---
        $memberPermissions = [
            'ads.view.own',
            'ads.create',
            'ads.edit.own',
            'ads.delete.own',
            'ads.hide.own',
        ];

        foreach ($memberPermissions as $name) {
            if (isset($permissions[$name])) {
                $rolePermissions[] = [
                    'asset_role_id' => $memberRoleId,
                    'asset_permission_id' => $permissions[$name],
                ];
            }
        }

        // Sync to Pivot Table
        // Using insertOrIgnore to prevent primary key collisions on re-runs
        DB::table('asset_permission_asset_role')->insertOrIgnore($rolePermissions);

        $this->command->info('Dot-notation permissions successfully assigned to Editor and Member roles.');
    }
}
