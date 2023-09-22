<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Beneficiary;
use App\Models\MedicalRecord;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BeneficiaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $validatedData = $request->validate([
            'beneficiary_name' => 'required|string',
            'relationship' => 'required|string',
            'email' => 'required|string|email|unique:beneficiaries',
            'password' => 'required|string|min:6',
        ]);
    
        // Crear un nuevo Beneficiary con los datos validados
        $beneficiary = Beneficiary::create($validatedData);
    
        // Verificar si la creación fue exitosa
        if ($beneficiary) {
            return response()->json([
                'Status' => 'Success',
                'Message' => 'Beneficiary creado satisfactoriamente',
                'data' => $beneficiary,
            ], Response::HTTP_CREATED);
        } else {
            return response()->json([
                'Status' => 'Error',
                'Message' => 'No se pudo crear el Beneficiary',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MedicalRecord  $medicalRecord
     * @return \Illuminate\Http\Response
     */
    public function show(MedicalRecord $medicalRecord)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MedicalRecord  $medicalRecord
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MedicalRecord $medicalRecord)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MedicalRecord  $medicalRecord
     * @return \Illuminate\Http\Response
     */
    public function destroy(MedicalRecord $medicalRecord)
    {
        //
    }
}
