<?php

use Illuminate\Database\Seeder;

class SocialmediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
     {
         App\Models\Socialmedia::create([
             'name' => 'Facebook',
             'slug' => 'facebook',
             'url' => 'https://www.facebook.com',
             'icon' => 'fab fa-facebook'
         ]);
         App\Models\Socialmedia::create([
             'name' => 'Twitter',
             'slug' => 'twitter',
             'url' => 'https://www.twitter.com',
             'icon' => 'fab fa-twitter'
         ]);
         App\Models\Socialmedia::create([
             'name' => 'YouTube',
             'slug' => 'youtube',
             'url' => 'https://www.youtube.com',
             'icon' => 'fab fa-youtube'
         ]);
         App\Models\Socialmedia::create([
             'name' => 'Instagram',
             'slug' => 'instagram',
             'url' => 'https://www.instagram.com',
             'icon' => 'fab fa-instagram'
         ]);
         App\Models\Socialmedia::create([
             'name' => 'LinkedIn',
             'slug' => 'linkedin',
             'url' => 'https://www.linkedin.com',
             'icon' => 'fab fa-linkedin'
         ]);
     }
}
