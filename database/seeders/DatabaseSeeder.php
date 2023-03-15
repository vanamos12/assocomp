<?php

namespace Database\Seeders;

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
        // \App\Models\User::factory(10)->create();
        $this->call(UserTableSeeder::class);
        $this->call(BankTableSeeder::class);
        $this->call(MeetingTableSeeder::class);
        $this->call(LoanTableSeeder::class);
        $this->call(RubriqueTableSeeder::class);
    }
}
