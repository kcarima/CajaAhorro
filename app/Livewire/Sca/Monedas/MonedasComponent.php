<?php

namespace App\Livewire\Sca\Monedas;

use App\Actions\SCA\Monedas\BuscarMonedas;
use App\Models\SCA\Moneda;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

final class MonedasComponent extends Component
{
    use WithPagination;

    #[Url]
    public $busqueda = '';

    public function render()
    {
        $monedas = BuscarMonedas::handle($this->busqueda);

        return view('livewire.sca.monedas.monedas-component', ['monedas' => $monedas]);
    }

    #[On('monedas:busqueda')]
    public function busqueda($busqueda)
    {
        $this->busqueda = $busqueda;
        $this->dispatch('refresh-listeners');
    }

    public function updatingBusqueda()
    {
        $this->resetPage();
    }

    #[On('monedas:delete')]
    public function delete(string $id)
    {

        abort_unless(auth()->user()->is_admin(), 404);

        try {
            $moneda = Moneda::where('uuid', $id)->firstOrFail();

            if ($moneda->es_default) {
                $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'No se puede eliminar la moneda que esta por defecto.');
            } else {
                $nombre = $moneda->nombre;
                $moneda->delete();
                $this->dispatch('message-alert', success: true, title: '¡Exito!', message: "Moneda $nombre eliminada satisfactoriamente.");
            }

        } catch (ModelNotFoundException $e) {

            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'Moneda no encontrada.');

        } catch (Exception $e) {

            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'Error al eliminar la moneda.');

        }
        $this->dispatch('refresh-listeners');
    }

    #[On('monedas:def-delete')]
    public function def_delete(string $id)
    {

        abort_unless(auth()->user()->is_root(), 404);

        try {
            $moneda = Moneda::withTrashed()->where('uuid', $id)->firstOrFail();

            if ($moneda->es_default) {
                $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'No se puede eliminar la moneda que esta por defecto.');
            } else {
                $nombre = $moneda->nombre;
                $moneda->forceDelete();
                $this->dispatch('message-alert', success: true, title: '¡Exito!', message: "Moneda $nombre eliminada definitivamente.");
            }

        } catch (ModelNotFoundException $e) {

            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'Moneda no encontrada.');

        } catch (Exception $e) {

            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'Error al eliminar la moneda.');

        }
        $this->dispatch('refresh-listeners');
    }

    public function restaurar(string $id)
    {

        abort_unless(auth()->user()->is_root(), 404);

        try {
            $moneda = Moneda::withTrashed()->where('uuid', $id)->firstOrFail();

            $nombre = $moneda->nombre;
            $moneda->restore();
            $this->dispatch('message-alert', success: true, title: '¡Exito!', message: "Moneda $nombre restaurada correctamente.");

        } catch (ModelNotFoundException $e) {

            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'Moneda no encontrada.');

        } catch (Exception $e) {

            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'Error al eliminar la moneda.');

        }
        $this->dispatch('refresh-listeners');
    }
}
