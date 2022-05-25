<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

/**
 * Contiene todos los métodos necesarios para iniciar sesión
 * y registrar usuarios
 */
class LoginController extends Controller
{
    /**
     * Método para iniciar sesión
     */
    public function login(Request $request) {

        // Recoge las credenciales deñ formulario de inicio de sesión
        $credentials = request()->only('nombre', 'password');

        // Comprueba si hay un usuario con las mismas credenciales en la BBDD
        if(Auth::attempt($credentials)) {
            // Crea una sesión para ese usuario
            request()->session()->regenerate();

            return redirect('/home');
        }

        else return view('error_login');
    }

    /**
     * Método para cerrar sesión
     */
    public function logout(Request $request) {
        // Cierra la sesión
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Método para registrar usuarios
     */
    public function registrar(Request $request) {
        // Se recogen los datos del formulario
        $nombre = $request->nombre;
        $contrasenia = $request->pass;
        $repeContrasenia = $request->pass2;
        // Variables que se mandan a la vista en caso de que haya algún error
        $registrado = false;
        $noRepetida = false;
        $passCorta = false;

        // Comprueba si el usuario está ya registrado
        if (!is_null($usuarios = User::all())) {
            foreach ($usuarios as $usuario) {
                if ($nombre == $usuario->nombre) {
                    $registrado = true;
                    return view('error_registro', compact('registrado', 'noRepetida', 'passCorta'));
                }
            }
        }
        // Comprueba si la contraseña se ha repetido bien
        if ($contrasenia != $repeContrasenia) {
           $noRepetida = true;
        }
        // Comprueba si la contraseña tiene 8 caracteres o más
        if (strlen($contrasenia) < 8) {
            $passCorta = true;
        }
        // Si se cumple alguna de las condiciones anteriores, no podrá registrarse y se informa del error
        if ($noRepetida == true || $passCorta == true) {
            return view('error_registro', compact('registrado', 'noRepetida', 'passCorta'));
        }

        // Si todo está en orden, se registra el usuario en la BBDD
        else {
            $usuario = new User();
            $usuario->nombre = $nombre;
            $usuario->password = $contrasenia;
            // Encriptamos la contraseña en la base de datos
            $pass_fuerte = password_hash($contrasenia, PASSWORD_DEFAULT);
            $usuario->password = $pass_fuerte;
            $usuario->save();

            return view('login');
        }
    }
}
