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
            'name' => 'Voir bebe Hermann',
            'debut' => Carbon::now(),
            'fin' => Carbon::now()->addYear(),
        ]);

        Rubrique::factory()->create([
            'name' => 'Inscription 2023',
            'debut' => Carbon::now(),
            'fin' => Carbon::now()->addYear(),
        ]);
    }
}
