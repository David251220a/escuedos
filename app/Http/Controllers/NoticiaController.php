<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NoticiaController extends Controller
{
    public function index()
    {
        $data = Noticia::orderBy('id', 'DESC')->paginate(30);
        return view('noticia.index', compact('data'));
    }

    public function create()
    {
        $tags = Tag::where('activo', 1)
        ->orderBy('nombre')
        ->get();

        return view('noticia.create', compact('tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => ['required', 'string', 'max:255'],
            'resumen' => ['nullable', 'string', 'max:500'],
            'contenido' => ['required', 'string'],
            'fecha_evento' => ['nullable', 'date'],
            'fecha_publicacion' => ['nullable', 'date'],
            'tipo_presentacion' => ['required','in:NORMAL,DESTACADA,CARRUSEL,GALERIA,COMUNICADO'],
            'estado' => ['required', 'in:BORRADOR,PUBLICADA'],
            'imagen_portada' => ['nullable','image','mimes:jpg,jpeg,','max:5120'],
            'tags' => ['required', 'array'],
            'tags.*' => ['exists:tags,id'],
            'imagenes' => ['nullable', 'array'],
            'imagenes.*' => ['nullable','image','mimes:jpg,jpeg','max:5120'],
            'titulos_imagen' => ['nullable', 'array'],
            'titulos_imagen.*' => ['nullable', 'string', 'max:255'],
            'textos_alternativos' => ['nullable', 'array'],
            'textos_alternativos.*' => ['nullable', 'string', 'max:255'],
        ], [
            'titulo.required' => 'Debe ingresar el título.',
            'contenido.required' => 'Debe ingresar el contenido de la noticia.',
            'tipo_presentacion.required' => 'Debe seleccionar la presentación.',
            'imagen_portada.image' => 'La portada debe ser una imagen.',
            'imagen_portada.max' => 'La portada no debe superar los 5 MB.',
            'imagenes.*.image' => 'Los archivos adicionales deben ser imágenes.',
            'imagenes.*.max' => 'Cada imagen no debe superar los 5 MB.',
        ]);

        DB::beginTransaction();

        try {
            $slugBase = Str::slug($request->titulo);
            $slug = $slugBase;
            $numero = 1;

            while (Noticia::where('slug', $slug)->exists()) {
                $slug = $slugBase . '-' . $numero;
                $numero++;
            }

            $imagenPortada = null;

            if ($request->hasFile('imagen_portada')) {
                $imagenPortada = $request->file('imagen_portada')->store('noticias/portadas', 'public');
            }

            $noticia = Noticia::create([
                'user_id' => Auth::id(),
                'titulo' => $request->titulo,
                'slug' => $slug,
                'resumen' => $request->resumen,
                'contenido' => $request->contenido,
                'fecha_evento' => $request->fecha_evento,
                'imagen' => $imagenPortada,
                'tipo_presentacion' => $request->tipo_presentacion,
                'mostrar_carrusel' => 0,
                'orden_carrusel' => 0,
                'activo' => 1,
                'estado' => $request->estado,
                'fecha_publicacion' => $request->estado === 'PUBLICADA' ? ($request->fecha_publicacion ?? now()) : $request->fecha_publicacion,
            ]);

            $noticia->tags()->sync($request->tags ?? []);

            if ($request->hasFile('imagenes')) {
                foreach ($request->file('imagenes') as $indice => $imagen) {
                    if (!$imagen) {
                        continue;
                    }

                    $ruta = $imagen->store('noticias/galeria','public');
                    $noticia->imagenes()->create([
                        'imagen' => $ruta,
                        'titulo' => $request->titulos_imagen[$indice] ?? null,
                        'texto_alternativo' => $request->textos_alternativos[$indice] ?? null,
                        'orden' => $indice + 1,
                        'activo' => 1,
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('noticia.index')->with('message', 'Noticia registrada correctamente.');

        } catch (\Throwable $e) {
            DB::rollBack();

            return redirect()->back()->withInput()->with('error', 'No se pudo registrar la noticia: ' . $e->getMessage());
        }
    }

    public function edit(Noticia $noticia)
    {
        $noticia->load([
            'tags',
            'imagenes' => function ($query) {
                $query->orderBy('orden');
            },
        ]);

        $tags = Tag::where('activo', 1)
        ->orderBy('nombre')
        ->get();

        return view('noticia.edit', compact('noticia', 'tags'));
    }

    public function update(Request $request, Noticia $noticia)
    {
        $request->validate([
            'titulo' => ['required', 'string', 'max:255'],
            'resumen' => ['nullable', 'string', 'max:500'],
            'contenido' => ['required', 'string'],
            'fecha_evento' => ['nullable', 'date'],
            'fecha_publicacion' => ['nullable', 'date'],
            'tipo_presentacion' => ['required','in:NORMAL,DESTACADA,CARRUSEL,GALERIA,COMUNICADO'],
            'estado' => ['required','in:BORRADOR,PUBLICADA',],
            'imagen_portada' => ['nullable','image','mimes:jpg,jpeg','max:5120',],
            'tags' => ['required', 'array'],
            'tags.*' => ['exists:tags,id'],
            'imagenes' => ['nullable', 'array'],
            'imagenes.*' => ['nullable','image','mimes:jpg,jpeg','max:5120',],
            'titulos_imagen' => ['nullable', 'array'],
            'titulos_imagen.*' => ['nullable', 'string', 'max:255'],
            'textos_alternativos' => ['nullable', 'array'],
            'textos_alternativos.*' => ['nullable','string','max:255',],
            'imagenes_existentes' => ['nullable', 'array'],
            'imagenes_eliminar' => ['nullable', 'array'],
            'imagenes_eliminar.*' => ['integer','exists:noticia_imagens,id',],
        ], [
            'titulo.required' => 'Debe ingresar el título.',
            'contenido.required' => 'Debe ingresar el contenido.',
            'imagen_portada.image' => 'La portada debe ser una imagen.',
            'imagen_portada.max' => 'La portada no debe superar los 5 MB.',
            'imagenes.*.image' => 'Los archivos deben ser imágenes.',
            'imagenes.*.max' => 'Cada imagen no debe superar los 5 MB.',
        ]);

        DB::beginTransaction();

        try {
            /*
            |--------------------------------------------------------------------------
            | Generar slug
            |--------------------------------------------------------------------------
            */

            $slugBase = Str::slug($request->titulo);
            $slug = $slugBase;
            $numero = 1;

            while (
                Noticia::where('slug', $slug)
                ->where('id', '<>', $noticia->id)
                ->exists()
            ) {
                $slug = $slugBase . '-' . $numero;
                $numero++;
            }

            /*
            |--------------------------------------------------------------------------
            | Imagen de portada
            |--------------------------------------------------------------------------
            */

            $imagenPortada = $noticia->imagen_portada;

            if ($request->boolean('eliminar_portada')) {
                if ($imagenPortada && Storage::disk('public')->exists($imagenPortada)) {
                    Storage::disk('public')->delete($imagenPortada);
                }

                $imagenPortada = null;
            }

            if ($request->hasFile('imagen_portada')) {
                if ($imagenPortada && Storage::disk('public')->exists($imagenPortada)) {
                    Storage::disk('public')->delete($imagenPortada);
                }

                $imagenPortada = $request->file('imagen_portada')->store('noticias/portadas', 'public');
            }

            /*
            |--------------------------------------------------------------------------
            | Fecha de publicación
            |--------------------------------------------------------------------------
            */

            $fechaPublicacion = $request->fecha_publicacion;

            if ($request->estado === 'PUBLICADA' && empty($fechaPublicacion)) {
                $fechaPublicacion = $noticia->fecha_publicacion ?? now();
            }

            /*
            |--------------------------------------------------------------------------
            | Actualizar noticia
            |--------------------------------------------------------------------------
            */

            $noticia->update([
                'titulo' => $request->titulo,
                'slug' => $slug,
                'resumen' => $request->resumen,
                'contenido' => $request->contenido,
                'fecha_evento' => $request->fecha_evento,
                'imagen' => $imagenPortada,
                'tipo_presentacion' => $request->tipo_presentacion,
                'estado' => $request->estado,
                'fecha_publicacion' => $fechaPublicacion,
            ]);

            /*
            |--------------------------------------------------------------------------
            | Actualizar etiquetas
            |--------------------------------------------------------------------------
            */

            $noticia->tags()->sync($request->tags ?? []);

            /*
            |--------------------------------------------------------------------------
            | Actualizar imágenes existentes
            |--------------------------------------------------------------------------
            */

            foreach ($request->imagenes_existentes ?? [] as $imagenId => $datos) {
                $imagen = $noticia->imagenes()
                ->where('id', $imagenId)
                ->first();

                if ($imagen) {
                    $imagen->update([
                        'titulo' => $datos['titulo'] ?? null,
                        'texto_alternativo' => $datos['texto_alternativo'] ?? null,
                    ]);
                }
            }

            /*
            |--------------------------------------------------------------------------
            | Eliminar imágenes seleccionadas
            |--------------------------------------------------------------------------
            */

            $imagenesEliminar = $request->imagenes_eliminar ?? [];

            if (!empty($imagenesEliminar)) {
                $imagenes = $noticia->imagenes()
                ->whereIn('id', $imagenesEliminar)
                ->get();

                foreach ($imagenes as $imagen) {
                    if ($imagen->imagen && Storage::disk('public')->exists($imagen->imagen)) {
                        Storage::disk('public')->delete($imagen->imagen);
                    }

                    $imagen->delete();
                }
            }

            /*
            |--------------------------------------------------------------------------
            | Agregar nuevas imágenes
            |--------------------------------------------------------------------------
            */

            $ultimoOrden = (int) $noticia->imagenes()->max('orden');

            if ($request->hasFile('imagenes')) {
                foreach ($request->file('imagenes') as $indice => $imagen) {
                    if (!$imagen) {
                        continue;
                    }

                    $ultimoOrden++;

                    $ruta = $imagen->store('noticias/galeria','public');

                    $noticia->imagenes()->create([
                        'imagen' => $ruta,
                        'titulo' => $request->titulos_imagen[$indice] ?? null,
                        'texto_alternativo' => $request->textos_alternativos[$indice] ?? null,
                        'orden' => $ultimoOrden,
                        'activo' => 1,
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('noticia.index')->with('message', 'Noticia actualizada correctamente.');

        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error','No se pudo actualizar la noticia: ' . $e->getMessage());
        }
    }

    public function show(Noticia $noticia)
    {
        $noticia->load([
            'user',
            'tags',
            'imagenes' => function ($query) {
                $query->where('activo', 1)
                    ->orderBy('orden');
            },
        ]);
        return view('noticia.show', compact('noticia'));
    }

}
