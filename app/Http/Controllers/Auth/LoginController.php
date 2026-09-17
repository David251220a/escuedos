<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Entidad;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/portal/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function username(): string
    {
        return 'username';
    }
        public function showLoginForm()
    {
        $entidad = Entidad::where('activo', true)->first();

        return view('auth.login', compact('entidad'));
    }

    /**
     * Limpia espacios y valida los datos antes de autenticar.
     */
    protected function validateLogin(Request $request): void
    {
        $request->merge([
            'username' => trim((string) $request->input('username')),
        ]);

        $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ], [
            'username.required' => 'Debe ingresar su usuario.',
            'password.required' => 'Debe ingresar su contraseña.',
        ]);
    }

}
