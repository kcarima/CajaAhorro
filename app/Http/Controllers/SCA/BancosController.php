<?php

namespace App\Http\Controllers\SCA;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\SCA\Bancos\StoreBancoRequest;
use App\Http\Requests\API\SCA\Bancos\UpdateBancoRequest;
use App\Models\SCA\Banco;
use App\Traits\ApiResponse;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

final class BancosController extends Controller
{
    use ApiResponse;

    public function index()
    {
        return view('sca.bancos.index');
    }

    public function store(StoreBancoRequest $request)
    {

        try {
            $banco = Banco::create([
                'codigo' => $request->codigo,
                'nombre' => $request->nombre,
                'abreviatura' => $request->abreviatura,
            ]);
        } catch (Exception $e) {
            throw $e;

            return $this->errorMessage(message: 'Error al crear el banco');
        }

        return $this->successMessage(message: "Banco $banco->nombre creado correctamente", data: ['id' => $banco->uuid]);
    }

    public function update(UpdateBancoRequest $request, string $uuid)
    {

        try {
            $banco = Banco::where('uuid', $uuid)->firstOrFail();
            $banco->fill([
                'codigo' => $request->codigo,
                'nombre' => $request->nombre,
                'abreviatura' => $request->abreviatura,
            ]);
            $banco->save();
        } catch (ModelNotFoundException $e) {
            return $this->errorMessage(message: 'Banco no encontrado', code: 404);
        } catch (Exception $e) {
            throw $e;

            return $this->errorMessage(message: 'Hubo un error al actualizar el banco');
        }

        return $this->successMessage(message: 'Banco actualizado correctamente');
    }
}
