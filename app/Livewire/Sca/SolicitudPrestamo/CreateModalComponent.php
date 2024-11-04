<?php

namespace App\Livewire\Sca\SolicitudPrestamo;

use App\Models\SCA\SolicitudPrestamoJornada;
use App\Models\SCA\SolicitudPrestamo;
use App\Models\SCA\TipoPrestamo;
use App\Models\SCA\Moneda;

use Livewire\Component;
use Livewire\Attributes\On;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CreateModalComponent extends Component
{
    public $isOpen=0;

    public $tiposPrestamos = "";
    public $monedas = "";
    public $jornada;    

    public $postId=0;
    public $fs_jornada_detalle_id;
    public $fs_tipo_prestamo;
    public $fs_moneda_id;
    public $fs_cant_cuotas;
    public $fs_fecha_solicitud;
    public $fs_socio_id;
    public $fs_monto_tope;
    public $fs_monto=1;

    public $fs_jornada_nombre;
    public $fs_moneda_nombre;
    public $fs_tp_nombre;
    
    public function formSp(){
        $this->openModal();
    }

    public function openModal(){
        $this->isOpen=true;
    }

    public function closeModal(){
        $this->postId=0;
        $this->fs_jornada_detalle_id='';
        $this->fs_tipo_prestamo='';
        $this->fs_moneda_id='';
        $this->fs_cant_cuotas='';
        $this->fs_fecha_solicitud='';
        $this->fs_socio_id='';
        $this->fs_monto=0;
        $this->fs_jornada_nombre = '';
        $this->fs_moneda_nombre = '';

        $this->isOpen=false;
    }    

    public function inicializaVariablesCreate($jornada){ 
        //dd($jornada);       
        $this->fs_jornada_detalle_id=$jornada[0]->jornadaDetalle[0]->id;
        $this->fs_tipo_prestamo=$jornada[0]->jornadaDetalle[0]->TipoPrestamo->id;
        $this->fs_tp_nombre=$jornada[0]->jornadaDetalle[0]->TipoPrestamo->nombre;
        $this->fs_moneda_id=$jornada[0]->jornadaDetalle[0]->Moneda->id;
        $this->fs_cant_cuotas=$jornada[0]->jornadaDetalle[0]->cant_cuotas;
        $this->fs_monto_tope=$jornada[0]->jornadaDetalle[0]->monto_tope;
        $this->fs_fecha_solicitud=Carbon::now()->format('Y-m-d');
        $this->fs_socio_id=auth()->user()->id;
        $this->fs_monto=0;

        $this->fs_jornada_nombre = $jornada[0]->jornadaDetalle[0]->SolicitudPrestamoJornada->nombre;
        $this->fs_moneda_nombre = $jornada[0]->jornadaDetalle[0]->Moneda->abreviatura;
    }

    public function render(){            
        $this->tiposPrestamos = TipoPrestamo::query()->orderBy('nombre')->get();
        $this->monedas = Moneda::query()->orderBy('abreviatura')->get();
        $this->jornada = SolicitudPrestamoJornada::Activo()
                                                   ->with('jornadaDetalle.SolicitudPrestamoJornada')
                                                   ->with('jornadaDetalle.TipoPrestamo')
                                                   ->with('jornadaDetalle.Moneda')
                                                   ->get();
        if ($this->postId == 0){
            $this->inicializaVariablesCreate($this->jornada);   
        }
        return view('livewire.sca.solicitud-prestamo.create-modal-component', ['tiposPrestamos' => $this->tiposPrestamos,
                                                                               'monedas' => $this->monedas,
                                                                               'jornada' => $this->jornada,
                                                                               'count' => $this->countActiveJornada()]);
    }

    #[On('click-editarSp')]
    public function edit($id){
        $this->postId = $id;        
        $query = SolicitudPrestamo::where('id','=',$id)
                                    ->with('jornadaDetalle.SolicitudPrestamoJornada')
                                    ->with('jornadaDetalle.TipoPrestamo')
                                    ->with('jornadaDetalle.Moneda')
                                    ->get();

        $this->fs_jornada_nombre = $query[0]->jornadaDetalle->SolicitudPrestamoJornada->nombre;
        $this->fs_moneda_nombre  = $query[0]->jornadaDetalle->Moneda->abreviatura;
        $this->fs_tp_nombre      = $query[0]->jornadaDetalle->TipoPrestamo->nombre;

        $this->fs_jornada_detalle_id = $query[0]->jornadaDetalle->id;
        $this->fs_tipo_prestamo      = $query[0]->jornadaDetalle->TipoPrestamo->id;        
        $this->fs_moneda_id          = $query[0]->jornadaDetalle->Moneda->id;        
        $this->fs_cant_cuotas        = $query[0]->jornadaDetalle->cant_cuotas; 
        $this->fs_monto_tope         = $query[0]->jornadaDetalle->monto_tope;
        $this->fs_fecha_solicitud    = $query[0]->fecha_solicitud;
        $this->fs_socio_id           = $query[0]->socio_id;        
        $this->fs_monto              = $query[0]->monto;
        $this->openModal();
    }

    public function countActiveJornada()
    {        
        return SolicitudPrestamoJornada::where('status', '=', '1')->count();
    }

    public function store(Request $request){        
        /*$this->validate([
            'monto_solicitud' => ['required', 'integer', 'min:1'],
        ], [
            'monto_solicitud.required' => 'Debe indicar Monto a solicitar y mayor que 0.',
            'monto_solicitud.max' => 'El monto máximo permitido es '
        ]);*/

        /*if ( $this->fs_monto > $this->fs_monto_tope){
            session()->flash('monto_solicitud', 'El monto maximo disponible a solicitar es de: '.$this->fs_monto_tope);
        }else{*/
            if ( $this->postId == 0){
                $now = Carbon::now();
                $formattedDate = $now->format('Y-m-d');
                $solicitud = SolicitudPrestamo::create([
                    'fecha_solicitud' => $this->fs_fecha_solicitud,
                    'jornada_solicitud_prestamo_detalle_id' => $this->fs_jornada_detalle_id,
                    'socio_id' => auth()->user()->id,
                    'tipo_prestamo_id' => $this->fs_tipo_prestamo,
                    'moneda_id' => $this->fs_moneda_id,
                    'monto' => $this->fs_monto,
                    'cant_cuotas' => $this->fs_cant_cuotas,
                    'status' => 0                
                ]);

                session()->flash('message', 'Solicitud creada exitosamente.');
                $this->dispatch('msnSp', ['mensaje'=>'Solicitud creada exitosamente']);
            }else{
                session()->flash('message', 'Solicitud Modificada exitosamente. id: '.$this->postId.', detalle: '. $this->postIdDet);
                $this->dispatch('msnSp', ['mensaje'=>'Solicitud Modificada correctamente. id: '.$this->postId]);
            }
            $this->closeModal();
        //}
    }
}
