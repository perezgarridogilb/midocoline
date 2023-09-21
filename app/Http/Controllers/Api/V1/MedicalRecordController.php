<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MedicalRecord;
use App\Models\Beneficiary;

class MedicalRecordController extends Controller
{
    // Servicio web para insertar expediente clínico
    public function insert(Request $request)
    {
        // Valida y guarda los datos enviados en la solicitud
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'lugar_nacimiento' => 'required|string',
            'sexo' => 'required|in:M,F',
            'edad' => 'required|integer',
            'tipo_sangre' => 'required|string',
            'peso' => 'required|numeric',
            'estatura' => 'required|numeric',
            'alergias' => 'nullable|string',
        ]);

        // Crea un nuevo expediente médico
        $medicalRecord = MedicalRecord::create($data);

        // Calcula el IMC y lo guarda en el expediente médico
        $medicalRecord->calcularIMC();

        // Retorna la respuesta con los datos del expediente médico
        return response()->json($medicalRecord);
    }

    // Servicio web para actualizar expediente clínico
    public function update(Request $request, $id)
    {
        // Busca el expediente médico por ID
        $medicalRecord = MedicalRecord::findOrFail($id);

        // Valida y actualiza los datos enviados en la solicitud
        $data = $request->validate([
            'lugar_nacimiento' => 'required|string',
            'sexo' => 'required|in:M,F',
            'edad' => 'required|integer',
            'tipo_sangre' => 'required|string',
            'peso' => 'required|numeric',
            'estatura' => 'required|numeric',
            'alergias' => 'nullable|string',
        ]);

        // Actualiza los datos del expediente médico
        $medicalRecord->update($data);

        // Calcula el IMC y lo actualiza en el expediente médico
        $medicalRecord->calcularIMC();

        // Retorna la respuesta con los datos actualizados del expediente médico
        return response()->json($medicalRecord);
    }

    // Servicio web para calcular el IMC
    public function calculateBMI(Request $request, $id)
    {
        // Busca el expediente médico por ID
        $medicalRecord = MedicalRecord::findOrFail($id);

        // Calcula el IMC y lo actualiza en el expediente médico
        $medicalRecord->calcularIMC();

        // Retorna la respuesta con el IMC actualizado
        return response()->json(['imc' => $medicalRecord->imc]);
    }

    // Servicio web para agregar beneficiarios
    public function addBeneficiary(Request $request, $id)
    {
        // Busca el expediente médico por ID
        $medicalRecord = MedicalRecord::findOrFail($id);

        // Valida y guarda los datos del beneficiario
        $data = $request->validate([
            'beneficiary_name' => 'required|string',
            'relationship' => 'required|string',
        ]);

        // Crea un nuevo beneficiario y lo relaciona con el expediente médico
        $beneficiary = new Beneficiary($data);
        $medicalRecord->beneficiaries()->save($beneficiary);

        // Retorna la respuesta con los datos del beneficiario
        return response()->json($beneficiary);
    }

    // Servicio web para eliminar beneficiarios
    public function deleteBeneficiary($id)
    {
        // Busca el beneficiario por ID y lo elimina
        $beneficiary = Beneficiary::findOrFail($id);
        $beneficiary->delete();

        // Retorna una respuesta exitosa
        return response()->json(['message' => 'Beneficiary deleted successfully']);
    }
}
