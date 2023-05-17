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
        Schema::create('permisos', function (Blueprint $table) {
            $table->id();
            $table->integer('dashboard')->default(0);
            $table->integer('administrador')->default(0);
            $table->integer('usuarios')->default(0);
            $table->integer('recepcion')->default(0);
            $table->integer('ajustes')->default(0);
            $table->integer('campanas')->default(0);
            $table->integer('contabilidad')->default(0);
            $table->integer('transferencias')->default(0);
            $table->integer('proveedor')->default(0);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permisos');
    }
};
