<?php

namespace App\Http\Controllers\SCA;

use App\Http\Controllers\Controller;
use App\Models\SCA\Configuracion;
use App\Traits\ApiResponse;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

final class ConfiguracionesController extends Controller
{
    use ApiResponse;

    public function index()
    {

        if(auth()->user()->is_root()) {
            $configuraciones = Configuracion::orderBy('id')->get(['id', 'clave', 'valor', 'tipo', 'updated_at']);
        } else {
            $configuraciones = Configuracion::where('is_public', '=', true)->orderBy('id')->get(['id', 'clave', 'valor', 'tipo', 'updated_at']);
        }


        return view('sca.configuraciones.index', compact('configuraciones'));
    }

    public function update(Configuracion $configuracion, Request $request)
    {

        $data = [];

        try {

            if(!$configuracion->is_public && !auth()->user()->is_root()) {
                return $this->errorMessage(message: 'Error al actualizar la configuración.', code: 403);
            }

            if ($request->hasFile('valor')) {

                $archivo = get_nombre_archivo($request->valor->getClientOriginalName());

                $path = $request->valor->storeAs('configuraciones', $archivo);

                if (Storage::fileExists($configuracion->valor)) {
                    Storage::delete($configuracion->valor);
                }

                $configuracion->valor = $path;

                $data = ['url' => Storage::url($path), 'archivo' => $path];

            } else {
                $configuracion->valor = $request->valor;
            }

            $configuracion->save();

        } catch (Exception $e) {

            return $this->errorMessage(message: 'Error al actualizar la configuración. Por favor intente de nuevo', code: 400);

        }

        return $this->successMessage(data: $data, message: 'Configuración actualizada satisfactoriamente');
    }
}
