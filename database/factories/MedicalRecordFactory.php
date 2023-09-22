<?php
use Faker\Generator as Faker;

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MedicalRecordFactory extends Factory
{
    /**
     * Registro clinico factory
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => rand(1, 10),
            'lugar_nacimiento' => $this->faker->city,
            'sexo' => $this->faker->randomElement(['M', 'F']),
            'edad' => $this->faker->numberBetween(18, 80),
            'tipo_sangre' => $this->faker->randomElement(['A+', 'B+', 'O+', 'AB+', 'A-', 'B-', 'O-', 'AB-']),
            'peso' => $this->faker->randomFloat(2, 40, 150),
            'estatura' => $this->faker->randomFloat(2, 140, 200),
            'alergias' => $this->faker->optional()->text(100),
                    // 'imc' se calculará automáticamente en el modelo, no es necesario definirlo aquí.
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
