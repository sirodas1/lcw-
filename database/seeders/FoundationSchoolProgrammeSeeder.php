<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FoundationSchoolProgrammeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date_and_time = [
            'duration' => 'forever',
            'day' => 'Sundays',
            'time' => '2pm',
        ];
        DB::table('programmes')->insert([
            'name' => 'Foundation School',
            'recuring' => true,
            'date_and_time' => json_encode($date_and_time),
        ]);
    }
}
