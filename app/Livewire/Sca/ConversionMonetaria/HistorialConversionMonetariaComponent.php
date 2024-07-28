<?php

namespace App\Livewire\Sca\ConversionMonetaria;

use App\Actions\SCA\ConversionMonetaria\BuscarHistorialConversionMonetaria;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

final class HistorialConversionMonetariaComponent extends Component
{
    use WithPagination;

    #[Url]
    public $busqueda = '';

    public function render()
    {
        $historicos = BuscarHistorialConversionMonetaria::handle($this->busqueda);

        return view('livewire.sca.conversion-monetaria.historial-conversion-monetaria-component', ['historicos' => $historicos]);
    }

    #[On('historial-conversion-monetaria:busqueda')]
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
