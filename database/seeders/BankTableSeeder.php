<?php

namespace Database\Seeders;

use App\Models\Bank;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BankTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Bank::factory()->create([
            'company_id' => 1,
            'name' => 'bank',
            'creation' => Carbon::now(),
            'balance' => 0,
        ]);
    }
}
