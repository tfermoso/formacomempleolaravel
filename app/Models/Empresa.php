<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Sector;
use App\Models\User;    


class Empresa extends Model
{
    use SoftDeletes;

    protected $table = 'empresas';

    protected $fillable = [
        'cif',
        'nombre',
        'telefono',
        'web',
        'persona_contacto',
        'email_contacto',
        'direccion',
        'cp',
        'ciudad',
        'provincia',
        'logo',
        'verificada',
    ];

    protected $casts = [
        'verificada' => 'boolean',
    ];

    public function sectores()
    {
        return $this->belongsToMany(
            Sector::class,
            'empresa_sector',
            'idempresa',
            'idsector'
        )->withTimestamps(); // si tu pivote tiene created_at/updated_at
    }
    public function users()
{
    return $this->hasMany(User::class, 'empresa_id');
}

    public function ofertas()
    {
        return $this->hasMany(Oferta::class, 'idempresa'); 
    }

}
