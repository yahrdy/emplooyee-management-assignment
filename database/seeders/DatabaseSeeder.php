<?php

namespace Database\Seeders;

use App\Models\Bogsoft\Company;
use App\Models\Bogsoft\Department;
use App\Models\Bogsoft\Employee;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Employee::factory(50)->create();

        Company::factory(10)->has(
            Department::factory(mt_rand(3, 6))
        )->create();

        Department::all()->each(function ($department) {
            $employees = Employee::inRandomOrder()->take(mt_rand(5, 15))->pluck('id');
            $department->employees()->attach($employees);
        });
    }
}
