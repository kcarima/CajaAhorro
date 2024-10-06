<?php

namespace App\Livewire\Sca\SolicitudPrestamo;

use App\Models\SCA\SolicitudPrestamo;

use Livewire\Component;
use Livewire\Attributes\On;

class CreateModalComponent extends Component
{
    public $isOpen=0;
    public $postId=0;


    public $fs_create;

    public function create(){
        $this->openModal();
    }

    public function openModal(){
        $this->isOpen=true;
    }

    public function closeModal(){
        $this->postId=0;
        $this->fs_create='';
        $this->isOpen=false;
    }

    public function mount(){
        $this->fs_create=date('Y-m-d');
    }

    public function render()
    {
        return view('livewire.sca.solicitud-prestamo.create-modal-component');
    }

    #[On('click-editarSp')]
    public function edit($id)
    {
        $post = SolicitudPrestamo::findOrFail($id);
        $this->postId = $id;
        $this->fs_create = $post->fecha_solicitud;

        $this->openModal();
    }

}
