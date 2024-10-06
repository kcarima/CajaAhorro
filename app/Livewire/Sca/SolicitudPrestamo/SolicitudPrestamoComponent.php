<?php

namespace App\Livewire\Sca\SolicitudPrestamo;

use App\Models\SCA\SolicitudPrestamo;


use Livewire\Attributes\Reactive;
use Livewire\Component;
use Livewire\WithPagination;

class SolicitudPrestamoComponent extends Component
{

    use WithPagination;

    #[Reactive]
    public $filtroBusqueda;

    public $resultado;

    public function render()
    {
        $solicitudes = $this->buscar();//BuscarSolicitudPrestamo::handle($this->busqueda);
        return view('livewire.sca.solicitud-prestamo.solicitud-prestamo-component', ['solicitudes' => $solicitudes]);
    }

    public function buscar()
    {
        $query = SolicitudPrestamo::query();

        $query->when($this->filtroBusqueda['fecha_solicitud_desde'], function ($query) {
            if ($this->filtroBusqueda['fecha_solicitud_desde'] != ''){
                $query->where('fecha_solicitud', '>=',$this->filtroBusqueda["fecha_solicitud_desde"])
                      ->where('fecha_solicitud', '<=',$this->filtroBusqueda["fecha_solicitud_hasta"]);
            }
        })

        ->when($this->filtroBusqueda['tipo_prestamo'], function ($query) {
            if ($this->filtroBusqueda['tipo_prestamo'] != ''){
                $query->where('tipo_prestamo', $this->filtroBusqueda["tipo_prestamo"]);
            }
        })

        ->when($this->filtroBusqueda['moneda'], function ($query) {
            if ($this->filtroBusqueda['moneda'] != ''){
                $query->where('moneda', $this->filtroBusqueda["moneda"]);
            }
        })

        ->when($this->filtroBusqueda['estatus'], function ($query) {
            if ($this->filtroBusqueda['estatus'] != ''){
                $query->where('status', $this->filtroBusqueda["estatus"]);
            }
        })

        ->with('TipoPrestamo')
        ->with('Moneda')
        ->wherehas('socio', function($query){
            if ($this->filtroBusqueda['socio'] != ''){
                $query->where('ficha','ilike', '%'.$this->filtroBusqueda["socio"].'%')
                      ->orWhere('cedula', 'ilike', '%' . $this->filtroBusqueda["socio"] . '%')
                      ->orWhere('nombre', 'ilike', '%' . $this->filtroBusqueda["socio"] . '%');
            }
        })
        ->orderBy('fecha_solicitud','DESC')->paginate(2);
        return $this->resultado = $query->get();
    }

}

