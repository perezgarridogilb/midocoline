<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEsTitularToMedicalRecords extends Migration
{
    public function up()
    {
        Schema::table('medical_records', function (Blueprint $table) {
            $table->tinyInteger('es_titular')->default(1)->after('imc');
        });
    }

    public function down()
    {
        Schema::table('medical_records', function (Blueprint $table) {
            $table->dropColumn('es_titular');
        });
    }
}
