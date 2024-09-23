<?php

namespace App\Http\Controllers\Auth;

use App\Models\Seguridad\User;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Password;
use Laravel\Fortify\Contracts\FailedPasswordResetLinkRequestResponse;
use Laravel\Fortify\Contracts\RequestPasswordResetLinkViewResponse;
use Laravel\Fortify\Contracts\SuccessfulPasswordResetLinkRequestResponse;
use Laravel\Fortify\Fortify;

final class PasswordResetLinkController extends Controller
{
    /**
     * Show the reset password link request view.
     */
    public function create(Request $request): RequestPasswordResetLinkViewResponse
    {
        return app(RequestPasswordResetLinkViewResponse::class);
    }

    /**
     * Send a reset link to the given user.
     */
    public function store(Request $request): Responsable
    {

        $request->validate(
            [
                'cedula' => ['required', 'exists:seguridad.users,cedula'],
                'captcha' => ['required', function ($attribute, $value, $fail) use (&$request) {
                    $captcha_value = captcha_check($request['captcha']);
                    if ($captcha_value === false) {
                        $fail('Captcha es invalido');
                    }
                }],
            ]
        );

        $email = User::select('email')->where('cedula', 'LIKE', $request->cedula)->first()->email;

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        /*         $status = $this->broker()->sendResetLink(
                    $request->only(Fortify::email())
                ); */

        $status = $this->broker()->sendResetLink(['cedula' => $request->cedula]);

        $email_mask = mask_email($email);

        $mensaje = "¡Le hemos enviado un correo electrónico a $email_mask con su enlace de restablecimiento de contraseña!";

        return $status == Password::RESET_LINK_SENT
                    ? app(SuccessfulPasswordResetLinkRequestResponse::class, ['status' => $mensaje])
                    : app(FailedPasswordResetLinkRequestResponse::class, ['status' => $status]);
    }

    /**
     * Get the broker to be used during password reset.
     */
    protected function broker(): PasswordBroker
    {
        return Password::broker(config('fortify.passwords'));
    }
}
