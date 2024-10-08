<?php

namespace App\Livewire\Sca\SolicitudPrestamoJornada;

use App\Models\SCA\SolicitudPrestamo;
use App\Models\SCA\TipoPrestamo;
use App\Models\SCA\Moneda;

use App\Http\Requests\SCA\JonadaSolicitudPrestamo\StoreJornadaSolicitudPrestamoRequest;

use Livewire\Component;
use Livewire\Attributes\On;

class CreateModalComponent extends Component
{
    public $isOpen=0;

    public $tiposPrestamos = "";
    public $monedas = "";

    public $postId=0;

    public $registroFjsp = [
        'fechaInicio' => '',
        'fechaFin' => '',
        'descripcion' => '',
        'observacion' => '',
        'tipoPrestamo' => '',
        'tipoMoneda' => '',
        'montotope' => 0.00,
        'cuotas' => 0.00
    ];

    public function formSp(){
        $this->openModal();
    }

    public function openModal(){
        $this->isOpen=true;
    }

    public function closeModal(){
        $this->postId=0;
        $this->registroFjsp['fechaInicio']=date('Y-m-d');
        $this->registroFjsp['fechaFin']=date('Y-m-d');
        $this->registroFjsp['descripcion']='';
        $this->registroFjsp['observacion']='';
        $this->registroFjsp['tipoPrestamo']='';
        $this->registroFjsp['tipoMoneda']='';
        $this->registroFjsp['montotope']=0.00;
        $this->registroFjsp['cuotas']=0.00;
        $this->isOpen=false;
    }

    public function mount(){
        $this->registroFjsp['fechaInicio']=date('Y-m-d');
        $this->registroFjsp['fechaFin']=date('Y-m-d');
        $this->registroFjsp['descripcion']='';
        $this->registroFjsp['observacion']='';
        $this->registroFjsp['tipoPrestamo']='';
        $this->registroFjsp['tipoMoneda']='';
        $this->registroFjsp['montotope']=0.00;
        $this->registroFjsp['cuotas']=0.00;
    }

    public function render(){
        $this->tiposPrestamos = TipoPrestamo::query()->activo()->orderBy('nombre')->get();
        $this->monedas = Moneda::query()->activo()->orderBy('abreviatura')->get();
        return view('livewire.sca.solicitud-prestamo-jornada.create-modal-component', [
                                                                                        'tiposPrestamos' => $this->tiposPrestamos,
                                                                                        'monedas' => $this->monedas
                                                                                    ]);
    }

    #[On('click-editarSp')]
    public function edit($id){
        $post = SolicitudPrestamo::findOrFail($id);
        $this->postId = $id;
        $this->fs_fecha = $post->fecha_solicitud;
        $this->fs_tipo_prestamo=$post->tipo_prestamo;
        $this->fs_moneda=$post->moneda;
        $this->openModal();
    }

    public function create($request){
        try {
            TipoPrestamo::create(
                [
                    'codigo' => $request->codigo,
                    'nombre' => $request->nombre,
                    'cantidad_cuotas' => $request->cuotas,
                    'dias_cuotas' => $request->dias_cuotas,
                    'tasa_interes' => $request->interes,
                    'meses_tasa' => $request->meses_tasa,
                    'plazo_siguiente_solicitud' => $request->plazo,
                    'cuota_especial' => isset($request->especial) ? true : false,
                    'habilitar' => isset($request->habilitado) ? true : false,
                ]
            );
        } catch (Exception $e) {
            return back()->withErrors('Error al crear el tipo de prestamo');
        }

        return to_route('tipo-prestamo.index')->with('success', 'Tipo de Prestamo creado satisfactoriamente');
    }

}
