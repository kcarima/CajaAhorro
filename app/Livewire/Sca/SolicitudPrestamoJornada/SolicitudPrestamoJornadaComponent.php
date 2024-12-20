<?php

namespace App\Livewire\Sca\SolicitudPrestamoJornada;

use App\Models\SCA\SolicitudPrestamo;
use App\Models\SCA\SolicitudPrestamoJornada;
use App\Models\SCA\SolicitudPrestamoJornadaDetalle;


use Livewire\Attributes\Reactive;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class SolicitudPrestamoJornadaComponent extends Component
{
    use WithPagination;
    public $jornadas;

    #[Reactive]
    public $filtroBusqueda;

    public $mensaje;

    public function moun(){
        /*$this->listen('msnJsp', function ($mensaje) {
            //dd($mensaje);
            $this->render();
            //$this->jornadas = Jornada::all(); // Recargar las jornadas
            $this->mensaje = $mensaje;
            session()->flash('message', $this->mensaje);
            $this->showSuccessModal = true; // Mostrar un modal de éxito
        });*/
    }
    public function render()
    {
        /*$query = SolicitudPrestamoJornada::query()
                 ->with('JornadaDetalle')->select('id', 'jornada_solicitud_prestamo_id', 'tipo_prestamo_id', 'moneda_id', 'monto_tope', 'cant_cuotas', 'status')
                 ->orderBy('fecha_cierre','DESC')->paginate(15);*/

        //$this->jornadas = SolicitudPrestamoJornada::orderBy('fecha_cierre', 'DESC')->get();
        //$this->jornadas = $this->buscar();

        $this->jornadas = SolicitudPrestamoJornada::query()
                            ->wherehas('JornadaDetalle', function($query){
                                $query->select('id', 'jornada_solicitud_prestamo_id', 'tipo_prestamo_id', 'moneda_id', 'monto_tope', 'cant_cuotas', 'status');
                             })
                            ->orderBy('fecha_cierre','DESC')->get();
        return view('livewire.sca.solicitud-prestamo-jornada.solicitud-prestamo-jornada-component', ['jornadas' => $this->jornadas]);
    }

    public function editarJSp($id){
        $this->dispatch('click-editarJSp', id: $id);
    }

    public function eliminarJSp($id){
        //$query = SolicitudPrestamoJornada::query()->where('id','=',$id)->with('JornadaDetalle')->get();
        $query = SolicitudPrestamoJornada::find($id)->with('JornadaDetalle')->get();
        if ($query[0]) {
            // Valida que no existan solicitudes de prestamos asociadas a la jornada a eliminar.
            $count = SolicitudPrestamo::where('id', $query[0]->JornadaDetalle[0]->id)->count();
            if ($count === 0) {
                $query[0]->JornadaDetalle[0]->delete();
                $query[0]->delete();
                session()->flash('success',  'Registro eliminado correctamente');
            }else{
                session()->flash('error',  'Error: Existen solicitudes asociadas!');
            }
            // Aquí puedes agregar lógica adicional, como mostrar un mensaje de éxito o redirigir a otra página
        } else {
            // Manejar el caso en el que no se encontró el registro
            session()->flash('error',  'Error: Solicitud no encontrada!');
        }
    }

    public function countActive($id)
    {        
        return SolicitudPrestamoJornada::where('status', '=', '1')
                                ->where('id', '!=', $id)
                                ->count();
    }

    public function activarJSp($id){
        $query = SolicitudPrestamoJornada::find($id);
        if ($query) {
            $activeRequestsCount = $this->countActive($id);            
            if ($activeRequestsCount == 0) {
                // Valida que no existan otras jornadas activas.
                $query->status =  1;
                $query->update();
                session()->flash('success',  'Registro Activado correctamente');            
            }else{
                // Manejar si ya existe una jornada activa
                session()->flash('error',  'Error: Ya existe una jornada Activa!');
            }            
        } else {
            // Manejar el caso en el que no se encontró el registro
            session()->flash('error',  'Error: Solicitud no encontrada!');
        }
    }

    public function desactivarJSp($id){
        $query = SolicitudPrestamoJornada::find($id);
        if ($query) {
            // Valida que no existan solicitudes de prestamos asociadas a la jornada a eliminar.
            $query->status =  0;
            $query->update();
            session()->flash('success',  'Registro Desactivado correctamente');            
        } else {
            // Manejar el caso en el que no se encontró el registro
            session()->flash('error',  'Error: Solicitud no encontrada!');
        }
    }

    #[On('msnJsp')]
    public function handleMsnJsp($mensaje)
    {
        // Aquí puedes utilizar los valores de $id y $nombre
        $this->mensaje=$mensaje['mensaje'];

        // Actualizar la vista
        session()->flash('success',  $this->mensaje);
        $this->render();
    }

    public function buscar()
    {
        $query = SolicitudPrestamoJornada::query();

        
        $query->wherehas('JornadaDetalle', function($query){
                              $query->select('id', 'jornada_solicitud_prestamo_id', 'tipo_prestamo_id', 'moneda_id', 'monto_tope', 'cant_cuotas', 'status');
                       })                  

        ->when($this->filtroBusqueda['estatus'], function ($query) {
            if ($this->filtroBusqueda['estatus'] != ''){
                $query->where('status', $this->filtroBusqueda["estatus"]);
            }
        })
        ->orderBy('fecha_cierre','DESC')->paginate(2);
        return $query->paginate(2);
    }
}
