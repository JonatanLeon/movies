<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function login(Request $request) {


        $credentials = request()->only('nombre', 'password');

        if(Auth::attempt($credentials)) {
            request()->session()->regenerate();

            return redirect('/home');
        }

        else return view('error_login');
    }

    public function logout(Request $request) {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/');
    }


    public function registrar(Request $request) {
        $nombre = $request->nombre;
        $contrasenia = $request->pass;
        $repeContrasenia = $request->pass2;
        $registrado = false;
        $noRepetida = false;
        $passCorta = false;
        if (!is_null($usuarios = User::all())) {
            foreach ($usuarios as $usuario) {
                if ($nombre == $usuario->nombre) {
                    $registrado = true;
                    return view('error_registro', compact('registrado', 'noRepetida', 'passCorta'));
                }
            }
        }

            if ($contrasenia != $repeContrasenia) {
                $noRepetida = true;
            }

            if (strlen($contrasenia) < 8) {
                $passCorta = true;
            }

            if ($noRepetida == true || $passCorta == true) {
                return view('error_registro', compact('registrado', 'noRepetida', 'passCorta'));
            }
            else {
                // Y si coinciden se registrara al usuario en la base de  datos
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
