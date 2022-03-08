<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 100; $i++) { 
            DB::table('employees')->insert([
                'roll' => Str::random(10),
                'name' => Str::random(10),
                'phone' => Str::random(10),
                'email' => Str::random(10).'@gmail.com',
                'designation' => Str::random(10),
                'department' => Str::random(10)
            ]);
        }
    }
}
