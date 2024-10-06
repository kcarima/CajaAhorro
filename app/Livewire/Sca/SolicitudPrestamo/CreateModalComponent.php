<?php

namespace App\Livewire\Sca\SolicitudPrestamo;

use Livewire\Component;

class CreateModalComponent extends Component
{
    public $isOpen=0;

    public $fs_create;

    public function create(){
        $this->openModal();
    }

    public function openModal(){
        $this->isOpen=true;
    }

    public function closeModal(){
        $this->isOpen=false;
    }

    public function mount(){
        $this->fs_create=date('Y-m-d');
    }

    public function render()
    {
        return view('livewire.sca.solicitud-prestamo.create-modal-component');
    }


}
