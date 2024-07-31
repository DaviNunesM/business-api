<?php

namespace App\Repositories;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class CompanyRepository
{
    private $httpClient;
    public function __construct()
    {
        $this->httpClient = Http::baseUrl(config('services.brasil-api.url'));
    }

    public function get(string $cnpj): Response
    {
        return $this->httpClient->get("/cnpj/v1/{$cnpj}");
    }   
}