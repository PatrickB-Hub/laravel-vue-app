<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Company;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EmployeesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Employee::truncate();

        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 200; $i++) {
            Employee::create([
                'company_id' => Company::pluck('id')->random(),
                'first_name' => $faker->firstName(),
                'last_name' => $faker->lastName(),
                'email' => $faker->email(),
            ]);
        }
    }
}
