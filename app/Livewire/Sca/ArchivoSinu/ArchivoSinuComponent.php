<?php

namespace App\Livewire\Sca\ArchivoSinu;
use App\Models\SCA\archivoSinu;
use App\Models\SCA\archivo_sinu_detalle;
use Livewire\Attributes\On;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;

class ArchivoSinuComponent extends Component
{   

    public $filtroBusqueda = [
        'descripcion' => '',
        'estatus' => ''
    ];

    public function render()
    {
        $archivos = $this->buscar();
        return view('livewire.sca.archivo-sinu.archivo-sinu-component',['archivos' => $archivos]);
    }

    #[On('busca-archivos')]
    public function refrescaArchivos($filtro){
        $this->filtroBusqueda=$filtro;
        //$this->dispatch('refresh-listeners');
    }

    public function buscar(){
        $query = archivoSinu::query();
        $query->when($this->filtroBusqueda['descripcion'], function ($query) {
            if ($this->filtroBusqueda['descripcion'] != ''){
                $query->where('descripcion', 'ilike','%'.$this->filtroBusqueda["descripcion"].'%');
            }
        })

        ->when($this->filtroBusqueda['estatus'], function ($query) {
            if ($this->filtroBusqueda['estatus'] != ''){
                $query->where('status', $this->filtroBusqueda["estatus"]);
            }
        })

        ->orderBy('fecha','desc')
        ->orderBy('created_at', 'desc')->paginate(15);
        return $query->paginate(15);
    }

    #[On('msnArchivo')]
    public function msnArchivo($msn){
        session()->flash('success',  $msn['mensaje']);
        //$this->dispatch('$refresh');
    }

    public function eliminar($id){
        Storage::disk('txt')->delete($id.'.txt');
        $query = archivoSinu::find($id);
        $query->delete();
        session()->flash('success',  'Registro eliminado correctamente');
    }
}
