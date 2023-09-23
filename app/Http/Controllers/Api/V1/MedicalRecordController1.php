<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\MedicalRecord;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Http\Resources\V1\MedicalRecordResource;
use Illuminate\Support\Facades\Auth;

class MedicalRecordController1 extends Controller
{
    /**
     * Ver ultimos expedientes clinicos paginados
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return MedicalRecordResource::collection(MedicalRecord::latest()->paginate());
    }

    /**
     * Crear expediente clinico
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $request->user(); // Obtener el usuario autenticado
        $userId = $user->id; // Obtener el ID del usuario

        // Verificar si el usuario ya tiene más de un registro clínico
        if (MedicalRecord::where('user_id', $userId)->count() >= 1) {
            return response()->json([
                'Status' => 'Error',
                'Message' => 'El usuario ya tiene un expediente clínico registrado. No se permite crear más.',
            ], Response::HTTP_BAD_REQUEST);
        }

        // Validar los datos de entrada
        $validatedData = $request->validate([
            'lugar_nacimiento' => 'required|string',
            'sexo' => 'required|in:M,F',
            'edad' => 'required|integer',
            'tipo_sangre' => 'required|string',
            'peso' => 'required|numeric',
            'estatura' => 'required|numeric',
            'alergias' => 'nullable|string',
        ]);

        // Agregar 'user_id' al array de datos validados
        $validatedData['user_id'] = $userId;

        // Verificar si el campo IMC se incluyó en los datos de entrada
        if ($request->has('imc')) {
            return response()->json([
                'Status' => 'Error',
                'Message' => 'El campo IMC no se puede proporcionar manualmente',
            ], Response::HTTP_BAD_REQUEST);
        }

        // Crear el registro clínico
        $medicalRecord = MedicalRecord::create($validatedData);

        // Verificar si la creación fue exitosa
        if ($medicalRecord) {
            return response()->json([
                'Status' => 'Success',
                'Message' => 'Expediente clínico creado satisfactoriamente',
                'data' => new MedicalRecordResource($medicalRecord),
            ], Response::HTTP_CREATED);
        } else {
            return response()->json([
                'Status' => 'Error',
                'Message' => 'No se pudo crear el expediente clínico',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Ver expediente clinico especifico
     *
     * @param  \App\Models\MedicalRecord  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $medicalRecord = MedicalRecord::find($id);
        // Verificar si el expediente clínico existe
        if (!$medicalRecord) {
            return response()->json([
                'Status' => 'Error',
                'Message' => 'Expediente clínico no encontrado'
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'Status' => 'Success',
            'Message' => 'Expediente clínico encontrado satisfactoriamente',
            'data' => new MedicalRecordResource($medicalRecord),
        ], Response::HTTP_ACCEPTED);
    }

    /**
     * Actualizar expediente clinico especifico
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MedicalRecord  $medicalRecord
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = $request->user(); // Obtener el usuario autenticado
        $userId = $user->id; // Obtener el ID del usuario

        $medicalRecord = MedicalRecord::where('user_id', $userId)->first();

        // Validar los datos de entrada
        $validatedData = $request->validate([
            'lugar_nacimiento' => 'required|string',
            'sexo' => 'required|in:M,F',
            'edad' => 'required|integer',
            'tipo_sangre' => 'required|string',
            'peso' => 'required|numeric',
            'estatura' => 'required|numeric',
            'alergias' => 'nullable|string',
        ]);

        // Agregar 'user_id' al array de datos validados
        $validatedData['user_id'] = $userId;

        // Verificar si el campo IMC se incluyó en los datos de entrada
        if ($request->has('imc')) {
            return response()->json([
                'Status' => 'Error',
                'Message' => 'El campo IMC no se puede proporcionar manualmente',
            ], Response::HTTP_BAD_REQUEST);
        }

        // Actualiza el registro clínico
        $updated = $medicalRecord->update($validatedData);

        // Verificar si la creación fue exitosa
        if ($updated) {
            return response()->json([
                'Status' => 'Success',
                'Message' => 'Expediente médico actualizado satisfactoriamente',
                'data' => $medicalRecord,
            ], Response::HTTP_CREATED);
        } else {
            return response()->json([
                'Status' => 'Error',
                'Message' => 'No se pudo actualizar el expediente médico',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Elimina expediente clinico especifico
     *
     * @param  \App\Models\MedicalRecord  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user = $request->user(); // Obtener el usuario autenticado
        $userId = $user->id; // Obtener el ID del usuario
        
        $medicalRecord = MedicalRecord::where('user_id', $userId)->first();

        if (!$medicalRecord) {
            return response()->json([
                'Status' => 'Error',
                'Message' => 'Expediente clínico no encontrado',
                'data' => new MedicalRecordResource($medicalRecord)
            ], Response::HTTP_NOT_FOUND);
        }

        // Intentar eliminar el registro
        try {
            $medicalRecord->delete();
            return response()->json([
                'Status' => 'Success',
                'Message' => 'Expediente clínico eliminado satisfactoriamente',
                'data' => new MedicalRecordResource($medicalRecord)
            ], Response::HTTP_ACCEPTED);
        } catch (\Exception $e) {
            return response()->json([
                'Status' => 'Error',
                'Message' => 'No se pudo eliminar el expediente clínico',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
