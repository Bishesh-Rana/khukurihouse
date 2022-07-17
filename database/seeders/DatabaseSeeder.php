<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(PermissionTableSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(SettingSeeder::class);
        // $this->call(CategoryTableSeeder::class);
        // $this->call(ProductTableSeeder::class);
        // $this->call(AdvertisementTableSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(ProvinceSeeder::class);
        $this->call(DistrictSeeder::class);
    }
}
