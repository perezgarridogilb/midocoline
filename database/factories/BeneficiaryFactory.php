<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


class BeneficiaryFactory extends Factory
{
    /**
     * Beneficiario factory
     *
     * @return array
     */
    public function definition()
    {
        return [
            'primary_user_id' => function () {
                return \App\Models\User::factory()->create()->id;
            },
            'beneficiary_name' => $this->faker->name,
            'relationship' => $this->faker->word,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10),
        ];
    }
}
