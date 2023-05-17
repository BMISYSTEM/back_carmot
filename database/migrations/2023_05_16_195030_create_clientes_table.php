<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido');
            $table->integer('cedula')->unique();
            $table->date('date');
            $table->integer('telefono');
            $table->string('email');
            $table->string('vfinanciar');
            $table->string('ncuotas');
            $table->string('valormensual');
            $table->string('doccedula');
            $table->string('docestratos');
            $table->string('docdeclaracion');
            $table->string('docsolicitud');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
