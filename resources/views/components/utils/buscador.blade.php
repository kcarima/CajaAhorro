@props(['modulo'])

<div class="navbar-nav align-items-center">
    <div class="nav-item d-flex align-items-center">
        <i class="bx bx-search fs-4 lh-0"></i>
        @livewire('utils.busqueda-component', ['modulo' => $modulo])
    </div>
</div>
