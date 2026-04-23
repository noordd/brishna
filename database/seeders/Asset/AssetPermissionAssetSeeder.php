<?php

namespace Database\Seeders\Asset;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssetPermissionAssetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // fetch the ID of the 'page' asset
        $pageAssetId = DB::table('assets')
            ->where('slug', 'page')
            ->value('id');

        if (! $pageAssetId) {
            $this->command->error("Asset 'page' not found. Please seed the assets table first!");

            return;
        }

        // fetch all IDs from asset_permissions
        $permissionIds = DB::table('asset_permissions')->pluck('id');

        if ($permissionIds->isEmpty()) {
            $this->command->error('No permissions found. Please seed asset_permissions first!');

            return;
        }

        // prepare the data for the pivot table
        $pivotData = $permissionIds->map(function ($permissionId) use ($pageAssetId) {
            return [
                'asset_id' => $pageAssetId,
                'asset_permission_id' => $permissionId,
            ];
        })->toArray();

        // insert into the pivot table
        // using insertOrIgnore to prevent errors if the seeder is run multiple times
        DB::table('asset_permission_asset')->insertOrIgnore($pivotData);

        $this->command->info('Successfully linked '.count($pivotData)." permissions to the 'page' asset.");
    }
}
