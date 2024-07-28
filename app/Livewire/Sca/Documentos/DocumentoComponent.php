<?php

namespace App\Livewire\Sca\Documentos;

use App\Actions\SCA\Documentos\BuscarDocumentos;
use App\Models\SCA\Documento;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

final class DocumentoComponent extends Component
{
    use WithPagination;

    #[Url]
    public $busqueda = '';

    public function render()
    {
        $documentos = BuscarDocumentos::handle($this->busqueda);

        return view('livewire.sca.documentos.documento-component', ['documentos' => $documentos]);
    }

    #[On('documentos:busqueda')]
    public function busqueda($busqueda)
    {
        $this->busqueda = $busqueda;
        $this->dispatch('refresh-listeners');
    }

    public function updatingBusqueda()
    {
        $this->resetPage();
    }

    #[On('documentos:delete')]
    public function delete(string $id)
    {
        try {
            $documento = Documento::where('uuid', $id)->firstOrFail();
            $nombre = $documento->nombre;
            $documento->delete();
            $this->dispatch('message-alert', success: true, title: '¡Exito!', message: "Documento $nombre eliminado satisfactoriamente.");

        } catch (ModelNotFoundException $e) {
            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: getModelNotFoundExceptionMessage($e->getModel()));
        } catch (Exception $e) {
            throw $e;
            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'Error al eliminar el documento.');
        }
        $this->dispatch('refresh-listeners');
    }

    #[On('documentos:def-delete')]
    public function def_delete(string $id)
    {

        abort_unless(auth()->user()->is_root(), 404);

        try {
            $documento = Documento::withTrashed()->withCount(['socios'])->where('uuid', $id)->firstOrFail();
            $nombre = $documento->nombre;
            $documento->forceDelete();
            $this->dispatch('message-alert', success: true, title: '¡Exito!', message: "Documento $nombre eliminado satisfactoriamente.");

        } catch (ModelNotFoundException $e) {
            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: getModelNotFoundExceptionMessage($e->getModel()));
        } catch (Exception $e) {
            throw $e;
            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'Error al eliminar el documento.');
        }
        $this->dispatch('refresh-listeners');
    }

    public function restaurar(string $id)
    {

        abort_unless(auth()->user()->is_root(), 404);

        try {
            $documento = Documento::withTrashed()->where('uuid', $id)->firstOrFail();

            $documento->restore();

            $this->dispatch('message-alert', success: true, title: '¡Exito!', message: "Documento $documento->nombre restaurado.");

        } catch (ModelNotFoundException $e) {

            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: getModelNotFoundExceptionMessage($e->getModel()));

        } catch (Exception $e) {

            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'Error al restaurar el documento.');

        }
        $this->dispatch('refresh-listeners');
    }
}
