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

        $noticiasCarrusel = Noticia::with('tags')
        ->where('estado', 'PUBLICADA')
        ->where('mostrar_carrusel', true)
        ->whereNotNull('fecha_publicacion')
        ->where('fecha_publicacion', '<=', now())
        ->orderBy('orden_carrusel')
        ->latest('fecha_publicacion')
        ->get();

        $ultimasNoticias = Noticia::with('tags')
        ->where('estado', 'PUBLICADA')
        ->whereNotNull('fecha_publicacion')
        ->where('fecha_publicacion', '<=', now())
        ->latest('fecha_publicacion')
        ->take(6)
        ->get();

        $docentes = Docente::where('mostrar_principal', true)
        ->orderBy('orden')
        ->orderBy('apellido')
        ->take(10)
        ->get();

        return view('welcome', compact(
            'entidad',
            'noticiasCarrusel',
            'ultimasNoticias',
            'docentes'
        ));
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
        $entidad = Entidad::where('activo', true)->first();
        return view('web.noticia', compact('entidad', 'noticia'));
    }
}
