@props(['titulo'])
<div class="card">
    <h5 class="card-header">{{ $titulo }}</h5>
    <div class="table-responsive text-nowrap min-h-[20rem] overflow-auto">
      <table class="table">
        {{ $slot }}
      </table>
    </div>
</div>
