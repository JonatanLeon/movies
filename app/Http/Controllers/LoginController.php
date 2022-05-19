<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function login(Request $request) {

        $nombre = $request->nombre;
        $contrasenia = $request->pass;
        $validado = false;

        $usuarios = User::all();
            foreach ($usuarios as $user) {
                // Desencriptamos la contraseña para ver si coincide con la introducida
                if ($nombre == $user->nombre && (password_verify($contrasenia, $user->pass))) {
                    $validado = true;
                }
            }

        if ($validado) {
            $request->session()->regenerate();
            return redirect()->intended('/home');
        }
        else return redirect('/login');

    }


    public function registrar(Request $request) {
        $nombre = $request->nombre;
        $contrasenia = $request->pass;
        $repeContrasenia = $request->pass2;
        $registrado = false;
        $noRepetida = false;
        $corta = false;
        if (!is_null($usuarios = User::all())) {
            foreach ($usuarios as $usuario) {
                if ($nombre == $usuario->nombre) {
                    $registrado = true;
                    return view('error_registro', compact('registrado', 'noRepetida', 'corta'));
                }
            }
        }

            if ($contrasenia != $repeContrasenia) {
                $noRepetida = true;
                return view('error_registro', compact('registrado', 'noRepetida', 'corta'));
            }
            // Y luego se comprueba que la contraseña tenga 8 caracteres o mas
            else if (strlen($contrasenia) < 8) {
                $corta = true;
                return view('error_registro', compact('registrado', 'noRepetida', 'corta'));
            }
            else {
                // Y si coinciden se registrara al usuario en la base de  datos
                $usuario = new User();
                $usuario->nombre = $nombre;
                $usuario->pass = $contrasenia;
                // Encriptamos la contraseña en la base de datos
                $pass_fuerte = password_hash($contrasenia, PASSWORD_DEFAULT);
                $usuario->pass = $pass_fuerte;
                $usuario->save();

                return view('login');
            }
    }
}
