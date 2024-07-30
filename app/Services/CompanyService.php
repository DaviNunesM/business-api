<?php

namespace App\Services;

use App\Repositories\CompanyRepository;
use Illuminate\Support\Facades\Validator;
use \Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CompanyService
{

    public function __construct(private CompanyRepository $repository)
    {
    }

    public function getCompany(string $cnpj): array
    {
        $validator = Validator::make(['cnpj' => $cnpj], [
            'cnpj' => ['required', 'cnpj'],
        ]);
        if ($validator->fails()) {
            throw new \InvalidArgumentException('CNPJ Informado é inválido');
        }

        $response = $this->repository->get($cnpj);
        if ($response->failed()) {
            throw new NotFoundHttpException('CNPJ não encontrado');
        }

        return $response->json();
    }
}