<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['login', 'authUser', 'logout', 'recover', 'validateMail', 'confirm']);
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

    public function deleteUser($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Usuario no encontrado',
            ], 404);
        }

        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'Usuario eliminado correctamente',
        ]);
    }


    public function recover()
    {
        return view('login.recover');
    }

    public function validateMail(Request $request)
    {
        try {
            $email = $request->email;

            // Buscar al usuario por correo electrónico
            $user = User::where('email', $email)->first();

            // Verificar si el usuario existe
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'icon' => 'error',
                    'message' => 'Usuario no encontrado',
                ], 404);
            }

            // Generar un token único
            $token = Str::random(60);

            // Guardar el token en la base de datos (tabla de restablecimiento de contraseñas)
            DB::table('password_resets')->updateOrInsert(
                ['email' => $email],
                [
                    'email' => $email,
                    'token' => $token,
                    'created_at' => now(),
                ]
            );

            // Enviar correo al usuario con el token
            Mail::send('mails.reset-password', ['token' => $token], function ($message) use ($email) {
                $message->to($email)->subject('Restablecer contraseña');
            });

            session(['email' => $email]);

            return redirect()->route('confirm');
        } catch (\Exception $e) {
            // Registra el error en el archivo de log de Laravel
            Log::error('Error en el proceso de validación de correo: ' . $e->getMessage());

            // También puedes devolver el error como respuesta JSON o en una vista
            return response()->json([
                'success' => false,
                'icon' => 'error',
                'message' => 'Ocurrió un error en el proceso',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    public function confirm()
    {
        // Recuperar el email desde la sesión
        $email = session('email');

        // Verificar si el correo está en la sesión
        if (!$email) {
            return redirect()->route('login')->with('error', 'No se encontró el correo electrónico.');
        }

        // Devolver la vista con el correo
        return view('login.confirm', compact('email'));
    }
}
