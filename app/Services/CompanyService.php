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

        $data = collect($response->json())->recursive();

        $partners = $data->get('qsa')->map(function ($val) {
            return [
                'name' => $val->get('nome_socio'),
                'cpf' => $val->get('cnpj_cpf_do_socio'),
            ];
        })->all();
    
        $secundary_activities = $data->get('cnaes_secundarios')->map(function ($val) {
            return [
                'code' => $val->get('codigo'),
                'description' => $val->get('descricao'),
            ];
        })->all();
    
        return [
            'name' => $data->get('razao_social'),
            'main_activity' => $data->get('cnae_fiscal'),
            'main_activity_description' => $data->get('cnae_fiscal_descricao'),
            'activity_start_date' => $data->get('data_inicio_atividade'),
            'registration_status_date' => $data->get('data_situacao_cadastral'),
            'address' => [
                'street_name' => $data->get('logradouro'),
                'number' => $data->get('numero'),
                'complement' => $data->get('complemento'),
                'postal_code' => $data->get('cep'),
                'neighborhood' => $data->get('bairro'),
                'city' => $data->get('municipio'),
                'state' => $data->get('uf'),
            ],
            'phone_number' => $data->get('ddd_telefone_1'),
            'share_capital' => $data->get('capital_social'),
            'partners' => $partners,
            'secundary_activities' => $secundary_activities,
        ];
    }
}