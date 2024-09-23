<?php

namespace App\Livewire\Sca\Reconversion;

use App\Actions\SCA\ConversionMonetaria\BuscarReconversion;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

final class ReconversionComponent extends Component
{
    use WithPagination;

    #[Url]
    public $busqueda = '';

    protected $listeners = [
        'reconversion:busqueda' => 'busqueda',
    ];

    public function render()
    {
        $reconversiones = BuscarReconversion::handle($this->busqueda);

        return view('livewire.sca.reconversion.reconversion-component', ['tablas' => $reconversiones]);
    }

    #[On('reconversion:busqueda')]
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
