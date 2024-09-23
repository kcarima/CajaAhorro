<?php

namespace App\Livewire\Seguridad\Bots;

use App\Models\Seguridad\BotLog;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

final class BotLogComponent extends Component
{
    use WithPagination;

    #[Url]
    public $busqueda = '';

    public function render()
    {
        $logs = BotLog::query();
        if ($this->busqueda) {
            $logs = $logs->where('ip', 'like', '%'.$this->busqueda.'%');
        }

        return view('livewire.seguridad.bots.bot-log-component', ['logs' => $logs->paginate()]);
    }

    #[On('bot-log:busqueda')]
    public function busqueda($busqueda)
    {
        $this->busqueda = $busqueda;
    }

    public function updatingBusqueda()
    {
        $this->resetPage();
    }
}
