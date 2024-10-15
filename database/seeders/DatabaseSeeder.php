<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            ContinentTableSeeder::class,
            CountryTableSeeder::class,
            AccountTypeTableSeeder::class,
            RoleTableSeeder::class,
            PermissionTableSeeder::class,
            UserTableSeeder::class,
            MemberTypeTableSeeder::class,
            AlbumTableSeeder::class,
            GallerySettingTableSeeder::class

        ]);
    }
}
