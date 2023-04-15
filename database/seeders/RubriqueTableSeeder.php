<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Rubrique;
use Illuminate\Database\Seeder;

class RubriqueTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Rubrique::factory()->create([
            'company_id' => 1,
            'name' => 'Cotisation',
            'debut' => Carbon::now(),
            'fin' => Carbon::now()->addYear(),
        ]);

        Rubrique::factory()->create([
            'company_id' => 1,
            'name' => 'Epargne',
            'debut' => Carbon::now(),
            'fin' => Carbon::now()->addYear(),
        ]);

        Rubrique::factory()->create([
            'company_id' => 1,
            'name' => 'Fonds de roulement',
            'debut' => Carbon::now(),
            'fin' => Carbon::now()->addYear(),
        ]);
    }
}
