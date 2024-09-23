<?php

namespace App\Livewire\Seguridad\Bots;

use App\Models\Seguridad\BlockIp;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

final class BlockIpComponent extends Component
{
    use WithPagination;

    #[Url]
    public $busqueda = '';

    protected $listeners = [
        'block-ip:busqueda' => 'busqueda',
    ];

    public function render()
    {
        $logs = BlockIp::query();
        if ($this->busqueda) {
            $logs = $logs->where('ip', 'like', '%'.$this->busqueda.'%');
        }

        return view('livewire.seguridad.bots.block-ip-component', ['logs' => $logs->paginate()]);
    }

    #[On('block-ip:busqueda')]
    public function busqueda($busqueda)
    {
        $this->busqueda = $busqueda;
    }

    public function updatingBusqueda()
    {
        $this->resetPage();
    }
}
