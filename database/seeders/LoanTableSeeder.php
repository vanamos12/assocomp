<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Loan;
use Illuminate\Database\Seeder;

class LoanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Loan::factory()->create([
            'user_id' => 5,
            'amount' => 100000,
            'creation' => Carbon::now(),
            'meeting_id' => 1,
        ]);

        Loan::factory()->create([
            'user_id' => 6,
            'amount' => 100000,
            'creation' => Carbon::now(),
            'meeting_id' => 1,
        ]);
    }
}
