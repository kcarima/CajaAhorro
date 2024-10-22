<?php

namespace App\Livewire\Sca\Bancos;

use App\Actions\SCA\Bancos\BuscarBancos;
use App\Models\SCA\Banco;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

final class BancosComponent extends Component
{
    use WithPagination;

    #[Url]
    public $busqueda = '';

    public function render()
    {
        $bancos = BuscarBancos::handle($this->busqueda);

        return view('livewire.sca.bancos.bancos-component', ['bancos' => $bancos]);
    }

    #[On('bancos:busqueda')]
    public function busqueda($busqueda)
    {
        $this->busqueda = $busqueda;
        $this->dispatch('refresh-listeners');
    }

    public function updatingBusqueda()
    {
        $this->resetPage();
    }

    #[On('bancos:delete')]
    public function delete(string $id)
    {

        abort_unless(auth()->user()->is_admin(), 404);

        try {
            $banco = Banco::withCount(['bancos_socios', 'cuentas_bancarias'])->where('uuid', $id)->firstOrFail();

            if ($banco->bancos_socios_count > 0 || $banco->cuentas_bancarias_count > 0) {
                $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'No se puede eliminar un banco ocupado por una cuenta bancaria.');
            } else {
                $nombre = $banco->nombre;
                $banco->delete();

                $this->dispatch('message-alert', success: true, title: '¡Exito!', message: "Banco $nombre eliminado satisfactoriamente.");
            }

        } catch (ModelNotFoundException $e) {

            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'Banco no encontrado.');

        } catch (Exception $e) {

            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'Error al eliminar el banco.');

        }
        $this->dispatch('refresh-listeners');
    }

    #[On('bancos:def-delete')]
    public function def_delete(string $id)
    {

        abort_unless(auth()->user()->is_root(), 404);

        try {
            $banco = Banco::withTrashed()->withCount(['bancos_socios', 'cuentas_bancarias'])->where('uuid', $id)->firstOrFail();

            if ($banco->bancos_socios_count > 0 || $banco->cuentas_bancarias_count > 0) {

                $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'No se puede eliminar un banco ocupado por una cuenta bancaria.');

            } else {

                $nombre = $banco->nombre;
                $banco->forceDelete();

                $this->dispatch('message-alert', success: true, title: '¡Exito!', message: "Banco $nombre eliminado completamente.");

            }

        } catch (ModelNotFoundException $e) {

            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'Banco no encontrado.');

        } catch (Exception $e) {

            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'Error al eliminar el banco.');

        }
        $this->dispatch('refresh-listeners');
    }

    public function restaurar(string $id)
    {

        abort_unless(auth()->user()->is_root(), 404);

        try {

            $banco = Banco::withTrashed()->where('uuid', $id)->firstOrFail();
            $banco->restore();

            $this->dispatch('message-alert', success: true, title: '¡Exito!', message: "Banco $banco->nombre restaurado.");

        } catch (ModelNotFoundException $e) {

            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'Banco no encontrado.');

        } catch (Exception $e) {

            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'Error al restaurar el banco.');

        }
        $this->dispatch('refresh-listeners');
    }
}
