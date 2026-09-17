<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use App\Models\Entidad;
use App\Models\Noticia;
use Illuminate\Http\Request;

class WebController extends Controller
{

    public function index()
    {
        $entidad = Entidad::where('activo', true)->first();

        $ultimasNoticias = Noticia::with('tags')
        ->where('estado', 'PUBLICADA')
        ->whereNotNull('fecha_publicacion')
        ->where('fecha_publicacion', '<=', now())
        ->orderByDesc('fecha_publicacion')
        ->take(6)
        ->get();

        $docentes = Docente::where('mostrar_principal', true)
        ->orderBy('orden')
        ->orderBy('apellido')
        ->take(10)
        ->get();

        return view('welcome', compact('entidad','ultimasNoticias','docentes'));
    }

    public function institucional()
    {
        $entidad = Entidad::where('activo', true)->first();
        return view('web.institucional', compact('entidad'));
    }

    public function noticias()
    {
        $entidad = Entidad::where('activo', true)->first();
        $noticias = Noticia::with('tags')
        ->where('estado', 'PUBLICADA')
        ->whereNotNull('fecha_publicacion')
        ->where('fecha_publicacion', '<=', now())
        ->latest('fecha_publicacion')
        ->paginate(10);

        return view('web.noticias', compact('entidad', 'noticias'));
    }

    public function noticia(Noticia $noticia)
    {
        /*
        | Los visitantes solamente pueden ver noticias publicadas.
        | El administrador autenticado también puede previsualizar borradores.
        */
        if ($noticia->estado !== 'PUBLICADA' && !auth()->check()) {
            abort(404);
        }

        if (
            $noticia->estado === 'PUBLICADA' &&
            $noticia->fecha_publicacion &&
            $noticia->fecha_publicacion->isFuture() && !auth()->check()
        ) {
            abort(404);
        }

        $noticia->load([
            'user',
            'tags',
            'imagenes' => function ($query) {
                $query->where('activo', 1)->orderBy('orden');
            },
        ]);

        return view('web.noticia', compact('noticia'));
}
}
