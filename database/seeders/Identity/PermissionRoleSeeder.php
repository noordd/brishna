<?php

namespace Database\Seeders\User;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing assignments for targeted roles
        DB::table('permission_role')->whereIn('role_id', [3, 4, 5])->delete();

        // --- 1. EDITOR (Role ID: 4) ---
        // Rules: Full control over Categories, Pages, Banners, and Ads.
        $editorPermissions = [
            4, 5, 6,                                // Profile: view, edit, password
            7, 8, 9, 10, 11,                        // Categories: ALL (7-11)
            12, 13, 14, 15, 16, 17, 18, 19, 20, 21, // Pages: ALL (12-21, includes view_own, edit_any, delete_any, verify)
            22, 23, 24, 25, 26, 27, 28, 29, 30,     // Banners: ALL (22-30)
            31, 32, 33, 34, 35, 36, 37, 38, 39,     // Ads: ALL (31-39)
        ];

        // --- 2. MODERATOR (Role ID: 3) ---
        // Rules: Block users, Edit Category, Hide/Edit any page/ad, Verify page.
        // Specifically: NO Creation (14) and NO Deletion (17, 20) of pages.
        $moderatorPermissions = [
            1, 2,           // user.view_any, user.block
            4, 5, 6,        // Profile group
            9, 10,          // category.edit_any, category.hide_any
            13, 18, 19, 21, // page.view_any, .edit_any, .hide_any, .verify
            37, 38,         // ad.edit_any, ad.hide_any
        ];

        // --- 3. MEMBER (Role ID: 5) ---
        // Rules: Own content only for ads/pages.
        // Includes: view_own (12), edit_own (15), hide_own (16), delete_own (17).
        // Strictly NO Banners (22-30 excluded).
        $memberPermissions = [
            4, 5, 6,            // Profile group
            12, 14, 15, 16, 17, // Pages: view_own, create, edit_own, hide_own, delete_own
            32, 33, 34, 35, 36, // Ads: view_own, create, edit_own, hide_own, delete_own
        ];

        $this->sync(4, $editorPermissions);
        $this->sync(3, $moderatorPermissions);
        $this->sync(5, $memberPermissions);
    }

    /**
     * Helper to map and insert permissions for a role
     */
    private function sync(int $roleId, array $permissionIds): void
    {
        $data = array_map(fn ($pId) => [
            'role_id' => $roleId,
            'permission_id' => $pId,
        ], $permissionIds);

        DB::table('permission_role')->insert($data);
    }
}
