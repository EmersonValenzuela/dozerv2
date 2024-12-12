<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['login', 'authUser', 'logout']);
    }

    public function index()
    {
        if (Auth::check()) {
            return view('home');
        }

        return view('login.login'); // Vista de login si no está autenticado
    }

    public function login()
    {
        return view('login/login');
    }

    public function list()
    {
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

    public function userList()
    {
        $users = User::show();

        return response()->json(['data' => $users]);
    }
    public function insertUser(Request $request)
    {

        $user = new User();

        $user->name = $request->names;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();

        return response()->json([
            'icon' => 'success',
            'message' => 'Usuario agregado correctamente',
        ]);
    }

    public function updateUser(Request $request)
    {
        // Encuentra al usuario por su ID
        $user = User::find($request->user_id);

        if (!$user) {
            return response()->json([
                'icon' => 'error',
                'message' => 'Usuario no encontrado',
            ], 404);
        }

        // Actualiza los campos enviados
        $user->name = $request->names;
        $user->email = $request->email;

        // Si se envió una contraseña, actualízala; si no, deja la anterior
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }

        // Guarda los cambios
        $user->save();

        return response()->json([
            'icon' => 'success',
            'message' => 'Usuario actualizado correctamente',
        ]);
    }

    public function logout(Request $request)
    {
        // Cierra la sesión del usuario autenticado
        Auth::logout();

        // Opcional: invalida la sesión y regenera el token CSRF
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
