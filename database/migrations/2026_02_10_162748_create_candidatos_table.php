<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('candidatos', function (Blueprint $table) {
            $table->id();

            $table->string('dni', 20)->nullable()->unique();
            $table->string('nombre', 100);
            $table->string('apellidos', 150);
            $table->string('telefono', 20)->nullable();

            $table->string('email', 150)->unique();

            $table->string('linkedin')->nullable();
            $table->string('web')->nullable();

            $table->string('cv')->nullable();
            $table->string('foto')->nullable();

            $table->string('direccion', 200)->nullable();
            $table->string('cp', 10)->nullable();
            $table->string('ciudad', 100)->nullable()->index();
            $table->string('provincia', 100)->nullable();

            $table->date('fecha_nacimiento')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('candidatos');
    }
};
