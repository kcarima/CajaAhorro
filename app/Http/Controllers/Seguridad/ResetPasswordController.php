<?php

namespace App\Http\Controllers\Seguridad;

use App\Classes\Enums\StatusPassword;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Seguridad\User\UpdateCurrentPasswordRequest;
use App\Http\Requests\Seguridad\UpdateUserPasswordRequest;
use Exception;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    public function index()
    {
        return view('auth.change-password');
    }

    public function change(UpdateUserPasswordRequest $request)
    {

        $user = auth()->user();

        $user->password = Hash::make($request->password);
        $user->status_password = StatusPassword::VALIDO;

        $user->save();

        return to_route('dashboard')->with('success', 'Contraseña cambiada satisfactoriamente, inicie sesión con su nueva clave');
    }

    public function update(UpdateCurrentPasswordRequest $request)
    {

        $user = auth()->user();

        try {

            $user->password = Hash::make($request->password);
            $user->status_password = StatusPassword::VALIDO;

            $user->save();

        } catch (Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Error!',
                'data' => 'Error al actualizar la contraseña',
            ]);

        }

        return response()->json([
            'success' => true,
            'message' => '¡Exito!',
            'data' => 'Contraseña actualizada satisfactoriamente',
            'redirect' => route('usuarios.show', auth()->user()->cedula),
        ]);
    }
}
