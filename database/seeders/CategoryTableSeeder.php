<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\News;
use Database\Factories\CategoryFactory;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker::create();
        foreach (range(1,20) as $index) {
            $category_name = $faker->name();
	        Category::insert([
	            'category_name'=>$category_name,
                'category_slug'=>Str::slug($category_name),
                'category_id'=>$faker->randomElement($array = array (0,2,4,2)),
                'position'=>$faker->randomDigit(),
                'featured'=>$faker->randomElement($array = array('0','1')),
                'image'=>'noimage.png',
                'banner_image'=>'nobanner.png',
                'category_icon'=>'noicon.png',
                'alt'=>$category_name,
                'show_on_home'=>'1',
                'placement'=>$faker->randomElement($array = array ('none', 'first', 'second', 'third')),
                'hot_new_arrivals'=>$faker->randomElement($array = array('0','1')),
                'publish_status'=>'1',
                'delete_status'=>'0',
                'meta_title'=>$category_name,
                'meta_keyword'=>$category_name,
                'meta_description'=>$faker->text($maxNbChars = 200),
                'created_at'=>date('Y-m-d H:i:s:a'),
                'updated_at'=>date('Y-m-d H:i:s:a'),
	        ]);
	    }
    }
}
