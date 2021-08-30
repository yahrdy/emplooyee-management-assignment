<?php

namespace Tests\Feature;

use App\Models\Bogsoft\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmployeeTest extends TestCase
{
    public function test_employee_can_register()
    {
        $response = $this->post('/api/register', [
            'first_name' => 'Yeasir',
            'last_name' => 'Arafat',
            'email' => 'yeasirarafat123@example.com',
            'password' => 'password',
            'age' => 25,
        ]);
        $response->assertStatus(200);
    }

    public function test_employee_can_login()
    {
        $response = $this->post('/api/login', [
            'email' => 'yeasirarafat123@example.com',
            'password' => 'password',
        ]);

        $response->assertStatus(200);
    }

    public function test_employee_can_update()
    {
        $employee = Employee::latest()->first();
        $response = $this->actingAs($employee)->put('/api/employees/' . $employee->id, [
            'first_name' => 'Sumaiya',
            'last_name' => 'Sumu',
        ]);
        $this->assertEquals('Sumaiya', $response['first_name']);
        $this->assertEquals('Sumu', $response['last_name']);
    }

    public function test_employee_can_delete()
    {
        $employee = Employee::latest()->first();
        $employee->delete();
        $this->assertDeleted($employee);
    }
}
