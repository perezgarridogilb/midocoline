<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Clave foránea que relaciona el expediente con el usuario
            $table->string('lugar_nacimiento'); // Lugar de nacimiento
            $table->enum('sexo', ['M', 'F']); // Sexo (Masculino o Femenino)
            $table->integer('edad'); // Edad (Número entero)
            $table->string('tipo_sangre'); // Tipo de sangre
            $table->decimal('peso', 5, 2); // Peso (Número decimal)
            $table->decimal('estatura', 5, 2); // Estatura (Número decimal)
            $table->text('alergias')->nullable(); // Alergias (Texto, con opción de ser nulo)
            $table->decimal('imc', 5, 2)->nullable(); // Índice de Masa Corporal (IMC), con opción de ser nulo
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medical_records');
    }
}
