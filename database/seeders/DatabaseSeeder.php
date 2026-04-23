<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Database\Seeders\Asset\AssetPermissionAssetSeeder;
use Database\Seeders\Asset\AssetPermissionRoleSeeder;
use Database\Seeders\Asset\AssetPermissionSeeder;
use Database\Seeders\Asset\AssetRoleSeeder;
use Database\Seeders\Asset\AssetSeeder;
use Database\Seeders\Content\AdSeeder;
use Database\Seeders\Content\BannerSeeder;
use Database\Seeders\Localization\CountrySeeder;
use Database\Seeders\Localization\LocaleSeeder;
use Database\Seeders\Localization\ProvinceSeeder;
use Database\Seeders\Page\PageBadgeSeeder;
use Database\Seeders\Page\PageTypeSeeder;
use Database\Seeders\Taxonomy\CategorySeeder;
use Database\Seeders\Unit\CoinSeeder;
use Database\Seeders\Unit\CurrencySeeder;
use Database\Seeders\User\PermissionRoleSeeder;
use Database\Seeders\User\PermissionSeeder;
use Database\Seeders\User\RoleSeeder;
use Database\Seeders\User\UserSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(LocaleSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(ProvinceSeeder::class);

        $this->call(AssetRoleSeeder::class);
        $this->call(AssetPermissionSeeder::class);
        $this->call(AssetPermissionRoleSeeder::class);
        $this->call(AssetSeeder::class);

        $this->call(PageTypeSeeder::class);
        $this->call(PageBadgeSeeder::class);

        $this->call(PermissionSeeder::class);
        $this->call(AssetPermissionAssetSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(PermissionRoleSeeder::class);
        $this->call(UserSeeder::class);

        $this->call(CategorySeeder::class);

        $this->call(CurrencySeeder::class);
        $this->call(CoinSeeder::class);

        $this->call(AdSeeder::class);

        $this->call(BannerSeeder::class);
    }
}
