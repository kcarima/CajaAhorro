<?php

namespace App\Livewire\Sca\Conceptos;

use Livewire\Component;

class CriterioBusquedaComponent extends Component
{
    public $filtroBusqueda = [
        'descripcion' => '',
        'estatus' => ''
    ];

    public function render()
    {
        return view('livewire.sca.conceptos.criterio-busqueda-component');
    }

    public function updatedFiltroBusqueda(){
        $this->dispatch('busca-concepto', filtro: $this->filtroBusqueda);        
    }
}
