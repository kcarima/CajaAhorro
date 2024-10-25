<?php

use App\Http\Controllers\SCA\SolicitudIngresoController;
use App\Http\Controllers\SCA\SolicitudPrestamoJornadaController;
use App\Http\Controllers\Seguridad\ResetPasswordController;
use App\Http\Controllers\Seguridad\UsuariosController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'password.verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::post('/reload_captcha',
    fn () => response()->json(['captcha' => captcha_img('flat')]))
    ->middleware('throttle:30');

Route::controller(UsuariosController::class)->middleware(['auth', 'user.profile', 'password.verified'])->group(function () {
    Route::get('/usuario/{user:cedula}', 'show')->name('usuarios.show');
    Route::get('/usuarios/editar/{user:cedula}', 'editUser')->name('usuario.user.edit');
    Route::post('/usuarios/editar/{user:cedula}', 'updateUser')->name('usuario.user.update');

});

Route::controller(ResetPasswordController::class)->middleware(['auth'])->group(function () {

    Route::get('/reiniciar/password', 'index')->name('reiniciar.password');
    Route::post('/reiniciar/password', 'change')->name('reinicializar.password');
    Route::post('/password/update', 'update')->name('password.user');

});

Route::controller(SolicitudIngresoController::class)->group(function () {
    Route::get('solicitud/afiliación', 'create')->name('solicitud.ingreso.create');
    Route::post('solicitud/ingreso', 'store')->name('solicitud.ingreso.store');
});

Route::controller(SolicitudPrestamoController::class)->group(function () {
    Route::post('solicitud/prestamo', 'create')->name('solicitud.prestamo.create');
    Route::post('solicitud/prestamo', 'store')->name('solicitud.prestamo.store');
});

Route::controller(SolicitudPrestamoJornadaController::class)->group(function () {
    Route::get('jornada/solicitud/prestamo', 'create')->name('jornada.solicitud.prestamo.create');
    Route::post('jornada/solicitud/prestamo', 'store')->name('jornada.solicitud.prestamo.store');
});

use Barryvdh\DomPDF\Facade\Pdf;

Route::get('wololo', function () {
    $pdf = Pdf::loadView('planillas.beneficiarios');
    return $pdf->download('invoice.pdf');
    return view('planillas.beneficiarios');
});
