<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionTableSeeder extends Seeder
{
    private function permissionTable()
    {
        return [
            [
                'name' => 'browse_content',
                'guard_name' => 'admin',
                'table_name' => 'tbl_contents',
            ],
            [
                'name' => 'create_content',
                'guard_name' => 'admin',
                'table_name' => 'tbl_contents',
            ],
            [
                'name' => 'read_content',
                'guard_name' => 'admin',
                'table_name' => 'tbl_contents',
            ],
            [
                'name' => 'update_content',
                'guard_name' => 'admin',
                'table_name' => 'tbl_contents',
            ],
            [
                'name' => 'delete_content',
                'guard_name' => 'admin',
                'table_name' => 'tbl_contents',
            ],

            [
                'name' => 'browse_role',
                'guard_name' => 'admin',
                'table_name' => 'tbl_roles',
            ],
            [
                'name' => 'create_role',
                'guard_name' => 'admin',
                'table_name' => 'tbl_roles',
            ],
            [
                'name' => 'read_role',
                'guard_name' => 'admin',
                'table_name' => 'tbl_roles',
            ],
            [
                'name' => 'update_role',
                'guard_name' => 'admin',
                'table_name' => 'tbl_roles',
            ],
            [
                'name' => 'delete_role',
                'guard_name' => 'admin',
                'table_name' => 'tbl_roles',
            ],
            [
                'name' => 'browse_admin',
                'guard_name' => 'admin',
                'table_name' => 'tbl_admins',
            ],
            [
                'name' => 'create_admin',
                'guard_name' => 'admin',
                'table_name' => 'tbl_admins',
            ],
            [
                'name' => 'read_admin',
                'guard_name' => 'admin',
                'table_name' => 'tbl_admins',
            ],
            [
                'name' => 'update_admin',
                'guard_name' => 'admin',
                'table_name' => 'tbl_admins',
            ],
            [
                'name' => 'delete_admin',
                'guard_name' => 'admin',
                'table_name' => 'tbl_admins',
            ],
            [
                'name' => 'browse_seller',
                'guard_name' => 'admin',
                'table_name' => 'tbl_sellers',
            ],
            [
                'name' => 'create_seller',
                'guard_name' => 'admin',
                'table_name' => 'tbl_sellers',
            ],
            [
                'name' => 'read_seller',
                'guard_name' => 'admin',
                'table_name' => 'tbl_sellers',
            ],
            [
                'name' => 'update_seller',
                'guard_name' => 'admin',
                'table_name' => 'tbl_sellers',
            ],
            [
                'name' => 'delete_seller',
                'guard_name' => 'admin',
                'table_name' => 'tbl_sellers',
            ],
            [
                'name' => 'browse_slider',
                'guard_name' => 'admin',
                'table_name' => 'tbl_sliders',
            ],
            [
                'name' => 'create_slider',
                'guard_name' => 'admin',
                'table_name' => 'tbl_sliders',
            ],
            [
                'name' => 'read_slider',
                'guard_name' => 'admin',
                'table_name' => 'tbl_sliders',
            ],
            [
                'name' => 'update_slider',
                'guard_name' => 'admin',
                'table_name' => 'tbl_sliders',
            ],
            [
                'name' => 'delete_slider',
                'guard_name' => 'admin',
                'table_name' => 'tbl_sliders',
            ],
            [
                'name' => 'browse_child_category',
                'guard_name' => 'admin',
                'table_name' => 'tbl_child_categories',
            ],
            [
                'name' => 'create_child_category',
                'guard_name' => 'admin',
                'table_name' => 'tbl_child_categories',
            ],
            [
                'name' => 'read_child_category',
                'guard_name' => 'admin',
                'table_name' => 'tbl_child_categories',
            ],
            [
                'name' => 'update_child_category',
                'guard_name' => 'admin',
                'table_name' => 'tbl_child_categories',
            ],
            [
                'name' => 'delete_child_category',
                'guard_name' => 'admin',
                'table_name' => 'tbl_child_categories',
            ],
            [
                'name' => 'browse_category',
                'guard_name' => 'admin',
                'table_name' => 'tbl_categories',
            ],
            [
                'name' => 'create_category',
                'guard_name' => 'admin',
                'table_name' => 'tbl_categories',
            ],
            [
                'name' => 'read_category',
                'guard_name' => 'admin',
                'table_name' => 'tbl_categories',
            ],
            [
                'name' => 'update_category',
                'guard_name' => 'admin',
                'table_name' => 'tbl_categories',
            ],
            [
                'name' => 'delete_category',
                'guard_name' => 'admin',
                'table_name' => 'tbl_categories',
            ],
            [
                'name' => 'browse_sub_category',
                'guard_name' => 'admin',
                'table_name' => 'tbl_sub_categories',
            ],
            [
                'name' => 'create_sub_category',
                'guard_name' => 'admin',
                'table_name' => 'tbl_sub_categories',
            ],
            [
                'name' => 'read_sub_category',
                'guard_name' => 'admin',
                'table_name' => 'tbl_sub_categories',
            ],
            [
                'name' => 'update_sub_category',
                'guard_name' => 'admin',
                'table_name' => 'tbl_sub_categories',
            ],
            [
                'name' => 'delete_sub_category',
                'guard_name' => 'admin',
                'table_name' => 'tbl_sub_categories',
            ],

            [
                'name' => 'browse_product',
                'guard_name' => 'admin',
                'table_name' => 'tbl_products',
            ],
            [
                'name' => 'create_product',
                'guard_name' => 'admin',
                'table_name' => 'tbl_products',
            ],
            [
                'name' => 'read_product',
                'guard_name' => 'admin',
                'table_name' => 'tbl_products',
            ],
            [
                'name' => 'update_product',
                'guard_name' => 'admin',
                'table_name' => 'tbl_products',
            ],
            [
                'name' => 'delete_product',
                'guard_name' => 'admin',
                'table_name' => 'tbl_products',
            ],

            [
                'name' => 'browse_setting',
                'guard_name' => 'admin',
                'table_name' => 'tbl_settings',
            ],
            [
                'name' => 'create_setting',
                'guard_name' => 'admin',
                'table_name' => 'tbl_settings',
            ],
            [
                'name' => 'read_setting',
                'guard_name' => 'admin',
                'table_name' => 'tbl_settings',
            ],
            [
                'name' => 'update_setting',
                'guard_name' => 'admin',
                'table_name' => 'tbl_settings',
            ],
            [
                'name' => 'delete_setting',
                'guard_name' => 'admin',
                'table_name' => 'tbl_settings',
            ],

            [
                'name' => 'browse_news',
                'guard_name' => 'admin',
                'table_name' => 'tbl_news',
            ],
            [
                'name' => 'create_news',
                'guard_name' => 'admin',
                'table_name' => 'tbl_news',
            ],
            [
                'name' => 'read_news',
                'guard_name' => 'admin',
                'table_name' => 'tbl_news',
            ],
            [
                'name' => 'update_news',
                'guard_name' => 'admin',
                'table_name' => 'tbl_news',
            ],
            [
                'name' => 'delete_news',
                'guard_name' => 'admin',
                'table_name' => 'tbl_news',
            ],
            [
                'name' => 'browse_news_category',
                'guard_name' => 'admin',
                'table_name' => 'tbl_news_categories',
            ],
            [
                'name' => 'create_news_category',
                'guard_name' => 'admin',
                'table_name' => 'tbl_news_categories',
            ],
            [
                'name' => 'read_news_category',
                'guard_name' => 'admin',
                'table_name' => 'tbl_news_categories',
            ],
            [
                'name' => 'update_news_category',
                'guard_name' => 'admin',
                'table_name' => 'tbl_news_categories',
            ],
            [
                'name' => 'delete_news_category',
                'guard_name' => 'admin',
                'table_name' => 'tbl_news_categories',
            ],
            [
                'name' => 'browse_delivery',
                'guard_name' => 'admin',
                'table_name' => 'tbl_deliveries',
            ],
            [
                'name' => 'create_delivery',
                'guard_name' => 'admin',
                'table_name' => 'tbl_deliveries',
            ],
            [
                'name' => 'read_delivery',
                'guard_name' => 'admin',
                'table_name' => 'tbl_deliveries',
            ],
            [
                'name' => 'update_delivery',
                'guard_name' => 'admin',
                'table_name' => 'tbl_deliveries',
            ],
            [
                'name' => 'delete_delivery',
                'guard_name' => 'admin',
                'table_name' => 'tbl_deliveries',
            ],
            [
                'name' => 'browse_customer',
                'guard_name' => 'admin',
                'table_name' => 'tbl_customers',
            ],
            [
                'name' => 'create_customer',
                'guard_name' => 'admin',
                'table_name' => 'tbl_customers',
            ],
            [
                'name' => 'read_customer',
                'guard_name' => 'admin',
                'table_name' => 'tbl_customers',
            ],
            [
                'name' => 'update_customer',
                'guard_name' => 'admin',
                'table_name' => 'tbl_customers',
            ],
            [
                'name' => 'delete_customer',
                'guard_name' => 'admin',
                'table_name' => 'tbl_customers',
            ],
            [
                'name' => 'browse_affiliate',
                'guard_name' => 'admin',
                'table_name' => 'tbl_affiliates',
            ],
            [
                'name' => 'create_affiliate',
                'guard_name' => 'admin',
                'table_name' => 'tbl_affiliates',
            ],
            [
                'name' => 'read_affiliate',
                'guard_name' => 'admin',
                'table_name' => 'tbl_affiliates',
            ],
            [
                'name' => 'update_affiliate',
                'guard_name' => 'admin',
                'table_name' => 'tbl_affiliates',
            ],
            [
                'name' => 'delete_affiliate',
                'guard_name' => 'admin',
                'table_name' => 'tbl_affiliates',
            ],
            [
                'name' => 'browse_coupon',
                'guard_name' => 'admin',
                'table_name' => 'tbl_coupons',
            ],
            [
                'name' => 'create_coupon',
                'guard_name' => 'admin',
                'table_name' => 'tbl_coupons',
            ],
            [
                'name' => 'read_coupon',
                'guard_name' => 'admin',
                'table_name' => 'tbl_coupons',
            ],
            [
                'name' => 'update_coupon',
                'guard_name' => 'admin',
                'table_name' => 'tbl_coupons',
            ],
            [
                'name' => 'delete_coupon',
                'guard_name' => 'admin',
                'table_name' => 'tbl_coupons',
            ],
            [
                'name' => 'browse_advertisement',
                'guard_name' => 'admin',
                'table_name' => 'tbl_advertisements',
            ],
            [
                'name' => 'create_advertisement',
                'guard_name' => 'admin',
                'table_name' => 'tbl_advertisements',
            ],
            [
                'name' => 'read_advertisement',
                'guard_name' => 'admin',
                'table_name' => 'tbl_advertisements',
            ],
            [
                'name' => 'update_advertisement',
                'guard_name' => 'admin',
                'table_name' => 'tbl_advertisements',
            ],
            [
                'name' => 'delete_advertisement',
                'guard_name' => 'admin',
                'table_name' => 'tbl_advertisements',
            ],
            [
                'name' => 'browse_delivery_setting',
                'guard_name' => 'admin',
                'table_name' => 'tbl_delivery_settings',
            ],
            [
                'name' => 'create_delivery_setting',
                'guard_name' => 'admin',
                'table_name' => 'tbl_delivery_settings',
            ],
            [
                'name' => 'read_delivery_setting',
                'guard_name' => 'admin',
                'table_name' => 'tbl_delivery_settings',
            ],
            [
                'name' => 'update_delivery_setting',
                'guard_name' => 'admin',
                'table_name' => 'tbl_delivery_settings',
            ],
            [
                'name' => 'delete_delivery_setting',
                'guard_name' => 'admin',
                'table_name' => 'tbl_delivery_settings',
            ],
            [
                'name' => 'browse_brand',
                'guard_name' => 'admin',
                'table_name' => 'tbl_brands',
            ],
            [
                'name' => 'create_brand',
                'guard_name' => 'admin',
                'table_name' => 'tbl_brands',
            ],
            [
                'name' => 'read_brand',
                'guard_name' => 'admin',
                'table_name' => 'tbl_brands',
            ],
            [
                'name' => 'update_brand',
                'guard_name' => 'admin',
                'table_name' => 'tbl_brands',
            ],
            [
                'name' => 'delete_brand',
                'guard_name' => 'admin',
                'table_name' => 'tbl_brands',
            ],

            [
                'name' => 'browse_push_notification',
                'guard_name' => 'admin',
                'table_name' => 'tbl_push_notifications',
            ],
            [
                'name' => 'create_push_notification',
                'guard_name' => 'admin',
                'table_name' => 'tbl_push_notifications',
            ],
            [
                'name' => 'read_push_notification',
                'guard_name' => 'admin',
                'table_name' => 'tbl_push_notifications',
            ],
            [
                'name' => 'update_push_notification',
                'guard_name' => 'admin',
                'table_name' => 'tbl_push_notifications',
            ],
            [
                'name' => 'delete_push_notification',
                'guard_name' => 'admin',
                'table_name' => 'tbl_push_notifications',
            ],

            [
                'name' => 'browse_sales_return',
                'guard_name' => 'admin',
                'table_name' => 'tbl_sales_returns',
            ],
            [
                'name' => 'create_sales_return',
                'guard_name' => 'admin',
                'table_name' => 'tbl_sales_returns',
            ],
            [
                'name' => 'read_sales_return',
                'guard_name' => 'admin',
                'table_name' => 'tbl_sales_returns',
            ],
            [
                'name' => 'update_sales_return',
                'guard_name' => 'admin',
                'table_name' => 'tbl_sales_returns',
            ],
            [
                'name' => 'delete_sales_return',
                'guard_name' => 'admin',
                'table_name' => 'tbl_sales_returns',
            ],
            [
                'name' => 'browse_statement',
                'guard_name' => 'admin',
                'table_name' => 'tbl_statements',
            ],
            [
                'name' => 'create_statement',
                'guard_name' => 'admin',
                'table_name' => 'tbl_statements',
            ],
            [
                'name' => 'read_statement',
                'guard_name' => 'admin',
                'table_name' => 'tbl_statements',
            ],
            [
                'name' => 'update_statement',
                'guard_name' => 'admin',
                'table_name' => 'tbl_statements',
            ],
            [
                'name' => 'delete_statement',
                'guard_name' => 'admin',
                'table_name' => 'tbl_statements',
            ],
            [
                'name' => 'browse_affiliate_statement',
                'guard_name' => 'admin',
                'table_name' => 'tbl_affiliate_statements',
            ],
            [
                'name' => 'create_affiliate_statement',
                'guard_name' => 'admin',
                'table_name' => 'tbl_affiliate_statements',
            ],
            [
                'name' => 'read_affiliate_statement',
                'guard_name' => 'admin',
                'table_name' => 'tbl_affiliate_statements',
            ],
            [
                'name' => 'update_affiliate_statement',
                'guard_name' => 'admin',
                'table_name' => 'tbl_affiliate_statements',
            ],
            [
                'name' => 'delete_affiliate_statement',
                'guard_name' => 'admin',
                'table_name' => 'tbl_affiliate_statements',
            ],

            //Flash Sale

            [
                'name' => 'browse_flash_sale',
                'guard_name' => 'admin',
                'table_name' => 'tbl_flash_sales',
            ],
            [
                'name' => 'create_flash_sale',
                'guard_name' => 'admin',
                'table_name' => 'tbl_flash_sales',
            ],
            [
                'name' => 'read_flash_sale',
                'guard_name' => 'admin',
                'table_name' => 'tbl_flash_sales',
            ],
            [
                'name' => 'update_flash_sale',
                'guard_name' => 'admin',
                'table_name' => 'tbl_flash_sales',
            ],
            [
                'name' => 'delete_flash_sale',
                'guard_name' => 'admin',
                'table_name' => 'tbl_flash_sales',
            ],




        ];
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('permissions')->truncate();
        DB::table('permissions')->insert($this->permissionTable());
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
