<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Stock;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Factory::create();

        foreach(range(1,500) as $key => $index){
            $product_name = $faker->name();
            Product::insert([
                'category_id'=>$faker->randomDigitNot(0),
                'owner_id'=>1,
                'product_name'=>$product_name,
                'product_code'=>$faker->unixTime($max = 'now').$faker->randomLetter(),
                'product_slug'=>Str::slug($product_name),
                'product_brand'=>$faker->randomElement($array = array ('Nike','Adidas','Under Armor','Dior','Zara','Louis Vuitton')),
                'product_model'=>$faker->word(),
                'product_highlights'=>$faker->sentence($nbWords = 6, $variableNbWords = true),
                'product_description'=>$faker->text($maxNbChars = 200),
                'product_warranty_type'=>$faker->randomElement(($array = ['international_manufacturer_warranty','non_local_warranty','local_seller_warranty','no_warranty','international_seller_warranty','international_warranty','local_warranty','original_product','brand_warranty'])),
                'product_warrenty_period'=>$faker->randomElement($array = array ('1 years','5 years','18 months')),
                'product_warrenty_policy'=>$faker->sentence($nbWords=6, $variableNbWords=true),
                'product_whats_on_box'=>$faker->sentence($nbWords=6, $variableNbWords=true),
                'product_package_weight'=>$faker->randomElement($array = array(198, 3, 25)),
                'weight_measure'=>1,
                'product_package_dimension'=>$faker->randomElement($array = array('5*15*10', '15*28*10', '25*10*9')),
                'product_video_url'=>'https://www.youtube.com/watch?v=S3B7Bvidrjo',
                'home_delivery'=>$faker->randomElement($array = array(0,1)),
                'delivery_charges'=>$faker->randomElement($array = array(150, 50, 100)),
                'tax'=>$faker->randomElement($array = array(0, 15, 36)),
                'product_original_price'=> $faker->numberBetween($min = 1000, $max = 9000),
                'product_compare_price'=>$faker->numberBetween($min = 100, $max = 900),
                'product_key_features'=>$faker->realText($maxNbChars = 200, $indexSize = 2),
                'product_sku'=>$faker->numberBetween($min = 100000, $max = 900000),
                'image'=>'https://source.unsplash.com/bUVwWCSiDss',
                'alt'=>$product_name,
                'on_sale'=>$faker->randomElement($array = array('0','1')),
                'best_rated'=>$faker->randomElement($array = array('0','1')),
                'on_deal'=>$faker->randomElement($array = array('0','1')),
                'deal_end_date'=>$faker->randomElement($array = array(null, $faker->date($format = 'Y-m-d', $min = 'now'))),
                'publish_status'=>'1',
                'delete_status'=>'0',
                'live_status'=>$faker->randomElement($array = array('0','1')),
                'quality_status'=>$faker->randomElement($array = array('0','1')),
                'quality_reject_reason'=>null,
                'quality_control_comment'=>null,
                'policy_status'=>$faker->randomElement($array = array('0','1')),
                'policy_reject_reason'=>null,
                'policy_control_comment'=>null,
                'penalty_type'=>null,
                'created_by'=>1,
                'updated_by'=>1,
                'meta_title'=>$product_name,
                'meta_keyword'=>$product_name,
                'meta_description'=>$faker->word(),
                'created_at'=>date('Y-m-d H:i:s:a'),
                'updated_at'=>date('Y-m-d H:i:s:a'),
                'deliveryType'=>$faker->randomElement($array = array ('cargo','delivery_truck')),
            ]);
            $old = $faker->numberBetween($min = 0, $max = 100);
            $new = $faker->numberBetween($min = 0, $max = 100);
            $damaged = $faker->numberBetween($min = 0, $max = 10);
            $return = $faker->numberBetween($min = 0, $max = 10);
            $returned_damaged = $faker->numberBetween($min = 0, $max = 10);
            Stock::insert([
                'product_id'=> $key+1,
                'old_stock' =>$old,
                'new_stock'=> $new,
                'total_stock'=>$old+$new,
                'damaged_stock'=>$damaged,
                'returned_stock'=>$return,
                'returned_damage_stock'=>$returned_damaged,
                'withholding_stock'=>$faker->numberBetween($min = 0, $max = 10),
                'delivered_stock'=>$faker->numberBetween($min = 0, $max = 10),
                'sellable_stock'=>$faker->numberBetween($min = 0, $max = 75),
                'remaining_stock'=>$faker->numberBetween($min = 0, $max = 75),
                'updated_by'=> 1,
            ]);
        }
    }
}
