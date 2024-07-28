<?php

namespace App\Livewire\Seguridad\Log;

use App\Actions\Seguridad\Log\BuscarLog;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

final class LogComponent extends Component
{
    use WithPagination;

    #[Url]
    public $busqueda = '';

    public function render()
    {
        $actividades = BuscarLog::handle($this->busqueda);

        return view('livewire.seguridad.log.log-component', ['actividades' => $actividades]);
    }

    #[On('log:busqueda')]
    public function busqueda($busqueda)
    {
        $this->busqueda = $busqueda;
    }

    public function updatingBusqueda()
    {
        $this->resetPage();
    }
}
