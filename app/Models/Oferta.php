<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Oferta extends Model
{
    use SoftDeletes;

    protected $table = 'ofertas';

    protected $fillable = [
        'idempresa',
        'idsector',
        'idmodalidad',
        'idpuesto',
        'titulo',
        'descripcion',
        'requisitos',
        'funciones',
        'salario_min',
        'salario_max',
        'tipo_contrato',
        'jornada',
        'ubicacion',
        'fecha_publicacion',
        'publicar_hasta',
        'fecha_incorporacion',
        'estado',
    ];

    protected $casts = [
        'salario_min' => 'decimal:2',
        'salario_max' => 'decimal:2',
        'fecha_publicacion' => 'date',
        'publicar_hasta' => 'date',
        'fecha_incorporacion' => 'date',
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'idempresa');
    }

    public function sector()
    {
        return $this->belongsTo(Sector::class, 'idsector');
    }

    public function modalidad()
    {
        return $this->belongsTo(Modalidad::class, 'idmodalidad');
    }

    public function puesto()
    {
        return $this->belongsTo(Puesto::class, 'idpuesto');
    }
    public function candidaturas()
    {
        return [];
    }
}
