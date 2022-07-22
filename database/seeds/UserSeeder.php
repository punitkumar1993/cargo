<?php

use Illuminate\Database\Seeder;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superadmin = User::create([
            'name' => 'Mark Otto',
            'username'=>'superadmin',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('superadmin123'),
            'occupation' => 'SuperAdmin',
            'photo' => 'mark-otto.jpg'
        ])->assignRole('superadmin');

        $admin = User::create([
            'name' => 'John Doe',
            'username'=>'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
            'occupation' => 'Writter and Admin',
            'photo' => 'john-doe.jpg',
            'about' => 'someone who likes to write and teach'
        ])->assignRole('admin');

        $admin->socialmedia()->attach([
            1 => ['url' => 'https://www.facebook.com/johndoe'],
            2 => ['url' => 'https://www.twitter.com/johndoe'],
            3 => ['url' => 'https://www.youtube.com/c/johndoe'],
            4 => ['url' => 'https://www.instagram.com/johndoe'],
        ]);
        
        $user = User::create([
            'name' => 'Jacob Thornton',
            'username' => 'member',
            'email' => 'user@example.com',
            'password' => Hash::make('member123'),
            'occupation' => 'User',
            'photo' => 'jacob-thornton.jpg'
        ])->assignRole('member');
    }
}
