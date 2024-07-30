<?php

namespace App\Repositories;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class CompanyRepository
{
    public function __construct()
    {
        //
    }

    public function get(string $cnpj): Response
    {
        return Http::get("https://brasilapi.com.br/api/cnpj/v1/{$cnpj}");
    }   
}