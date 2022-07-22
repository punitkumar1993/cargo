<?php

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
        $this->call(RolesTableSeeder::class);
        $this->call(SettingSeeder::class);
        $this->call(SocialmediaSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(TermSeeder::class);
        $this->call(PostSeeder::class);
        $this->call(AdspaceSeeder::class);
        $this->call(AdvertisementSeeder::class);
        $this->call(MenuSeeder::class);
        $this->call(MenuItemSeeder::class);
    }
}
