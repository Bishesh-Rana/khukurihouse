<?php

namespace Database\Seeders;

use App\Models\Advertisement;
use Illuminate\Database\Seeder;

class AdvertisementTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Advertisement::insert([
            [
                'link'=>'facebook.com',
                'placement'=>'mid-left',
                'publish_status'=>'1',
                'delete_status'=>'0',
                'featured'=>'1'
            ],
            [
                'link'=>'facebook.com',
                'placement'=>'mid-right',
                'publish_status'=>'1',
                'delete_status'=>'0',
                'featured'=>'1'
            ],
            [
                'link'=>'facebook.com',
                'placement'=>'deal-ad',
                'publish_status'=>'1',
                'delete_status'=>'0',
                'featured'=>'1'
            ],
            [
                'link'=>'facebook.com',
                'placement'=>'deal-ad',
                'publish_status'=>'1',
                'delete_status'=>'0',
                'featured'=>'1'
            ],
            [
                'link'=>'facebook.com',
                'placement'=>'deal-ad',
                'publish_status'=>'1',
                'delete_status'=>'0',
                'featured'=>'1'
            ],
        ]);
    }
}
