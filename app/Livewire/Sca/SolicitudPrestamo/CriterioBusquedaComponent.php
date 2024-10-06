<?php

namespace App\Livewire\Sca\SolicitudPrestamo;
use App\Models\SCA\TipoPrestamo;
use App\Models\SCA\Moneda;
//

use Livewire\Component;

class CriterioBusquedaComponent extends Component
{
    public $fechaActual;

    public $filtroBusqueda = [
        'fecha_solicitud_desde' => '',
        'fecha_solicitud_hasta' => '',
        'tipo_prestamo' => '',
        'socio' => '',
        'moneda' => '',
        'estatus' => ''
    ];

    public $tiposPrestamos = "";
    public $monedas = "";

    public function mount(){
        $this->fechaActual = date('Y-m-d');
        $this->filtroBusqueda['fecha_solicitud_desde']=$this->fechaActual;
        $this->filtroBusqueda['fecha_solicitud_hasta']=$this->fechaActual;
    }

    public function render(){
        $this->tiposPrestamos = TipoPrestamo::query()->orderBy('nombre')->get();
        $this->monedas = Moneda::query()->orderBy('abreviatura')->get();
        return view('livewire.sca.solicitud-prestamo.criterio-busqueda', [
                                                                            'tiposPrestamos' => $this->tiposPrestamos,
                                                                            'filtroBusqueda' => $this->filtroBusqueda,
                                                                            'monedas' => $this->monedas
                                                                         ]);
    }
}
