<?php

use Illuminate\Database\Seeder;
use App\Models\Adspace;
use Carbon\carbon;

class AdspaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Adspace::create([
            'name' => 'home-horizontal',
            'slug' => 'home-horizontal',
            "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
            "updated_at" => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        Adspace::create([
            'name' => 'sidebar-right-top',
            'slug' => 'sidebar-right-top',
            "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
            "updated_at" => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        Adspace::create([
            'name' => 'sidebar-left-top',
            'slug' => 'sidebar-left-top',
            "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
            "updated_at" => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        Adspace::create([
            'name' => 'sidebar-right-bottom',
            'slug' => 'sidebar-right-bottom',
            "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
            "updated_at" => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
