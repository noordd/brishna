<?php

namespace Database\Seeders\User;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = Hash::make('Gun##007');
        $now = now();

        // Create the Admin User (Noorullah Shirzai)
        $adminId = (string) uuid7();
        DB::table('users')->insert([
            'id' => $adminId,
            'province_id' => 14, // Kabul Province
            'email' => 'innniss@gmail.com',
            'mobile' => '0700000000',
            'password' => $password,
            'activated_at' => $now,
            'email_verified_at' => $now,
            'root_at' => $now, // Admin is the root user
            'created_at' => $now,
            'updated_at' => $now,
            'slug_at' => $now,
        ]);

        $this->addTranslations($adminId, 'Noorullah Shirzai', 'Administrator of the system.');
        DB::table('role_user')->insert(['role_id' => 1, 'user_id' => $adminId]); // Admin Role

        // Create 10 Random Users
        // Moderator, Editor, Member
        $roles = [3, 4, 5];
        $names = ['Ahmad', 'Zala', 'Mustafa', 'Sahar', 'Omar', 'Mariam', 'Bilal', 'Nargis', 'Helai', 'Idrees'];

        foreach ($names as $index => $firstName) {
            $userId = (string) uuid7();
            $email = strtolower($firstName) . $index . '@example.com';

            DB::table('users')->insert([
                'id' => $userId,
                'province_id' => rand(1, 34), // Random Province
                'email' => $email,
                'mobile' => '07' . rand(10000000, 99999999),
                'password' => $password,
                'activated_at' => $now,
                'email_verified_at' => $now,
                'created_at' => $now,
                'updated_at' => $now,
                'slug_at' => $now,
            ]);

            // Add multi-language translations
            $this->addTranslations($userId, $firstName . ' User', 'This is a roaming social profile.');

            // Assign a random role (Moderator, Editor, or Member)
            DB::table('role_user')->insert([
                'role_id' => $roles[array_rand($roles)],
                'user_id' => $userId,
            ]);
        }
    }

    /**
     * Helper to add translations for PS, FA, and EN
     */
    private function addTranslations($userId, $name, $bio): void
    {
        $locales = [
            'en' => ['name' => $name, 'content' => "English Bio: $bio"],
            'ps' => ['name' => $name . ' (پښتو)', 'content' => 'د کارونکي پېژندنه په پښتو کې'],
            'fa' => ['name' => $name . ' (فارسی)', 'content' => 'بیوگرافی کاربر به زبان فارسی'],
        ];

        foreach ($locales as $code => $data) {
            DB::table('user_translations')->insert([
                'id' => uuid7(),
                'user_id' => $userId,
                'locale' => $code,
                'name' => $data['name'],
                'content' => $data['content'],
            ]);
        }
    }
}
