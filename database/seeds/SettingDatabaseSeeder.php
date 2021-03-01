<?php

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     Setting::setMany([
        'default_locale'=>'ar',
        'default_timezone'=>'Asia/kuwait',
        'reviews_enabled'=> true,
        'auto_approve_reviews'=> true,
        'supported_currencies'=>['USD','KD','LE'],
        'default_currency'=>'KD',
        'store_email'=>'admin@ecommerce.com',
        'search_engine'=>'mysql',
        'local_shipping_cost'=>0,
        'outer_shipping_cost'=>0,
        'free_shipping_cost'=>0,
         'translatable'=>[
             'store_name'=>'متجر آي تي سي',
             'local_shipping_label'=>'توصيل داخلي',
             'outer_shipping_label'=>'توصيل خارجي',
             'free_shipping_label'=>'توصيل مجاني',
         ],


     ]);
    }
}
