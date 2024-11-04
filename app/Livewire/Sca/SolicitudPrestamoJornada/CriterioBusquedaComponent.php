<?php

namespace App\Livewire\Sca\SolicitudPrestamoJornada;
use App\Models\SCA\TipoPrestamo;
use App\Models\SCA\Moneda;
//

use Livewire\Component;

class CriterioBusquedaComponent extends Component
{
    public $fechaActual;

    public $filtroBusqueda = [        
        'estatus' => ''
    ];

    public $tiposPrestamos = "";
    public $monedas = "";

    public function mount(){
        $this->fechaActual = date('Y-m-d');
        $this->filtroBusqueda['estatus']='';        
    }

    public function render(){
        $this->tiposPrestamos = TipoPrestamo::query()->orderBy('nombre')->get();
        $this->monedas = Moneda::query()->orderBy('abreviatura')->get();
        return view('livewire.sca.solicitud-prestamo-jornada.criterio-busqueda', [
                                                                            'tiposPrestamos' => $this->tiposPrestamos,
                                                                            'filtroBusqueda' => $this->filtroBusqueda,
                                                                            'monedas' => $this->monedas
                                                                         ]);
    }


}
