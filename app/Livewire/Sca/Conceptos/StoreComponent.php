<?php

namespace App\Livewire\Sca\Conceptos;
use App\Models\SCA\conceptos;

use Livewire\Component;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Livewire\Attributes\On;

class StoreComponent extends Component
{
    public $isOpen=0;

    public $concepto_id;
    public $codigo;
    public $descripcion;
    public $accion;
    public $estatus;

    public function render(){
        return view('livewire.sca.conceptos.store-component');
    }

    public function openModal(){
        $this->isOpen=true;
    }

    public function closeModal(){
        $this->concepto_id=0;
        $this->codigo='';
        $this->descripcion='';
        $this->accion='';
        $this->estatus='';

        $this->isOpen=false;
    }

    public function store(Request $request){
        $this->validate([
            'codigo' => ['required'],
            'descripcion' => ['required'],
            'accion' => ['required'],
        ], [
            'codigo.required' => 'Debe indicar Codigo.',
            'descripcion.required' => 'Debe indicar Descripción.',
            'accion.required' => 'Debe indicar Acción.',
        ]);

        if ($this->concepto_id == 0 ){
            $solicitud = conceptos::create([
                'codigo' => $this->codigo,
                'descripcion' => $this->descripcion,
                'accion' => $this->accion,
                'status' => 1
            ]);
            $this->dispatch('msnConcepto', ['mensaje'=>'Concepto Creado exitosamente']);
        }else{
            $query = conceptos::find($this->concepto_id);

            $query->codigo = $this->codigo;
            $query->descripcion = $this->descripcion;
            $query->accion = $this->accion;

            $query->update();

            $this->dispatch('msnConcepto', ['mensaje'=>'Concepto Modificado correctamente.']);
        }
        
        $this->closeModal();
    }

    #[On('editarConcepto')]
    public function editar($id){
        $query = conceptos::find($id);

        $this->concepto_id=$query->id;
        $this->codigo=$query->codigo;
        $this->descripcion=$query->descripcion;
        $this->accion=$query->accion;
        $this->estatus=$query->estatus;

        $this->openModal();
    }
}
