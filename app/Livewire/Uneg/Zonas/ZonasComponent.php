<?php

namespace App\Livewire\Uneg\Zonas;

use App\Actions\UNEG\Zonas\BuscarZonas;
use App\Models\UNEG\Zona;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

final class ZonasComponent extends Component
{
    use WithPagination;

    #[Url]
    public $busqueda = '';

    public function render()
    {
        $zonas = BuscarZonas::handle($this->busqueda);

        return view('livewire.uneg.zonas.zonas-component', ['zonas' => $zonas]);
    }

    #[On('zonas:busqueda')]
    public function busqueda($busqueda)
    {
        $this->busqueda = $busqueda;
        $this->dispatch('refresh-listeners');
    }

    public function updatingBusqueda()
    {
        $this->resetPage();
    }

    #[On('zonas:delete')]
    public function delete(string $id)
    {

        try {
            $zona = Zona::withCount(['socios'])->where('id', $id)->firstOrFail();

            if ($zona->socios_count > 0) {
                $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'No se puede eliminar una zona ocupada por socios.');
            } else {
                $nombre = $zona->nombre;
                $zona->delete();

                $this->dispatch('message-alert', success: true, title: '¡Exito!', message: "Zona $nombre eliminada satisfactoriamente.");
            }
        } catch (ModelNotFoundException $e) {
            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: getModelNotFoundExceptionMessage($e->getModel()));
        } catch (Exception $e) {
            throw $e;
            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'Error al eliminar la zona.');
        }
        $this->dispatch('refresh-listeners');
    }

    #[On('zonas:def-delete')]
    public function def_delete(string $id)
    {

        abort_unless(auth()->user()->is_root(), 404);

        try {
            $zona = Zona::withTrashed()->withCount(['socios'])->where('id', $id)->firstOrFail();

            if ($zona->socios_count > 0) {
                $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'No se puede eliminar una zona ocupada por socios.');
            } else {
                $nombre = $zona->nombre;
                $zona->forceDelete();

                $this->dispatch('message-alert', success: true, title: '¡Exito!', message: "Zona $nombre eliminada satisfactoriamente.");
            }
        } catch (ModelNotFoundException $e) {
            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: getModelNotFoundExceptionMessage($e->getModel()));
        } catch (Exception $e) {
            throw $e;
            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'Error al eliminar la zona.');
        }
        $this->dispatch('refresh-listeners');
    }

    public function restaurar(string $id)
    {

        abort_unless(auth()->user()->is_root(), 404);

        try {
            $zona = Zona::withTrashed()->where('id', $id)->firstOrFail();

            $zona->restore();

            $this->dispatch('message-alert', success: true, title: '¡Exito!', message: "Zona $zona->nombre restaurado.");

        } catch (ModelNotFoundException $e) {

            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: getModelNotFoundExceptionMessage($e->getModel()));

        } catch (Exception $e) {

            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'Error al restaurar la zona.');

        }
    }
}
