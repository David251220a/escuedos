<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use App\Models\Entidad;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class DocenteController extends Controller
{
    public function index(Request $request)
    {
        $entidad = Entidad::where('activo', true)->firstOrFail();

        $buscar = trim((string) $request->buscar);
        $mostrarPrincipal = $request->mostrar_principal;

        $data = Docente::with('user')
            ->where('entidad_id', $entidad->id)

            ->when($buscar, function ($query) use ($buscar) {
                $query->where(function ($consulta) use ($buscar) {
                    $consulta
                        ->where('documento', 'LIKE', "%{$buscar}%")
                        ->orWhere('nombre', 'LIKE', "%{$buscar}%")
                        ->orWhere('apellido', 'LIKE', "%{$buscar}%")
                        ->orWhere('email', 'LIKE', "%{$buscar}%");
                });
            })

            ->when(
                $mostrarPrincipal !== null
                && $mostrarPrincipal !== '',
                function ($query) use ($mostrarPrincipal) {
                    $query->where(
                        'mostrar_principal',
                        (int) $mostrarPrincipal
                    );
                }
            )

            ->orderBy('orden')
            ->orderBy('apellido')
            ->orderBy('nombre')
            ->paginate(30)
            ->withQueryString();

        return view('docente.index', compact(
            'data',
            'entidad',
            'buscar',
            'mostrarPrincipal'
        ));
    }

    public function create()
    {
        $entidad = Entidad::where('activo', true)->firstOrFail();

        $usuariosAsignados = Docente::whereNotNull('user_id')
            ->pluck('user_id');

        $usuarios = User::whereNotIn('id', $usuariosAsignados)
            ->orderBy('name')
            ->orderBy('lastname')
            ->get();

        $docente = new Docente([
            'entidad_id' => $entidad->id,
            'mostrar_principal' => false,
            'orden' => 0,
        ]);

        return view('docente.create', compact(
            'docente',
            'entidad',
            'usuarios'
        ));
    }

    public function store(Request $request)
    {
        $entidad = Entidad::where('activo', true)->firstOrFail();

        $datos = $this->validar($request);

        $datos['entidad_id'] = $entidad->id;
        $datos['mostrar_principal'] = $request->boolean(
            'mostrar_principal'
        );

        if ($request->hasFile('foto')) {
            $datos['foto'] = $request->file('foto')
                ->store('docentes', 'public');
        }

        Docente::create($datos);

        return redirect()
            ->route('docente.index')
            ->with(
                'message',
                'Docente registrado correctamente.'
            );
    }

    public function edit(Docente $docente)
    {
        $entidad = Entidad::where('activo', true)->firstOrFail();

        $usuariosAsignados = Docente::whereNotNull('user_id')
            ->where('id', '<>', $docente->id)
            ->pluck('user_id');

        $usuarios = User::whereNotIn('id', $usuariosAsignados)
            ->orWhere('id', $docente->user_id)
            ->orderBy('name')
            ->orderBy('lastname')
            ->get();

        return view('docente.edit', compact(
            'docente',
            'entidad',
            'usuarios'
        ));
    }

    public function update(Request $request, Docente $docente)
    {
        $datos = $this->validar($request, $docente);

        $datos['mostrar_principal'] = $request->boolean(
            'mostrar_principal'
        );

        if ($request->boolean('eliminar_foto') && $docente->foto) {
            Storage::disk('public')->delete($docente->foto);
            $datos['foto'] = null;
        }

        if ($request->hasFile('foto')) {
            if ($docente->foto) {
                Storage::disk('public')->delete($docente->foto);
            }

            $datos['foto'] = $request->file('foto')
                ->store('docentes', 'public');
        }

        $docente->update($datos);

        return redirect()
            ->route('docente.index')
            ->with(
                'message',
                'Docente actualizado correctamente.'
            );
    }

    public function destroy(Docente $docente)
    {
        if ($docente->foto) {
            Storage::disk('public')->delete($docente->foto);
        }

        $docente->delete();

        return redirect()
            ->route('docente.index')
            ->with(
                'message',
                'Docente eliminado correctamente.'
            );
    }

    private function validar(
        Request $request,
        ?Docente $docente = null
    ): array {
        return $request->validate([
            'user_id' => [
                'nullable',
                'integer',
                'exists:users,id',
                Rule::unique('docentes', 'user_id')
                    ->ignore($docente?->id),
            ],

            'documento' => [
                'nullable',
                'string',
                'max:30',
                Rule::unique('docentes', 'documento')
                    ->ignore($docente?->id),
            ],

            'nombre' => [
                'required',
                'string',
                'max:255',
            ],

            'apellido' => [
                'required',
                'string',
                'max:255',
            ],

            'fecha_nacimiento' => [
                'nullable',
                'date',
                'before_or_equal:today',
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
            ],

            'celular' => [
                'nullable',
                'string',
                'max:30',
            ],

            'direccion' => [
                'nullable',
                'string',
                'max:255',
            ],

            'fecha_ingreso' => [
                'nullable',
                'date',
            ],

            'foto' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            'mostrar_principal' => [
                'nullable',
                'boolean',
            ],

            'orden' => [
                'required',
                'integer',
                'min:0',
                'max:9999',
            ],

            'eliminar_foto' => [
                'nullable',
                'boolean',
            ],
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'apellido.required' => 'El apellido es obligatorio.',
            'documento.unique' => 'Este documento ya está registrado.',
            'user_id.unique' => 'Este usuario ya está asignado a otro docente.',
            'user_id.exists' => 'El usuario seleccionado no existe.',
            'email.email' => 'Ingrese un correo electrónico válido.',
            'fecha_nacimiento.before_or_equal' =>
                'La fecha de nacimiento no puede ser posterior a hoy.',
            'foto.image' => 'El archivo seleccionado debe ser una imagen.',
            'foto.mimes' =>
                'La fotografía debe ser JPG, JPEG, PNG o WEBP.',
            'foto.max' =>
                'La fotografía no puede superar los 5 MB.',
            'orden.required' => 'El orden es obligatorio.',
            'orden.integer' => 'El orden debe ser un número entero.',
        ]);
    }
}
