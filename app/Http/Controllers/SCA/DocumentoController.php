<?php

namespace App\Http\Controllers\SCA;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\SCA\StoreDocumentoRequest;
use App\Http\Requests\API\SCA\UpdateDocumentoRequest;
use App\Models\SCA\Documento;
use App\Traits\ApiResponse;
use Exception;

final class DocumentoController extends Controller
{
    use ApiResponse;

    public function index()
    {
        return view('sca.documentos.index');
    }

    public function store(StoreDocumentoRequest $request)
    {

        try {
            $documento = Documento::create([
                'nombre' => $request->nombre,
                'carpeta' => $request->carpeta,
            ]);
        } catch (Exception $e) {

            $mensaje = 'Error al crear el documento.';

            return $this->errorMessage(message: $mensaje, code: 500);
        }

        $mensaje = "Documento $documento->nombre creado satisfactoriamente.";

        return $this->successMessage(message: $mensaje, data: ['id' => $documento->uuid]);
    }

    public function update(UpdateDocumentoRequest $request, Documento $documento)
    {

        try {
            $documento->nombre = $request->nombre;
            $documento->carpeta = $request->carpeta;
            $documento->save();

        } catch (Exception $e) {

            $mensaje = 'Error al actualizar el documento.';

            return $this->errorMessage(message: $mensaje);
        }

        $mensaje = "Documento $documento->nombre actualizado satisfactoriamente.";

        return $this->successMessage(message: $mensaje);
    }
}
