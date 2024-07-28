<?php

namespace App\Livewire\Seguridad\Usuarios;

use App\Actions\Seguridad\Usuarios\BuscarUsuarios;
use App\Models\Seguridad\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

final class UsuariosComponent extends Component
{
    use WithPagination;

    #[Url]
    public $busqueda = '';

    public function render()
    {
        $usuarios = BuscarUsuarios::handle(busqueda: $this->busqueda);

        return view('livewire.seguridad.usuarios.usuarios-component', ['usuarios' => $usuarios]);
    }

    #[On('usuarios:busqueda')]
    public function busqueda($busqueda)
    {
        $this->busqueda = $busqueda;
    }

    public function updatingBusqueda()
    {
        $this->resetPage();
    }

    #[On('usuarios:delete')]
    public function delete($cedula)
    {

        abort_unless(auth()->user()->is_admin(), '404');

        try {
            $usuario = User::where('cedula', 'like', $cedula)->firstOrFail();

            $nombre = $usuario->socio->nombre;

            $usuario->delete();

            $this->dispatch('message-alert', success: true, title: '¡Exito!', message: "Usuario $nombre ($cedula) eliminado satisfactoriamente.");

        } catch (ModelNotFoundException $e) {

            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'Usuario no encontrado.');

        } catch (Exception $e) {

            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'Error al eliminar el usuario.');

        }
        $this->dispatch('refresh-listeners');
    }

    #[On('usuarios:def-delete')]
    public function def_delete(string $id)
    {

        abort_unless(auth()->user()->is_root(), 404);

        try {
            $usuario = User::withTrashed()->where('cedula', 'like', $id)->firstOrFail();

            $nombre = $usuario->socio->nombre;

            $usuario->forceDelete();

            $this->dispatch('message-alert', success: true, title: '¡Exito!', message: "Usuario $nombre ($cedula) eliminado completamente.");

        } catch (ModelNotFoundException $e) {

            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'Usuario no encontrado.');

        } catch (Exception $e) {

            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'Error al eliminar el usuario.');

        }
        $this->dispatch('refresh-listeners');
    }

    public function restaurar(string $id)
    {

        abort_unless(auth()->user()->is_root(), 404);

        try {
            $usuario = User::withTrashed()->where('cedula', 'like', $id)->firstOrFail();

            $usuario->restore();

            $this->dispatch('message-alert', success: true, title: '¡Exito!', message: 'Usuario '.$usuario->socio->nombre." ($cedula) restaurado exitosamente.");

        } catch (ModelNotFoundException $e) {

            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'Usuario no encontrado.');

        } catch (Exception $e) {

            $this->dispatch('message-alert', success: false, title: '¡Whoops! Algo salió mal.', message: 'Error al restaurar el usuario.');

        }
        $this->dispatch('refresh-listeners');
    }
}
