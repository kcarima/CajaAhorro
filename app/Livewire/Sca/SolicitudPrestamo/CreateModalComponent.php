<?php

namespace App\Livewire\Sca\SolicitudPrestamo;

use App\Models\SCA\SolicitudPrestamoJornada;
use App\Models\SCA\SolicitudPrestamo;
use App\Models\SCA\TipoPrestamo;
use App\Models\SCA\Moneda;

use Livewire\Component;
use Livewire\Attributes\On;

class CreateModalComponent extends Component
{
    public $isOpen=0;

    public $tiposPrestamos = "";
    public $monedas = "";
    public $jornada;

    public $postId=0;
    public $fs_fecha='';
    public $fs_tipo_prestamo='';
    public $fs_moneda='';

    public function formSp(){
        $this->openModal();
    }

    public function openModal(){
        $this->isOpen=true;
    }

    public function closeModal(){
        $this->postId=0;
        $this->fs_fecha='';
        $this->fs_tipo_prestamo='';
        $this->fs_moneda='';
        $this->isOpen=false;
    }

    public function mount(){
        $this->fs_fecha=date('Y-m-d');
        $this->fs_tipo_prestamo='';
        $this->fs_moneda='';
    }

    public function render(){
        $this->tiposPrestamos = TipoPrestamo::query()->orderBy('nombre')->get();
        $this->monedas = Moneda::query()->orderBy('abreviatura')->get();
        $this->jornada = SolicitudPrestamoJornada::Activo()
                                                   ->with('jornadaDetalle.TipoPrestamo')
                                                   ->with('jornadaDetalle.Moneda')
                                                   ->get();
        return view('livewire.sca.solicitud-prestamo.create-modal-component', ['tiposPrestamos' => $this->tiposPrestamos,
                                                                               'monedas' => $this->monedas,
                                                                               'jornada' => $this->jornada]);
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

}
