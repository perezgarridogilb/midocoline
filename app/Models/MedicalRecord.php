<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    use HasFactory;
    // En el modelo de Expediente Médico (MedicalRecords)

    protected $fillable = ['lugar_nacimiento', 'sexo', 'edad', 'tipo_sangre', 'peso', 'estatura', 'alergias', 'user_id'];

    public function setPesoAttribute($value)
    {
        $this->attributes['peso'] = $value;
        $this->calcularIMC();
    }

    public function setEstaturaAttribute($value)
    {
        $this->attributes['estatura'] = $value;
        $this->calcularIMC();
    }

    /**
     * Calculate IMC function Mutator
     * 
     * @return void
     */
    private function calcularIMC()
    {
        if (isset($this->attributes['peso']) && isset($this->attributes['estatura'])) {
            $peso = $this->attributes['peso'];
            $estatura = $this->attributes['estatura'] / 100; // Convertir estatura a metros
            $imc = $peso / ($estatura * $estatura);
            $this->attributes['imc'] = round($imc, 2);
        } else {
            $this->attributes['imc'] = null; // Si 'peso' o 'estatura' no están definidos
        }
    }
}
