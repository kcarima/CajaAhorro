<?php

namespace App\Livewire\Uneg\Sedes;

use App\Actions\UNEG\Sedes\BuscarSedes;
use App\Models\UNEG\Sede;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

final class SedesComponent extends Component
{
    use WithPagination;

    #[Url]
    public $busqueda = '';

    public function render()
    {
        $sedes = BuscarSedes::handle($this->busqueda);

        return view('livewire.uneg.sedes.sedes-component', ['sedes' => $sedes]);
    }

    #[On('sedes:busqueda')]
    public function busqueda($busqueda)
    {
        $this->busqueda = $busqueda;
        $this->dispatch('refresh-listeners');
    }

    public function updatingBusqueda()
    {
        $this->resetPage();
    }

    #[On('sedes:delete')]
    public function delete(string $id)
    {

        try {
            $sede = Sede::withCount(['socios'])->where('uuid', $id)->firstOrFail();

            if ($sede->socios_count > 0) {
                $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'No se puede eliminar una sede ocupada por socios.');
            } else {
                $nombre = $sede->nombre;
                $sede->delete();

                $this->dispatch('message-alert', success: true, title: '¡Exito!', message: "Sede $nombre eliminada satisfactoriamente.");
            }
        } catch (ModelNotFoundException $e) {
            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: getModelNotFoundExceptionMessage($e->getModel()));
        } catch (Exception $e) {
            throw $e;
            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'Error al eliminar la sede.');
        }
        $this->dispatch('refresh-listeners');
    }

    #[On('sedes:def-delete')]
    public function def_delete(string $id)
    {

        abort_unless(auth()->user()->is_root(), 404);

        try {
            $sede = Sede::withTrashed()->withCount(['socios'])->where('uuid', $id)->firstOrFail();

            if ($sede->socios_count > 0) {
                $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'No se puede eliminar una sede ocupada por socios.');
            } else {
                $nombre = $sede->nombre;
                $sede->forceDelete();

                $this->dispatch('message-alert', success: true, title: '¡Exito!', message: "Sede $nombre eliminada satisfactoriamente.");
            }
        } catch (ModelNotFoundException $e) {
            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: getModelNotFoundExceptionMessage($e->getModel()));
        } catch (Exception $e) {
            throw $e;
            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'Error al eliminar la sede.');
        }
        $this->dispatch('refresh-listeners');
    }

    public function restaurar(string $id)
    {

        abort_unless(auth()->user()->is_root(), 404);

        try {
            $sede = Sede::withTrashed()->where('uuid', $id)->firstOrFail();

            $sede->restore();

            $this->dispatch('message-alert', success: true, title: '¡Exito!', message: "Sede $sede->nombre restaurado.");

        } catch (ModelNotFoundException $e) {

            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: getModelNotFoundExceptionMessage($e->getModel()));

        } catch (Exception $e) {

            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'Error al restaurar la sede.');

        }
    }
}
