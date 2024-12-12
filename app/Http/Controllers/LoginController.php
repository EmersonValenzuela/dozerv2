<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index()
    {
        return view('login/login');
    }

    public function list(){
        return view('user/index');
    }

    public function authUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'icon' => 'error',
                'message' => 'El formulario no es válido',
            ]);
        }

        $email = $request->email;
        $password = $request->password;

        // Verificar si el usuario existe
        $user = User::where('email', $email)->first();
        if (!$user) {
            return response()->json([
                'icon' => 'error',
                'message' => 'El usuario no existe',
            ]);
        }

        // Verificar si la contraseña coincide
        if (!Hash::check($password, $user->password)) {
            return response()->json([
                'icon' => 'error',
                'message' => 'Contraseña incorrecta',
            ]);
        }

        // Intentar autenticación
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            return response()->json([
                'icon' => 'success',
                'message' => 'Usuario autenticado',
            ]);
        }

        return response()->json([
            'icon' => 'error',
            'message' => 'Usuario no autenticado por otro motivo',
        ]);
    }
}
