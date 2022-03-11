<?php

namespace Database\Seeders;
use App\Models\employee_education;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class EducationSeeder extends Seeder
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
                employee_education::create([
                    'employee_id' => $i,
                    'exam' => Str::random(10),
                    'passing_year' => 2020,
                    'result' => '3.'.mt_rand(10,99),
                    'institution' => Str::random(15),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            }
        }
    }
}
