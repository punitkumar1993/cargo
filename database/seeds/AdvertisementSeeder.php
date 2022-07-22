<?php

use Illuminate\Database\Seeder;
use App\Models\Advertisement;
use Carbon\carbon;

class AdvertisementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Advertisement::create([
            'space_id' => 1,
            'label' => 'Home',
            'image' => 'noimage.png',
            'size' => '750x80',
            'active' => 'y',
            "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
            "updated_at" => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        Advertisement::create([
            'space_id' => 2,
            'label' => 'Sidebar',
            'image' => 'noimage.png',
            'size' => '350x300',
            'active' => 'y',
            "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
            "updated_at" => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        Advertisement::create([
            'space_id' => 3,
            'label' => 'Sidebar',
            'image' => 'noimage.png',
            'size' => '350x300',
            'active' => 'y',
            "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
            "updated_at" => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        Advertisement::create([
            'space_id' => 4,
            'label' => 'Sponsored',
            'image' => 'noimage.png',
            'size' => '350x300',
            'active' => 'y',
            "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
            "updated_at" => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
