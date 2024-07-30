<?php

namespace App\Http\Controllers;

use App\Services\CompanyService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CompanyController extends Controller
{

    public function __construct(private CompanyService $service)
    {
    }
        
    public function show(Request $request, string $cnpj): JsonResponse {
        try {
            $data = $this->service->getCompany($cnpj);
        } catch (NotFoundHttpException $e) {
            return response()->json(['error' => 'CNPJ não encontrado'], 404);
        } catch (\InvalidArgumentException $e) {
            return response()->json(['error' => 'CNPJ inválido'], 400);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro interno'], 500);
        } 

        return response()->json(['data' => $data]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
