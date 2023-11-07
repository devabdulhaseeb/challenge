<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;
use DB;

class ShiftsSeeder extends Seeder
{
    public function run()
    {
        $faker = FakerFactory::create();
        $startHour = 9; // Starting hour

        for ($i = 0; $i < 10; $i++) {
            $slot = $startHour . '-' . ($startHour + 6); // Create the slot format (e.g., "9-6", "10-7", etc.)
            
            DB::table('shifts')->insert([
                'slot' => $slot,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $startHour++; // Increment the starting hour for the next record
        }
    }
}


