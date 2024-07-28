<?php

namespace App\Livewire\Utils;

use Livewire\Component;

final class BusquedaComponent extends Component
{
    public string $modulo;

    public $busqueda;

    protected $listeners = [
        'busqueda:limpiar' => 'limpiarBusqueda',
    ];

    public function render()
    {
        return view('livewire.utils.busqueda-component');
    }

    public function updatedBusqueda(): void
    {
        $this->dispatch("$this->modulo:busqueda", $this->busqueda);
    }

    public function limpiarBusqueda(): void
    {
        $this->busqueda = '';
    }
}
