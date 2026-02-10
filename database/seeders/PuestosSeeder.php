<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Puesto;

class PuestosSeeder extends Seeder
{
    public function run(): void
    {
        $puestos = [
            'Administración',
            'Atención al cliente',
            'Comercial / Ventas',
            'Contabilidad / Finanzas',
            'Diseño / Creatividad',
            'Educación / Formación',
            'Hostelería / Turismo',
            'Ingeniería',
            'IT / Desarrollo Software',
            'Legal',
            'Logística / Transporte',
            'Marketing / Comunicación',
            'Producción / Operaciones',
            'Recursos Humanos',
            'Sanidad',
        ];

        foreach ($puestos as $nombre) {
            Puesto::firstOrCreate(['nombre' => $nombre]);
        }
    }
}
