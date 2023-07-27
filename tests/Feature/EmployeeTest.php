<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\Response;
use App\Models\Employee;
use App\Models\Company;

class EmployeeTest extends TestCase
{
    public function test_employee_data_returns_in_valid_format()
    {
        $this->json('get', 'api/v1/employees')
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    'data' => [
                        '*' => [
                            'id',
                            'company_id',
                            'first_name',
                            'last_name',
                            'email',
                            'phone_number',
                        ],
                    ],
                ]
            );
    }

    public function test_employee_is_created_successfully()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('api/v1/employees', [
            'company_id' => Company::first()->id,
            'first_name' => 'Andrzej',
            'last_name' => 'Nowak',
            'email' => 'a.nowak512@gmail.com',
            'phone_number' => '213 536 612'
        ]);
        $response->assertStatus(201);

    }

    public function test_employee_is_deleted_successfully()
    {
        $payload = Employee::factory()->create()->toArray();
        $response = $this->delete('api/v1/employees/'. $payload['id'], []);
        $response->assertStatus(200);
    }
}
