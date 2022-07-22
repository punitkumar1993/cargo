<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Carbon\carbon;

class MenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menu_items')->insertOrIgnore([
            [
                'id' => '1',
                'label' => 'Home',
                'link' => '/',
                'parent' => 0,
                'sort' => 0,
                'menu' => 1,
                'depth' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => '2',
                'label' => 'News',
                'link' => '/category/news',
                'parent' => 0,
                'sort' => 0,
                'menu' => 1,
                'depth' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => '3',
                'label' => 'Tech',
                'link' => '/category/technology',
                'parent' => 0,
                'sort' => 0,
                'menu' => 1,
                'depth' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => '4',
                'label' => 'About',
                'link' => '/page/about',
                'parent' => 0,
                'sort' => 0,
                'menu' => 1,
                'depth' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => '5',
                'label' => 'Contact',
                'link' => '/contact',
                'parent' => 0,
                'sort' => 0,
                'menu' => 1,
                'depth' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => '6',
                'label' => 'Home',
                'link' => '/',
                'parent' => 0,
                'sort' => 0,
                'menu' => 2,
                'depth' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => '7',
                'label' => 'Contact',
                'link' => '/contact',
                'parent' => 0,
                'sort' => 0,
                'menu' => 2,
                'depth' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => '8',
                'label' => 'About',
                'link' => '/page/about',
                'parent' => 0,
                'sort' => 0,
                'menu' => 2,
                'depth' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ]);
    }
}
