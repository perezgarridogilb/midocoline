<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MedicalRecordSeeder extends Seeder
{
    /**
     * Registros clinicos seeder
     *
     * @return void
     */
    public function run()
    {
        \App\Models\MedicalRecord::factory(10)->create();
    }
}
