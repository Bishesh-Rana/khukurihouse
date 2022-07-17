<?php

namespace Database\Seeders;
use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            "id" => 1,
            "site_name" => 'Gorkha khukuri',
            "address" => "Kathmandu, Nepal",
            "phone" => '1234567890',
            "email" => "nectardigit@gmail.com",
            "site_url" => 'nectardigit.com.np',

        ];
        DB::table('tbl_settings')->updateOrInsert($data);
    }
}
