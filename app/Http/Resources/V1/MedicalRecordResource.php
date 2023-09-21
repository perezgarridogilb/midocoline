<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class MedicalRecordResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request): array
    {
        /**
         * mejor apariencia
         */
        return [
            "lugar_nacimiento" => $this->lugar_nacimiento,
            "sexo" => $this->sexo,
            "edad" => $this->edad,
            "tipo_sangre" => $this->tipo_sangre,
            "peso" => $this->peso,
            "estatura" => $this->estatura,
            "alergias" => $this->alergias,
            "imc" => $this->imc,
        ];
    }
}
