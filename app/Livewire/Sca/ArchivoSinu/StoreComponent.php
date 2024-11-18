<?php

namespace App\Livewire\Sca\ArchivoSinu;

use Livewire\Component;

class StoreComponent extends Component
{
    public $isOpen      = 0;

    public $archivo_id   = 0;
    public $fecha       = '';
    public $descripcion = '';


    public function render()
    {
        return view('livewire.sca.archivo-sinu.store-component');
    }

    public function openModal(){
        $this->isOpen=true;
    }

    public function closeModal(){
        $this->isOpen=false;
    }
}
