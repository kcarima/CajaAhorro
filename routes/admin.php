<?php

use App\Http\Controllers\SCA\BancosController;
use App\Http\Controllers\SCA\ConfiguracionesController;
use App\Http\Controllers\SCA\ConversionMonetariaController;
use App\Http\Controllers\SCA\CuentaBancariaController;
use App\Http\Controllers\SCA\DocumentoController;
use App\Http\Controllers\SCA\HistorialConversionMonetariaController;
use App\Http\Controllers\SCA\MonedasController;
use App\Http\Controllers\SCA\ParentescoController;
use App\Http\Controllers\SCA\ReconversionController;
use App\Http\Controllers\SCA\SolicitudIngresoController;
use App\Http\Controllers\SCA\SolicitudPrestamoController;
use App\Http\Controllers\SCA\SolicitudPrestamoJornadaController;
use App\Http\Controllers\SCA\TipoPrestamoController;
use App\Http\Controllers\SCA\TiposCuentasBancariasController;
use App\Http\Controllers\SCA\ConceptosController;
use App\Http\Controllers\SCA\CargaSinuController;
use App\Http\Controllers\Seguridad\BotsController;
use App\Http\Controllers\Seguridad\LogController;
use App\Http\Controllers\Seguridad\UsuariosController;
use App\Http\Controllers\UNEG\CargosController;
use App\Http\Controllers\UNEG\DepartamentosController;
use App\Http\Controllers\UNEG\RelacionesLaboralesController;
use App\Http\Controllers\UNEG\SedeController;
use App\Http\Controllers\UNEG\TiposTrabajadoresController;
use App\Http\Controllers\UNEG\ZonaController;
use Illuminate\Support\Facades\Route;

Route::controller(UsuariosController::class)->group(function () {
    Route::get('usuarios', 'index')->name('usuarios.index');
    Route::get('usuarios/crear', 'create')->name('usuarios.create');
    Route::post('usuarios/crear', 'store')->name('usuarios.store');
    Route::get('usuarios/editar/{cedula}', 'edit')->name('usuarios.edit');
    Route::post('usuarios/editar/{cedula:user}', 'update')->name('usuarios.update');
    Route::post('usuarios/password/reset', 'resetPassword')->name('usuarios.password.reset');
});

Route::controller(ConfiguracionesController::class)->group(function () {
    Route::get('configuraciones', 'index')->name('configuraciones.index');
    Route::post('configuracion/editar/{configuracion}', 'update')->name('configuraciones.update');
});

Route::controller(CargosController::class)->group(function () {
    Route::get('cargos', 'index')->name('cargos.index');
    Route::post('cargos/crear', 'store')->name('cargos.store');
    Route::post('cargos/editar/{cargo:codigo}', 'update')->name('cargos.update');
});

Route::controller(TiposTrabajadoresController::class)->group(function () {
    Route::get('tipos-trabajadores', 'index')->name('tipos-trabajadores.index');
    Route::post('tipos-trabajadores/crear', 'store')->name('tipos-trabajadores.store');
    Route::post('tipos-trabajadores/editar/{id}', 'update')->name('tipos-trabajadores.update');
});

Route::controller(DepartamentosController::class)->group(function () {
    Route::get('departamentos', 'index')->name('departamentos.index');
    Route::post('departamentos/crear', 'store')->name('departamentos.store');
    Route::post('departamentos/editar/{departamento:codigo}', 'update')->name('departamentos.update');
});

Route::controller(RelacionesLaboralesController::class)->group(function () {
    Route::get('relaciones-laborales', 'index')->name('relaciones-laborales.index');
    Route::post('relaciones-laborales/crear', 'store')->name('relaciones-laborales.store');
    Route::post('relaciones-laborales/editar/{id}', 'update')->name('relaciones-laborales.update');
});

Route::controller(TiposCuentasBancariasController::class)->group(function () {
    Route::get('tipos-cuentas', 'index')->name('tipos-cuentas.index');
    Route::post('tipos-cuentas/crear', 'store')->name('tipos-cuentas.store');
    Route::post('tipos-cuentas/editar/{id}', 'update')->name('tipos-cuentas.update');
});

Route::controller(BancosController::class)->group(function () {
    Route::get('bancos', 'index')->name('bancos.index');
    Route::post('bancos/crear', 'store')->name('bancos.store');
    Route::post('bancos/editar/{id}', 'update')->name('bancos.update');
});

