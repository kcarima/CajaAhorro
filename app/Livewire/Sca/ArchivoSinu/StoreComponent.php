<?php

namespace App\Livewire\Sca\ArchivoSinu;
use App\Models\SCA\ArchivoSinu;
use App\Models\SCA\Socio;
use App\Models\SCA\conceptos;

use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class StoreComponent extends Component
{
    use WithFileUploads;
    public $isOpen      = 0;

    public $archivo_id   = 0;
    public $fecha       = '';
    public $descripcion = '';
    public $file;


    public function render()
    {
        return view('livewire.sca.archivo-sinu.store-component');
    }

    public function openModal(){
        if ( $this->archivo_id == 0 ){
            $this->fecha = Carbon::now()->format('Y-m-d');
        }
        $this->isOpen=true;
    }

    public function closeModal(){
        $this->isOpen=false;
    }

    public function store(Request $request){
        $this->validate([
            'fecha' => 'required|date',
            'descripcion' => ['required'],
            'file' => 'required|max:2048',
            //'file' => 'required|mimes:txt|max:2048',
        ], [
            'fecha.required' => 'Debe indicar Fecha.',
            'descripcion.required' => 'Debe indicar Descripción.',
            'file.required' => 'Debe Cargar un archivo .txt',
            //'file.mimes' => 'El archivo debe ser un .txt',
            //'file.max' => 'El tamaño máximo del Archivo debe ser de 2MB.',
        ]);

        session()->flash('message',  'Subiendo Archivo...');
        
        $query = ArchivoSinu::create([
            'fecha' => $this->fecha,
            'descripcion' => $this->descripcion,
            'status' => 0
        ]);
        $this->file->storeAs('txt', $query->id.'.txt');
        session()->flash('message',  'Cargando Archivo...');

        $contents = Storage::disk('txt')->get($query->id.'.txt');
        $lineas = explode("\n",trim($contents));
        $contador_nosocios = 0;
        $contador_noconcep = 0;
        foreach( $lineas as $linea ){
            $detalle_linea = explode(";",$linea);
            // Buscar el socio por su ficha
            $socio = Socio::where('ficha', $detalle_linea[1])->first();
            // Verificar si se encontró al socio
            if (!$socio) {                
                $contador_nosocios++;
            }
        
            // Verificar si se encontró el concepto
            $concepto = conceptos::where('codigo', $detalle_linea[4])->first();
            if (!$concepto) {
                $contador_noconcep++;
            }
        }
        dd("Cant NoSocios: $contador_nosocios, Cant. NoConceptos:  $contador_noconcep.");
    }
}
