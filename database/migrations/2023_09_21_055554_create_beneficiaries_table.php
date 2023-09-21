<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeneficiariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beneficiaries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('primary_user_id'); // Clave foránea que relaciona el beneficiario con el usuario principal
            $table->string('beneficiary_name'); // Nombre del beneficiario
            $table->string('relationship'); // Relación con el titular (cónyuge, hijo, etc.)
            $table->timestamps();
    
            $table->foreign('primary_user_id')->references('id')->on('users');
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('beneficiaries');
    }
}
