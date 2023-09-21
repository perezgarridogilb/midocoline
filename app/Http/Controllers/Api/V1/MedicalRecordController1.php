<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\MedicalRecord;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Http\Resources\V1\MedicalRecordResource;

class MedicalRecordController1 extends Controller
{
    /**
     * Ver ultimos expedientes medicos paginados
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return MedicalRecordResource::collection(MedicalRecord::latest()->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Ver expediente medico especifico
     *
     * @param  \App\Models\MedicalRecord  $medicalRecord
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $medicalRecord = MedicalRecord::find($id);
        // Verificar si el expediente médico existe
        if (!$medicalRecord) {
            return response()->json([
                'Status' => 'Error',
                'Message' => 'Expediente médico no encontrado'
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'Status' => 'Success',
            'Message' => 'Expediente médico encontrado satisfactoriamente',
            'data' => new MedicalRecordResource($medicalRecord),
        ], Response::HTTP_ACCEPTED);
    }

    /**
     * Actualizar expediente medico especifico
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
     * Elimina expediente medico especifico
     *
     * @param  \App\Models\MedicalRecord  $medicalRecord
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $medicalRecord = MedicalRecord::find($id);

        if (!$medicalRecord) {
            return response()->json([
                'Status' => 'Error',
                'Message' => 'Expediente médico no encontrado'
            ], Response::HTTP_NOT_FOUND);
        }

        // Intentar eliminar el registro
        try {
            $medicalRecord->delete();
            return response()->json([
                'Status' => 'Success',
                'Message' => 'Expediente médico eliminado satisfactoriamente'
            ], Response::HTTP_ACCEPTED);
        } catch (\Exception $e) {
            return response()->json([
                'Status' => 'Error',
                'Message' => 'No se pudo eliminar el expediente médico',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
