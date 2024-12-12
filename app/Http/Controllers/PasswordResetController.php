<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PasswordResetController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['showResetForm', 'resetPassword']);
    }


    public function showResetForm($token)
    {

        // Verificar si el token existe en la base de datos
        $reset = DB::table('password_resets')->where('token', $token)->first();

        if (!$reset) {
            // Si el token no es válido, redirigir con error
            return redirect()->route('login')->with('error', 'Token de restablecimiento no válido.');
        }

        // Si el token es válido, pasar el token a la vista
        return view('login.reset', compact('token'));
    }

    public function resetPassword(Request $request)
    {
        // Obtener el token y la nueva contraseña
        $token = $request->token;
        $newPassword = $request->password;

        // Buscar el registro de restablecimiento de contraseña
        $reset = DB::table('password_resets')->where('token', $token)->first();

        if (!$reset) {
            return redirect()->route('login')->with('error', 'Token de restablecimiento no válido.');
        }

        // Actualizar la contraseña del usuario
        $user = User::where('email', $reset->email)->first();
        $user->password = Hash::make($newPassword);
        $user->save();

        // Eliminar el registro de restablecimiento del token
        DB::table('password_resets')->where('token', $token)->delete();

        return redirect()->route('login')->with('success', 'Contraseña restablecida correctamente.');
    }
}
