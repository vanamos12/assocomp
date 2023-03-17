<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Company::factory()->create([
            'name' => 'Mekowa',
            'uniquename' => 'mekowa',
            'rc' => '12458796369'
        ]);
    }
}
