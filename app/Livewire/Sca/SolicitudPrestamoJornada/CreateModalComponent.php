<?php

namespace App\Livewire\Sca\SolicitudPrestamoJornada;

use App\Models\SCA\SolicitudPrestamoJornada;
use App\Models\SCA\SolicitudPrestamoJornadaDetalle;
use App\Models\SCA\SolicitudPrestamo;

use App\Models\SCA\TipoPrestamo;
use App\Models\SCA\Moneda;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;

//use App\Http\Requests\SCA\JonadaSolicitudPrestamo\StoreJornadaSolicitudPrestamoRequest;
//use App\Http\Requests\API\SCA\StoreDocumentoRequest;

use Livewire\Component;
use Livewire\Attributes\On;


use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class CreateModalComponent extends Component
{    
    public $isOpen=0;

    public $tiposPrestamos = "";
    public $monedas = "";

    public $postId=0;

    public $fecha_inicio;
    public $fecha_cierre;
    public $descripcion;
    public $observacion;
    public $tipo_prestamo_id;
    public $tipo_moneda;
    public $monto_tope;
    public $cuotas;



    public function formSp(){
        $this->openModal();
    }

    public function openModal(){
        $this->isOpen=true;
    }

    public function closeModal(){
        $this->postId=0;
        $this->fecha_inicio=date('Y-m-d');
        $this->fecha_cierre=date('Y-m-d');
        $this->descripcion='';
        $this->observacion='';
        $this->tipo_prestamo_id='';
        $this->tipo_moneda='';
        $this->monto_tope=0.00;
        $this->cuotas=0.00;
        $this->isOpen=false;
    }

    public function mount(){
        $this->fecha_inicio=date('Y-m-d');
        $this->fecha_cierre=date('Y-m-d');
        $this->descripcion='';
        $this->observacion='';
        $this->tipo_prestamo_id='';
        $this->tipo_moneda='';
        $this->monto_tope=0.00;
        $this->cuotas=0.00;
    }

    public function render(){
        $this->tiposPrestamos = TipoPrestamo::query()->activo()->orderBy('nombre')->get();
        $this->monedas = Moneda::query()->activo()->orderBy('abreviatura')->get();
        return view('livewire.sca.solicitud-prestamo-jornada.create-modal-component', [
                                                                                        'tiposPrestamos' => $this->tiposPrestamos,
                                                                                        'monedas' => $this->monedas
                                                                                    ]);
    }

    #[On('click-editarJSp')]
    public function edit($id){
        $query = SolicitudPrestamoJornada::query()->where('id','=',$id)->with('JornadaDetalle')->get();
        $this->postId = $id;
        $this->fecha_inicio=$query[0]->fecha_inicio;
        $this->fecha_cierre=$query[0]->fecha_cierre;
        $this->descripcion=$query[0]->nombre;
        $this->observacion=$query[0]->observacion;
        $this->tipo_prestamo_id=$query[0]->JornadaDetalle[0]->tipo_prestamo_id;
        $this->tipo_moneda=$query[0]->JornadaDetalle[0]->moneda_id;
        $this->monto_tope=$query[0]->JornadaDetalle[0]->monto_tope;
        $this->cuotas=$query[0]->JornadaDetalle[0]->cant_cuotas;
        $this->openModal();
    }

    public function store(Request $request){
        $this->validate([
            'fecha_inicio' => 'required|date',
            'fecha_cierre' => 'required|date|after:fecha_inicio',
            'descripcion' => ['required'],
            'tipo_prestamo_id' => ['required', 'exists:sca.tipos_prestamos,id', 'required'],
            'tipo_moneda'=> ['required', 'exists:sca.monedas,id', 'required'],
            'monto_tope' => ['required', 'integer', 'min:1'],
            'cuotas' => ['required', 'integer', 'min:1'],
            'observacion' => ['nullable', 'max:255']
        ], [
            'fecha_inicio.required' => 'Debe indicar Fecha de Inicio.',
            'fecha_cierre.required' => 'Debe indicar Fecha de Culminación.',
            'descripcion.required' => 'Debe indicar Descripción.',
            'tipo_prestamo_id.required' => 'Tipo de Prestamo Inválido.',
            'tipo_moneda.required' => 'Tipo de Moneda Inválida.',
            'monto_tope.required' => 'Debe indicar Monto maximo y mayor que 0.',
            'cuotas.required' => 'Debe indicar Números de Cuotas y mayor que 0.',
        ]);

        if ( $this->postId == 0){
            $jornada = SolicitudPrestamoJornada::create([
                'fecha_inicio' =>  $this->fecha_inicio,
                'fecha_cierre' => $this->fecha_cierre,
                'observacion' =>  $this->observacion,
                'nombre' => $this->descripcion,
                'status' => 0
            ]);

            SolicitudPrestamoJornadaDetalle::create([
                'jornada_solicitud_prestamo_id' => $jornada->id,
                'tipo_prestamo_id' => $this->tipo_prestamo_id,
                'moneda_id' => $this->tipo_moneda,
                'monto_tope' => $this->monto_tope,
                'cant_cuotas' => $this->cuotas
            ]);
            
            session()->flash('message', 'Jornada creada exitosamente.');
            $this->dispatch('msnJsp', ['mensaje'=>'Jornada creada exitosamente']);
            //$this->dispatchBrowserEvent('msnJsp',['msn' => 'Jornada Creada correctamente']); // Disparar un evento para actualizar la lista
        }else{
            $query = SolicitudPrestamoJornada::find($this->postId)->with('JornadaDetalle')->get();
            
            $query[0]->fecha_inicio =  $this->fecha_inicio;
            $query[0]->fecha_cierre = $this->fecha_cierre;
            $query[0]->observacion =  $this->observacion;
            $query[0]->nombre = $this->descripcion;
            $query[0]->update();

            $query[0]->JornadaDetalle[0]->tipo_prestamo_id = $this->tipo_prestamo_id;
            $query[0]->JornadaDetalle[0]->moneda_id = $this->tipo_moneda;
            $query[0]->JornadaDetalle[0]->monto_tope = $this->monto_tope;
            $query[0]->JornadaDetalle[0]->cant_cuotas = $this->cuotas;
            $query[0]->JornadaDetalle[0]->update();

            session()->flash('message', 'Jornada Modificada exitosamente.');
            $this->dispatch('msnJsp', ['mensaje'=>'Jornada Modificada correctamente']);            
        }

        $this->closeModal();
    }
}
