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
     * Funcion para crear beneficiario asociado al titular
     * con sus expedientes clinicos independientes
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $request->user(); // Obtener el usuario autenticado
        $userId = $user->id; // Obtener el ID del usuario

        // Validar si el usuario ya tiene tres o más beneficiarios asociados
        $beneficiariesCount = Beneficiary::where('primary_user_id', $userId)->count();
        if ($beneficiariesCount >= 3) {
            return response()->json([
                'Status' => 'Error',
                'Message' => 'No se puede agregar más beneficiarios. Límite alcanzado.',
            ], Response::HTTP_BAD_REQUEST);
        }

        // Validar los datos de entrada
        $validatedData = $request->validate([
            'beneficiary_name' => 'required|string',
            'relationship' => 'required|string',
            'email' => 'required|string|email|unique:beneficiaries',
            'password' => 'required|string|min:6',
        ]);

        $validatedData['primary_user_id'] = $userId;

        // Crear un nuevo Beneficiary con los datos validados
        $beneficiary = Beneficiary::create($validatedData);

        // Verificar si la creación fue exitosa
        if ($beneficiary) {
            return response()->json([
                'Status' => 'Success',
                'Message' => 'Beneficiario creado satisfactoriamente',
                'data' => $beneficiary,
            ], Response::HTTP_CREATED);
        } else {
            return response()->json([
                'Status' => 'Error',
                'Message' => 'No se pudo crear el Beneficiario',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    /**
     * Funcion para visualizar beneficiarios por usuario
     *
     * @param  \App\Models\MedicalRecord  $medicalRecord
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $user = $request->user(); // Obtener el usuario autenticado
        $userId = $user->id;
        // Obtener los beneficiarios asociados al usuario
        $beneficiaries = Beneficiary::where('primary_user_id', $user->id)->get();


        if ($beneficiaries->isEmpty()) {
            return response()->json([
                'Status' => 'Error',
                'Message' => 'No se encontraron beneficiarios asociados a este usuario'
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'Status' => 'Success',
            'Beneficiaries' => $beneficiaries
        ], Response::HTTP_OK);
    }

    /**
     * Funcion para eliminar un beneficiario
     *
     * @param  \App\Models\MedicalRecord  $medicalRecord
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $beneficiary = Beneficiary::find($id);
        // Verificar si el beneficiario existe
        if (!$beneficiary) {
            return response()->json([
                'Status' => 'Error',
                'Message' => 'Beneficiario no encontrado',
            ], Response::HTTP_NOT_FOUND);
        }

        // Verificar si el usuario autenticado tiene permiso para eliminar el beneficiario
        $user = auth()->user();

        if ($beneficiary->primary_user_id !== $user->id) {
            return response()->json([
                'Status' => 'Error',
                'Message' => 'No tienes permiso para eliminar este beneficiario',
            ], Response::HTTP_FORBIDDEN);
        }

        // Obtener los registros médicos relacionados con este beneficiario
        $medicalRecords = MedicalRecord::where('beneficiary_id', $beneficiary->id)->get();

        /**
         * Eliminar los registros médicos relacionados en cascada
         * a grandes rasgos sólo se necesita uno, pero se
         * mantiene la lógica antes de refactorizar
         */
        foreach ($medicalRecords as $medicalRecord) {
            $medicalRecord->delete();
        }

        // Eliminar el beneficiario
        $beneficiary->delete();

        return response()->json([
            'Status' => 'Success',
            'Message' => 'Beneficiario y registros médicos relacionados eliminados correctamente',
        ], Response::HTTP_OK);
    }
}
