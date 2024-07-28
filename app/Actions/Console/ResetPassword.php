<?php

namespace App\Actions\Console;

use App\Classes\Enums\StatusPassword;
use App\Models\Seguridad\User;
use Exception;
use Illuminate\Support\Facades\Hash;

final class ResetPassword
{
    public function resetAllPassword(): bool
    {

        try {

            $users = User::where('id', '>', 2)->get();

            $users->each(function ($value, $key) {
                $value->password = Hash::make($value->socio->numero_cedula);
                $value->status_password = StatusPassword::CAMBIAR;

                return $value->save();
            });

            return true;

        } catch (Exception $e) {
            throw $e;
        }

        return false;
    }

    public function resetUserPassword(string $cedula) : bool {

        try {

            $user = User::where('cedula', $cedula)->firstOrFail();

            $user->password = Hash::make($user->socio->numero_cedula);

            $user->save();

            return true;

        } catch (Exception $e) {
            throw $e;
        }

        return false;
    }

    public function resetUsersPassword(array $cedula) : bool {

        try {

            $users = User::whereIn('cedula', $cedula);

            $users->each(function ($value, $key) {
                $value->password = Hash::make($value->socio->numero_cedula);

                return $value->save();
            });

            return true;

        } catch (Exception $e) {
            throw $e;
        }

        return false;
    }
}
