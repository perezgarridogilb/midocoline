<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BeneficiariesTableSeeder extends Seeder
{
    /**
     * Beneficiarios seeder
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Beneficiary::factory(10)->create();
    }
}
