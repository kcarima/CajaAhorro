<?php

namespace App\Livewire\Sca\SolicitudIngreso;

use App\Actions\SCA\SolicitudIngreso\BuscarSolicitudIngreso;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

final class SolicitudIngresoComponent extends Component
{
    use WithPagination;

    #[Url]
    public $busqueda = '';

    public function render()
    {
        $solicitudes = BuscarSolicitudIngreso::handle($this->busqueda);

        return view('livewire.sca.solicitud-ingreso.solicitud-ingreso-component', ['solicitudes' => $solicitudes]);
    }

    #[On('solicitud-ingreso:busqueda')]
    public function busqueda($busqueda)
    {
        $this->busqueda = $busqueda;
        $this->dispatch('refresh-listeners');
    }

    public function updatingBusqueda()
    {
        $this->resetPage();
    }
}