Route::controller(MonedasController::class)->group(function () {
    Route::get('monedas', 'index')->name('monedas.index');
    Route::post('monedas/crear', 'store')->name('monedas.store');
    Route::post('monedas/editar/{uuid}', 'update')->name('monedas.update');
});

Route::controller(LogController::class)->group(function () {
    Route::get('log', 'index')->name('log.index');
    Route::get('log/{id}', 'show')->name('log.show');
});

Route::controller(BotsController::class)->group(function () {
    Route::get('bots/log', 'botLog')->name('bot-log.index');
    Route::get('bots/ip', 'blockIp')->name('block-ip.index');
});

Route::controller(CuentaBancariaController::class)->group(function () {
    Route::get('cuenta/bancaria', 'index')->name('cuenta-bancaria.index');
    Route::get('cuenta/bancaria/create', 'create')->name('cuenta-bancaria.create');
    Route::post('cuenta/bancaria', 'store')->name('cuenta-bancaria.store');
    Route::get('cuenta/bancaria/editar/{uuid}', 'edit')->name('cuenta-bancaria.edit');
    Route::patch('cuenta/bancaria/editar/{uuid}', 'update')->name('cuenta-bancaria.update');
});

Route::controller(ConversionMonetariaController::class)->group(function () {
    Route::get('conversion/monetaria', 'index')->name('conversion-monetaria.index');
    Route::get('conversion/monetaria/crear', 'create')->name('conversion-monetaria.create');
    Route::post('conversion/monetaria/crear', 'store')->name('conversion-monetaria.store');
    Route::get('conversion/monetaria/edit/{uuid}', 'edit')->name('conversion-monetaria.edit');
    Route::patch('conversion/monetaria/edit', 'store')->name('conversion-monetaria.update');
});

Route::get('conversion/monetaria/historial', HistorialConversionMonetariaController::class)->name('conversion-monetaria.historial.index');

Route::controller(ReconversionController::class)->group(function () {
    Route::get('reconversion', 'index')->name('reconversion.index');
    Route::get('reconversion/{tabla}', 'reconversion')->name('reconversion.get');
    Route::patch('reconversion/{tabla}', 'update')->name('reconversion.update');
});

Route::controller(TipoPrestamoController::class)->group(function () {
    Route::get('tipo-prestamo', 'index')->name('tipo-prestamo.index');
    Route::get('tipo-prestamo/crear', 'create')->name('tipo-prestamo.create');
    Route::post('tipo-prestamo/crear', 'store')->name('tipo-prestamo.store');
    Route::get('tipo-prestamo/edit/{tipo}', 'edit')->name('tipo-prestamo.edit');
    Route::patch('tipo-prestamo/edit/{tipo}', 'update')->name('tipo-prestamo.update');
});

Route::controller(ParentescoController::class)->group(function () {
    Route::get('parentesco', 'index')->name('parentesco.index');
    Route::post('parentesco/crear', 'store')->name('parentesco.store');
    Route::post('parentesco/editar/{id}', 'update')->name('parentesco.update');
});

Route::controller(SolicitudIngresoController::class)->group(function () {
    Route::get('solicitudes/ingreso', 'index')->name('solicitudes.ingresos.index');
});

Route::controller(SolicitudPrestamoController::class)->group(function () {
    Route::get('solicitud/prestamo', 'index')->name('solicitudes.prestamos.index');
});

Route::controller(SolicitudPrestamoJornadaController::class)->group(function () {
    Route::get('jornada/solicitud/prestamo', 'index')->name('solicitud.prestamo.jornada.index');
});

Route::controller(ConceptosController::class)->group(function () {
    Route::get('conceptos/', 'index')->name('conceptos.index');
});

Route::controller(CargaSinuController::class)->group(function () {
    Route::get('archivos-sinu/', 'index')->name('archivos-sinu.index');    
});



Route::controller(SedeController::class)->group(function () {
    Route::get('sedes', 'index')->name('sedes.index');
    Route::post('sede/crear', 'store')->name('sede.store');
    Route::post('sede/editar/{id}', 'update')->name('sede.update');
});

Route::controller(ZonaController::class)->group(function () {
    Route::get('zonas', 'index')->name('zonas.index');
    Route::post('zona/crear', 'store')->name('zona.store');
    Route::post('zona/editar/{id}', 'update')->name('zona.update');
});

Route::controller(DocumentoController::class)->group(function () {
    Route::get('documentos', 'index')->name('documentos.index');
    Route::post('documento/crear', 'store')->name('documento.store');
    Route::post('documento/editar/{id}', 'update')->name('documento.update');
});
