<?php

namespace Tests\Feature;

use App\Models\Bogsoft\Company;
use App\Models\Bogsoft\Department;
use App\Models\Bogsoft\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class DepartmentTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_store_department()
    {
        $employee = Employee::first();
        $company = Company::first();

        $response = $this->actingAs($employee)->post('/api/departments', [
            'name' => 'New Department',
            'company_id' => $company->id
        ]);

        $response->assertStatus(200);
        $this->assertEquals('New Department', $response['name']);
    }

    public function test_assign_employee_to_department()
    {
        $employees = Employee::take(5)->pluck('id');

        $department = Department::latest()->first();

        $department->employees()->attach($employees);

        $totalEmployees = $department->employees->count();
        $this->assertGreaterThan(4, $totalEmployees);
    }

    public function test_department_delete()
    {
        $department = Department::latest()->first();
        $department->delete();
        $this->assertDeleted($department);
    }
}
