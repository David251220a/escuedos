<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Noticia extends Model
{

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'fecha_evento' => 'date',
            'fecha_publicacion' => 'datetime',
        ];
    }

    public function imagenes()
    {
        return $this->hasMany(NoticiaImagen::class)->orderBy('orden');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class,'noticia_tags','noticia_id','tag_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
