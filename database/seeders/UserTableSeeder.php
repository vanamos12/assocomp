<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //
        User::factory()->create([
            'name' => 'Admin',
            'username' => 'admin',
            'slug' => 'admin',
            'fonction' => 0,
            'email' => 'admin@example.com',
            'canconnect' => true,
            'password' => bcrypt('password'),
            'type' => User::ADMIN,
        ]);

        User::factory()->create([
            'name' => 'John Doe',
            'username' => 'johndoe',
            'slug' => 'john-doe',
            'fonction' => 6,
            'email' => 'john@example.com',
            'canconnect' => true,
            'password' => bcrypt('password'),
            'type' => User::DEFAULT,
        ]);

        User::factory()->create([
            'name' => 'Mekowa',
            'username' => 'mekowa',
            'slug' => 'mekowa',
            'fonction' => 6,
            'email' => 'mekowa@mekowa.com',
            'canconnect' => true,
            'password' => bcrypt('mekowa'),
            'type' => User::DEFAULT,
        ]);

        User::factory()->create([
            'name' => 'Naya Doe',
            'username' => 'mayadoe',
            'slug' => 'maya-doe',
            'fonction' => 6,
            'email' => 'maya@example.com',
            'canconnect' => true,
            'password' => bcrypt('password'),
            'type' => User::DEFAULT,
        ]);

        //User::factory()->count(10)->create();
    }
}
