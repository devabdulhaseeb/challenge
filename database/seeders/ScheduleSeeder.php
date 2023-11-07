<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;
use DB;
class ScheduleSeeder extends Seeder
{
    public function run()
    {
        $faker = FakerFactory::create();

        for ($i = 1; $i <= 10; $i++) { 
            DB::table('schedule')->insert([
                'employee_id' => $i,
                'shift_id' => $i,
                'location_id' => $i,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

