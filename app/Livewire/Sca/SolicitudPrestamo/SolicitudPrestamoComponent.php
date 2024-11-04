<?php

namespace App\Livewire\Sca\SolicitudPrestamo;

use App\Models\SCA\SolicitudPrestamo;


use Livewire\Attributes\Reactive;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class SolicitudPrestamoComponent extends Component
{

    use WithPagination;

    #[Reactive]
    public $filtroBusqueda;

    public $resultado;

    public function render()
    {
        $solicitudes = $this->buscar();
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
            
                $query->where('id','=',auth()->user()->id);
            
        })
        ->orderBy('fecha_solicitud','DESC')->paginate(15);
        return $query->paginate(15);
    }

    public function editarSp($id){
        $this->dispatch('click-editarSp', id: $id);
    }

    #[On('msnSp')]
    public function handleMsnJsp($mensaje)
    {
        // Aquí puedes utilizar los valores de $id y $nombre
        $this->mensaje=$mensaje['mensaje'];

        // Actualizar la vista
        session()->flash('success',  $this->mensaje);
        $this->render();
    }

    public function eliminarSp($id){
        //$query = SolicitudPrestamoJornada::query()->where('id','=',$id)->with('JornadaDetalle')->get();
        $query = SolicitudPrestamo::find($id);
        if ($query) {
            $query->delete();            
            session()->flash('success',  'Registro eliminado correctamente');            
        } else {
            // Manejar el caso en el que no se encontró el registro
            session()->flash('error',  'Error: Solicitud no encontrada!');
        }
    }
}

