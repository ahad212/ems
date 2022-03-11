<?php

namespace Database\Seeders;
use App\Models\employee_experience;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i < 101; $i++) { 
            for ($j=0; $j < 5; $j++) { 
                employee_experience::create([
                    'employee_id' => $i,
                    'organization' => Str::random(15),
                    'from_date' => 2020,
                    'to_date' => 2022,
                    'designation' => 'Web Developer',
                    'duties' => 'Web Development',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            }
        }
    }
}
