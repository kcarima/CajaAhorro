<?php

namespace App\Livewire\Sca\Conceptos;
use App\Models\SCA\conceptos;

use Livewire\Component;
use Livewire\Attributes\Reactive;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class ConceptosComponent extends Component
{
    use WithPagination;

    //#[Reactive]
    public $filtroBusqueda = [
        'descripcion' => '',
        'estatus' => ''
    ];

    public function render(){
        $conceptos = $this->buscar();
        return view('livewire.sca.conceptos.conceptos-component', ['conceptos' => $conceptos]);
    }

    #[On('busca-concepto')]
    public function refrescaConceptos($filtro){
        $this->filtroBusqueda=$filtro;
        $this->dispatch('$refresh');
    }

    #[On('msnConcepto')]
    public function msnConcepto($msn){
        session()->flash('success',  $msn['mensaje']);
        //$this->dispatch('$refresh');
    }


    public function buscar(){
        $query = conceptos::query();
        $query->when($this->filtroBusqueda['descripcion'], function ($query) {
            if ($this->filtroBusqueda['descripcion'] != ''){
                $query->where('descripcion', 'ilike','%'.$this->filtroBusqueda["descripcion"].'%');
            }
        })

        ->when($this->filtroBusqueda['estatus'], function ($query) {
            if ($this->filtroBusqueda['estatus'] != ''){
                $query->where('status', $this->filtroBusqueda["estatus"]);
            }
        })

        ->orderBy('descripcion')->paginate(15);
        return $query->paginate(15);
    }

    public function editarConcepto($id){
        $this->dispatch('editarConcepto', id: $id);
    }

    public function eliminaConcepto($id){
        $query = conceptos::find($id);
        $query->delete();
        session()->flash('success',  'Registro eliminado correctamente');
    }

    public function activarConcepto($id){
        $query = conceptos::find($id);
        $query->status=1;
        $query->update();

        session()->flash('success',  'Registro Activado correctamente');
    }

    public function desactivarConcepto($id){
        $query = conceptos::find($id);
        $query->status=0;
        $query->update();

        session()->flash('success',  'Registro Desactivado correctamente');
    }    

    #[On('concepto:delete')]
    public function delete($id){
        $this->eliminaConcepto($id);

    }
}
