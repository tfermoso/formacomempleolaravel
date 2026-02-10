<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('candidato_oferta', function (Blueprint $table) {
            $table->foreignId('candidato_id')->constrained('candidatos')->cascadeOnDelete();
            $table->foreignId('oferta_id')->constrained('ofertas')->cascadeOnDelete();

            $table->timestamp('fecha_inscripcion')->useCurrent();

            $table->enum('estado', [
                'inscrito',
                'revisado',
                'preseleccionado',
                'entrevista',
                'descartado',
                'finalista',
                'contratado',
            ])->default('inscrito');

            $table->text('comentarios')->nullable();

            $table->timestamps();

            $table->primary(['candidato_id', 'oferta_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('candidato_oferta');
    }
};
