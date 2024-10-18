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
    public $idCreate=0;

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

    public $fecha_inicio;
    public $fecha_cierre;
    public $descripcion;
    public $observacion;
    public $tipo_prestamo;
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
        $this->registroFjsp['fechaInicio']=date('Y-m-d');
        $this->registroFjsp['fechaFin']=date('Y-m-d');
        $this->registroFjsp['descripcion']='';
        $this->registroFjsp['observacion']='';
        $this->registroFjsp['tipoPrestamo']='';
        $this->registroFjsp['tipoMoneda']='';
        $this->registroFjsp['montotope']=0.00;
        $this->registroFjsp['cuotas']=0.00;

        $this->fecha_inicio=date('Y-m-d');
        $this->fecha_cierre=date('Y-m-d');
        $this->descripcion='';
        $this->observacion='';
        $this->tipo_prestamo='';
        $this->tipo_moneda='';
        $this->monto_tope=0.00;
        $this->cuotas=0.00;


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
                                                                                        'monedas' => $this->monedas,
                                                                                        'registroFjsp' => $this->registroFjsp
                                                                                    ]);
    }

    #[On('click-editarSp')]
    public function edit($id){
        $post = SolicitudPrestamo::findOrFail($id);
        /*$this->postId = $id;
        $this->fs_fecha = $post->fecha_solicitud;
        $this->fs_tipo_prestamo=$post->tipo_prestamo;
        $this->fs_moneda=$post->moneda;*/
        $this->openModal();
    }

    public function create(Request $request){
        $this->validate([
            'fecha_inicio' => 'required|date',
            'fecha_cierre' => 'required|date|after:fecha_inicio',
            'descripcion' => ['required'],
            'tipo_prestamo' => ['exists:sca.tipos_prestamos,id', 'required'],
            'tipo_moneda'=> ['required'],
            'monto_tope' => ['required'],
            'cuotas' => ['required'],
            'observacion' => ['nullable', 'max:255']
        ], [
            'tipo_prestamo.required' => 'El Tipo de Prestamo es obligatorio.',
        ]);



        $jornada = SolicitudPrestamoJornada::create([
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_cierre' => $request->fecha_cierre,
            'observacion' => $request->observacion,
            'nombre' => $request->descripcion,
            'status' => 0
        ]);

        dd($jornada->id);
        /*SolicitudPrestamoJornadaDetalle::create([
            'jornada_solicitud_prestamo_id' => $jornada->id,
            'tipo_prestamo_id' => $this->registroFjsp['tipoPrestamo'],
            'moneda_id' => $this->registroFjsp['tipoMoneda'],
            'monto_tope' => $this->registroFjsp['montotope'],
            'cant_cuotas' => $this->registroFjsp['cuotas']
        ]);*/

        //$this->emit('jornadaCreated'); // Emitir un evento para actualizar la lista de Jornadas
        $this->closeModal();
    }


    /*public function create(Request $request){
        request()->validate([
            'fecha_inicio' => 'required|date',
            'fecha_cierre' => 'required|date|after:fecha_inicio',
            'descripcion' => ['required'],
            'tipo_prestamo' => ['required'],
            'tipo_moneda'=> ['required'],
            'monto_tope' => ['required'],
            'cuotas' => ['required'],
            'observacion' => ['nullable', 'max:255']
        ]);

        DB::beginTransaction();

        try {
            $jornada = SolicitudPrestamoJornada::create([
                'fecha_inicio' => $request->fecha_inicio,
                'fecha_cierre' => $request->fecha_cierre,
                'observacion' => $request->observacion,
                'nombre' => $request->descripcion,
                'status' => 0
            ]);

            SolicitudPrestamoJornadaDetalle::create([
                'jornada_solicitud_prestamo_id' => $jornada->id,
                'tipo_prestamo_id' => $request->tipo_prestamo,
                'moneda_id' => $request->tipo_moneda,
                'monto_tope' => $request->monto_tope,
                'cant_cuotas' => $request->cuotas
            ]);

            DB::commit();
        } catch (ModelNotFoundException $e) {
            DB::rollback();
            return back()->withErrors('El tipo de préstamo o moneda no existe.');
        } /*catch (ValidationException $e) {
            DB::rollback();
            return back()->withErrors($e->errors());
        } catch (\Exception $e) {
            DB::rollback();
            // Registrar la excepción en un log
            Log::error('Error al crear la jornada de préstamo: ' . $e->getMessage());
            return back()->withErrors('Error inesperado al crear la Jornada de Préstamo');
        }*/

        /*return to_route('tipo-prestamo.index')->with('success', 'Jornada de Prestamo creada satisfactoriamente');
    }*/
}
