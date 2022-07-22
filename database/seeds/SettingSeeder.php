<?php

use Illuminate\Database\Seeder;

use App\Models\Setting;
use Carbon\Carbon;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Setting::insert([
          ['group' => 'site_information', 'name' => 'company_name', 'value' => 'Laramagz', 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
          ['group'=>'site_information', 'name'=>'sitename', 'value'=>'Laramagz', 'created_at'=> Carbon::now()->format('Y-m-d H:i:s'), 'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')],
          ['group' => 'site_information', 'name' => 'siteurl', 'value' => 'http://localhost:8000', 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
          ['group'=>'site_information', 'name'=>'siteemail', 'value'=>'admin@example.com', 'created_at'=> Carbon::now()->format('Y-m-d H:i:s'), 'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')],
          ['group'=>'site_information', 'name'=>'sitephone', 'value'=>'0721', 'created_at'=> Carbon::now()->format('Y-m-d H:i:s'), 'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')],
          ['group'=>'site_information', 'name'=>'street', 'value'=>'Jl. Alimudin Umar', 'created_at'=> Carbon::now()->format('Y-m-d H:i:s'), 'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')],
          ['group' => 'site_information', 'name' => 'city', 'value' => 'Bandar Lampung', 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
          ['group' => 'site_information', 'name' => 'postal_code', 'value' => '35122', 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
          ['group' => 'site_information', 'name' => 'state', 'value' => 'Lampung', 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
          ['group' => 'site_information', 'name' => 'country', 'value' => 'Indonesia', 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
          ['group' => 'site_information', 'name' => 'fulladdress', 'value' => 'Jl. Alimudin Umar, 35122, Bandar Lampung, Lampung, Indonesia ', 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
          ['group'=>'site_information', 'name'=>'sitedescription', 'value'=> 'Content management system based on Laravel', 'created_at'=> Carbon::now()->format('Y-m-d H:i:s'), 'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')],
          ['group' => 'site_information', 'name' => 'contactdescription', 'value' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Excepturi, nesciunt?', 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
          ['group'=>'site_information', 'name'=>'metakeyword', 'value'=>'', 'created_at'=> Carbon::now()->format('Y-m-d H:i:s'), 'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')],
          ['group'=>'site_config', 'name'=>'maintenance', 'value'=>'n', 'created_at'=> Carbon::now()->format('Y-m-d H:i:s'), 'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')],
          ['group'=>'site_config', 'name'=>'current_theme', 'value'=>'Laramagz', 'created_at'=> Carbon::now()->format('Y-m-d H:i:s'), 'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')],
          ['group'=>'site_config', 'name'=>'current_theme_dir', 'value'=>'magz', 'created_at'=> Carbon::now()->format('Y-m-d H:i:s'), 'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')],
          ['group'=>'site_config', 'name'=>'register', 'value'=>'n', 'created_at'=> Carbon::now()->format('Y-m-d H:i:s'), 'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')],
          ['group'=>'logo_image', 'name'=>'favicon', 'value'=>'', 'created_at'=> Carbon::now()->format('Y-m-d H:i:s'), 'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')],
          ['group'=>'logo_image', 'name'=>'logowebsite', 'value'=>'', 'created_at'=> Carbon::now()->format('Y-m-d H:i:s'), 'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')],
          ['group'=>'logo_image', 'name'=>'logowebsite_footer', 'value'=>'', 'created_at'=> Carbon::now()->format('Y-m-d H:i:s'), 'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')],
          ['group' => 'logo_image', 'name' => 'ogimage', 'value' => '', 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
          ['group'=>'social_media', 'name'=>'facebook', 'value'=>'', 'created_at'=> Carbon::now()->format('Y-m-d H:i:s'), 'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')],
          ['group'=>'social_media', 'name'=>'twitter', 'value'=>'', 'created_at'=> Carbon::now()->format('Y-m-d H:i:s'), 'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')],
          ['group'=>'social_media', 'name'=>'youtube', 'value'=>'', 'created_at'=> Carbon::now()->format('Y-m-d H:i:s'), 'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')],
          ['group'=>'social_media', 'name'=>'instagram', 'value'=>'retenvi_', 'created_at'=> Carbon::now()->format('Y-m-d H:i:s'), 'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')],
          ['group'=>'social_media', 'name'=>'linkedin', 'value'=>'retenvi', 'created_at'=> Carbon::now()->format('Y-m-d H:i:s'), 'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')],
          ['group'=>'social_media', 'name'=>'whatsapp', 'value'=>'6212345678900', 'created_at'=> Carbon::now()->format('Y-m-d H:i:s'), 'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')],
          ['group'=>'social_media', 'name'=>'telegram', 'value'=>'6212345678900', 'created_at'=> Carbon::now()->format('Y-m-d H:i:s'), 'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')],
          ['group'=>'google', 'name'=>'googleanalyticsid', 'value'=>'', 'created_at'=> Carbon::now()->format('Y-m-d H:i:s'), 'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')],
          ['group'=>'google', 'name'=>'googlemapcode', 'value'=> 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3972.07212464098!2d105.2985505143532!3d-5.40598465551376!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e40db829b6498f7%3A0x2846d50abe54ac6e!2sSigerweb!5e0!3m2!1sid!2sid!4v1582281377731!5m2!1sid!2sid', 'created_at'=> Carbon::now()->format('Y-m-d H:i:s'), 'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')],
          ['group' => 'google', 'name' => 'publisherid', 'value' => '', 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
          ['group' => 'google', 'name' => 'googlesiteverification', 'value' => '', 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
          ['group' => 'google', 'name' => 'disqusshortname', 'value' => 'retenvi', 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
          ['group' => 'google', 'name' => 'mailchimp', 'value' => '', 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
          ['group' => 'permalinks', 'name' => 'permalink_type', 'value' => 'custom', 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
          ['group' => 'permalinks', 'name' => 'permalink', 'value' => 'news', 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
          ['group' => 'permalinks', 'name' => 'permalink_old_custom', 'value' => 'news', 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
          ['group' => 'newsletters', 'name' => 'newsletter_status', 'value' => 'true', 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')]
      ]);
    }
}
