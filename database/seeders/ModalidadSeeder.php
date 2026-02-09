<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Modalidad;

class ModalidadSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['Presencial', 'Híbrido', 'Remoto'] as $m) {
            Modalidad::firstOrCreate(['nombre' => $m]);
        }
    }
}
