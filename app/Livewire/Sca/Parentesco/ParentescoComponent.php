<?php

namespace App\Livewire\Sca\Parentesco;

use App\Actions\SCA\Parentesco\BuscarParentesco;
use App\Models\SCA\Parentesco;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

final class ParentescoComponent extends Component
{
    use WithPagination;

    #[Url]
    public $busqueda = '';

    public function render()
    {
        $parentescos = BuscarParentesco::handle($this->busqueda);

        return view('livewire.sca.parentesco.parentesco-component', ['parentescos' => $parentescos]);
    }

    #[On('parentesco:busqueda')]
    public function busqueda($busqueda)
    {
        $this->busqueda = $busqueda;
        $this->dispatch('refresh-listeners');
    }

    public function updatingBusqueda()
    {
        $this->resetPage();
    }

    #[On('parentesco:delete')]
    public function delete(string $id)
    {

        try {
            $parentesco = Parentesco::withCount(['beneficiarios'])->where('uuid', $id)->firstOrFail();

            if ($parentesco->beneficiarios_count > 0) {
                $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'No se puede eliminar un parentesco asociado a un beneficiario.');
            } else {
                $nombre = $parentesco->nombre;
                $parentesco->delete();

                $this->dispatch('message-alert', success: true, title: '¡Exito!', message: "Parentesco $nombre eliminado satisfactoriamente.");
            }
        } catch (ModelNotFoundException $e) {
            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: getModelNotFoundExceptionMessage($e->getModel()));
        } catch (Exception $e) {
            throw $e;
            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'Error al eliminar el parentesco.');
        }
        $this->dispatch('refresh-listeners');
    }

    #[On('parentesco:def-delete')]
    public function def_delete(string $id)
    {

        abort_unless(auth()->user()->is_root(), 404);

        try {
            $parentesco = Parentesco::withTrashed()->withCount(['beneficiarios'])->where('uuid', $id)->firstOrFail();

            if ($parentesco->beneficiarios_count > 0) {
                $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'No se puede eliminar un parentesco asociado a un beneficiario.');
            } else {
                $nombre = $parentesco->nombre;
                $parentesco->forceDelete();

                $this->dispatch('message-alert', success: true, title: '¡Exito!', message: "Parentesco $nombre eliminado satisfactoriamente.");
            }
        } catch (ModelNotFoundException $e) {
            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: getModelNotFoundExceptionMessage($e->getModel()));
        } catch (Exception $e) {
            throw $e;
            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'Error al eliminar el parentesco.');
        }
        $this->dispatch('refresh-listeners');
    }

    public function restaurar(string $id)
    {

        abort_unless(auth()->user()->is_root(), 404);

        try {
            $parentesco = Parentesco::withTrashed()->where('uuid', $id)->firstOrFail();

            $parentesco->restore();

            $this->dispatch('message-alert', success: true, title: '¡Exito!', message: "Parentesco $parentesco->nombre restaurado.");

        } catch (ModelNotFoundException $e) {

            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: getModelNotFoundExceptionMessage($e->getModel()));

        } catch (Exception $e) {

            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'Error al restaurar el parentesco.');

        }
        $this->dispatch('refresh-listeners');
    }
}
