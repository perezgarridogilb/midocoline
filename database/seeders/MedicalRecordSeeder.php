<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MedicalRecordSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\MedicalRecord::factory(10)->create();
    }
}
