<?php

namespace App\Livewire\Sca\ArchivoSinu;

use Livewire\Component;

class CriterioBusquedaComponent extends Component
{
    public $filtroBusqueda = [
        'descripcion' => '',
        'estatus' => ''
    ];

    public function render(){        
        return view('livewire.sca.archivo-sinu.criterio-busqueda-component');
    }

    public function updatedFiltroBusqueda(){
        $this->dispatch('busca-archivos', filtro: $this->filtroBusqueda);        
    }
}
