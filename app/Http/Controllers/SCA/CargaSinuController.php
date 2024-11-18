<?php

namespace App\Http\Controllers\SCA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CargaSinuController extends Controller
{
    public $path;

    public function index()
    {
        return view('sca.archivo-sinu.index');
    }

    public function store(Request $request){
        $request->validate([
            'file' => 'required|mimes:txt|max:2048', // Ajusta el tamaño máximo según tus necesidades
        ]);

        $this->path = $request->file('file')->store('app/txt', 'private');

        /* Leer el contenido del archivo (opcional)
        $contents = Storage::disk('public')->get($path);

        // Hacer algo con el contenido del archivo, por ejemplo, guardarlo en la base de datos
        // ...*/

        return redirect()->back()->with('success', 'Archivo subido correctamente');
    }

}
