<?php

namespace App\Livewire\Uneg\Departamentos;

use App\Actions\UNEG\Departamentos\BuscarDepartamentos;
use App\Models\UNEG\Departamento;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

final class DepartamentosComponent extends Component
{
    use WithPagination;

    #[Url]
    public $busqueda = '';

    public function render()
    {
        $departamentos = BuscarDepartamentos::handle($this->busqueda);

        return view('livewire.uneg.departamentos.departamentos-component', ['departamentos' => $departamentos]);
    }

    #[On('departamentos:busqueda')]
    public function busqueda($busqueda)
    {
        $this->busqueda = $busqueda;
        $this->dispatch('refresh-listeners');
    }

    public function updatingBusqueda()
    {
        $this->resetPage();
    }

    #[On('departamentos:delete')]
    public function delete(string $id)
    {

        try {
            $departamento = Departamento::where('uuid', $id)->withCount(['socios'])->firstOrFail();

            if ($departamento->socios_count > 0) {
                $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'No se puede eliminar un departamento ocupado por socios.');
            } else {
                $nombre = $departamento->nombre;
                $codigo = $departamento->codigo;
                $departamento->delete();

                $this->dispatch('message-alert', success: true, title: '¡Exito!', message: "Departamento $nombre ($codigo) eliminado satisfactoriamente.");
            }

        } catch (ModelNotFoundException $e) {

            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'Departamento no encontrado.');

        } catch (Exception $e) {

            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'Error al eliminar el departamento.');

        }
        $this->dispatch('refresh-listeners');
    }

    #[On('departamentos:def-delete')]
    public function def_delete(string $id)
    {

        abort_unless(auth()->user()->is_root(), 404);

        try {
            $departamento = Departamento::withTrashed()->where('uuid', $id)->withCount(['socios'])->firstOrFail();
            if ($departamento->socios_count > 0) {
                $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'No se puede eliminar un departamento ocupado por socios.');
            } else {
                $nombre = $departamento->nombre;
                $codigo = $departamento->codigo;
                $departamento->forceDelete();

                $this->dispatch('message-alert', success: true, title: '¡Exito!', message: "Departamento $nombre ($codigo) eliminado completamente.");
            }

        } catch (ModelNotFoundException $e) {

            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'Departamento no encontrado.');

        } catch (Exception $e) {
            throw $e;
            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'Error al eliminar el departamento.');

        }
        $this->dispatch('refresh-listeners');
    }

    public function restaurar($id)
    {

        abort_unless(auth()->user()->is_root(), 404);

        try {
            $departamento = Departamento::withTrashed()->where('uuid', $id)->firstOrFail();

            $departamento->restore();

            $this->dispatch('message-alert', success: true, title: '¡Exito!', message: "Departamento $departamento->nombre ($departamento->codigo) restaurado.");

        } catch (ModelNotFoundException $e) {
            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'Departamento no encontrado.');
        } catch (Exception $e) {
            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'Error al restaurar el departamento.');
        }
        $this->dispatch('refresh-listeners');
    }
}
