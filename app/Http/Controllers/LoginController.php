<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Usuario;

class LoginController extends Controller
{
    public function login(Request $request) {
        $nombre = $request->nombre;
        $contrasenia = $request->pass;
        $validado = false;

        $usuarios = Usuario::all();
            foreach ($usuarios as $user) {
                // Desencriptamos la contraseña para ver si coincide con la introducida
                if ($nombre == $user->nombre && (password_verify($contrasenia, $user->pass))) {
                    $validado = true;
                    $request->session()->regenerate();
                    echo "redirigido";
                    return redirect()->intended('/');
                }
            }

        if ($validado) {
            return view('home', compact('nombre'));
        }
        else return view('login', compact('validado'));
    }


    public function registrar(Request $request) {
        $nombre = $request->nombre;
        $contrasenia = $request->pass;
        $repeContrasenia = $request->pass2;
        $registrado = false;
        $repetida = false;
        $corta = false;

        if (!is_null($usuarios = Usuario::all())) {
            foreach ($usuarios as $usuario) {
                if ($nombre == $usuario->nombre) {
                    $registrado = true;

                }
            }
        }
        if ($registrado) return view('registro', compact('registrado'));

        else {
            if ($contrasenia != $repeContrasenia) return view('registro', compact('repetida'));
            // Y luego se comprueba que la contraseña tenga 8 caracteres o mas
            else if (strlen($contrasenia) < 8) return view('registro', compact('corta'));
            else {
                // Y si coinciden se registrara al usuario en la base de  datos
                $usuario = new Usuario();
                $usuario->nombre = $nombre;
                $usuario->pass = $contrasenia;
                // Encriptamos la contraseña en la base de datos
                $pass_fuerte = password_hash($contrasenia, PASSWORD_DEFAULT);
                $usuario->pass = $pass_fuerte;
                $usuario->save();

                return view('login');
                //echo "usuario ".$usuario->nombre." registrado";
                //return view('home');
            }
        }
    }
}
