<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_get_company(): void
    {
        // Valid CNPJ
        $response = $this->get('/api/company/06947283000160');

        $response->assertStatus(200);

        $data = $response->json('data');
        $this->assertEquals($data['name'], 'GOOGLE INTERNATIONAL LLC');
    }

    public function test_get_company_not_found(): void
    {
        // Valid but inexistent CNPJ
        $response = $this->get('/api/company/66250000000158');

        $response->assertStatus(404);
    }

    public function test_get_company_invalid_cnpj(): void
    {
        // Invalid CNPJ
        $response = $this->get('/api/company/12345678901234');

        $response->assertStatus(400);
    }
}
