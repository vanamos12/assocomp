<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Meeting;
use Illuminate\Database\Seeder;

class MeetingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Meeting::factory()->create([
            'name' => 'Reunion Janvier 2023',
            'creation' => Carbon::now(),
            'company_id' => 1
        ]);
    }
}
