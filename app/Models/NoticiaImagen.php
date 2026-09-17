<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NoticiaImagen extends Model
{

    protected $guarded = [];

    public function noticia()
    {
        return $this->belongsTo(Noticia::class);
    }

}
