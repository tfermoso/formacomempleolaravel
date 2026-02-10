<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sector;

class SectoresSeeder extends Seeder
{
    public function run(): void
    {
        $sectores = [
            'Consultoría',
            'Formación',
            'Distribución',
            'Tecnología / Software',
            'Telecomunicaciones',
            'Marketing y Publicidad',
            'Recursos Humanos',
            'Finanzas y Seguros',
            'Legal',
            'Industria / Manufactura',
            'Logística y Transporte',
            'Construcción',
            'Energía',
            'Inmobiliaria',
            'Hostelería y Turismo',
            'Retail / Comercio',
            'Salud',
            'Educación',
            'Servicios',
            'Otros',
        ];

        foreach ($sectores as $nombre) {
            Sector::firstOrCreate(['nombre' => $nombre]);
        }
    }
}
