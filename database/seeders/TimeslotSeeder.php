<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TimeslotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=7; $i <= 22; $i++) {
            DB::table('timeslots')->insert([
               'slot' => $i.':00'

           ]);
       }
    }
}
