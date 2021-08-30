<?php

namespace Tests\Feature;

use App\Models\Bogsoft\Company;
use App\Models\Bogsoft\Employee;
use http\Client\Curl\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_store_company()
    {
        $employee = Employee::first();
        $response = $this->actingAs($employee)->post('/api/companies', [
            'name' => 'Company Name'
        ]);

        $response->assertStatus(200);
    }

    public function test_company_update()
    {
        $employee = Employee::first();
        $company = Company::latest()->first();
        $response = $this->actingAs($employee)->put('/api/companies/' . $company->id, [
            'name' => 'Updated Company'
        ]);

        $this->assertEquals('Updated Company', $response['name']);
    }

    public function test_delete_company()
    {
        $company = Company::latest()->first();
        $company->delete();
        $this->assertDeleted($company);
    }
}
