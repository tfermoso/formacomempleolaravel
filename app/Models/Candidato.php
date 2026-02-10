<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\User;
use App\Models\Oferta;

class Candidato extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'dni',
        'nombre',
        'apellidos',
        'telefono',
        'email',
        'linkedin',
        'web',
        'cv',
        'foto',
        'direccion',
        'cp',
        'ciudad',
        'provincia',
        'fecha_nacimiento',
        'user_id',
    ];



    protected $casts = [
        'fecha_nacimiento' => 'date',
    ];

    public function ofertas(): BelongsToMany
    {
        return $this->belongsToMany(Oferta::class)
            ->withPivot(['fecha_inscripcion', 'estado', 'comentarios'])
            ->withTimestamps();
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
