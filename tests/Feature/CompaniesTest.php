<?php

namespace Tests\Feature;

use App\Models\Company;
use Illuminate\Http\Response;
use Tests\TestCase;

class CompaniesTest extends TestCase
{

    public function test_company_data_returns_in_valid_format()
    {
        $this->json('get', 'api/v1/companies')
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    'data' => [
                        '*' => [
                            'id',
                            'name',
                            'nip',
                            'address',
                            'city',
                            'zipcode',
                        ],
                    ],
                ]
            );
    }

    public function testCompanyIsCreatedSuccessfully()
    {
        $response = $this->post('api/v1/companies', [
            'name' => 'Firma testowa',
            'nip' => '1234567890',
            'address' => 'ul. Poznańska 12',
            'city' => 'Warszawa',
            'zipcode' => '25-125'
        ]);
        $response->assertStatus(201);

    }

    public function testCompanyIsDeletedSuccessfully()
    {
        $payload = Company::factory()->create()->toArray();
        $response = $this->delete('api/v1/companies/'. $payload['id'], []);
        $response->assertStatus(200);
    }

}
