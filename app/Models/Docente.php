<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{

    protected $fillable = [
        'entidad_id',
        'user_id',
        'documento',
        'nombre',
        'apellido',
        'fecha_nacimiento',
        'email',
        'celular',
        'direccion',
        'fecha_ingreso',
        'foto',
        'mostrar_principal',
        'orden',
    ];

    protected $casts = [
        'fecha_nacimiento' => 'date',
        'fecha_ingreso' => 'date',
        'mostrar_principal' => 'boolean',
        'orden' => 'integer',
    ];

    public function entidad()
    {
        return $this->belongsTo(Entidad::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
