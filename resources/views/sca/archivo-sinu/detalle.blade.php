@php
    use Carbon\Carbon;
@endphp
<x-app-layout titulo="Archivos SINU">    
    <x-slot name="titulo">
        Archivos SINU
    </x-slot>
    <div class="card">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <form id="analitic">
            @csrf
            <input type="hidden" id="id" value="{{$query->id}}">
            <div class="text-lg w-full text-black py-2 border-2 border-solid border-gray-300">
                <div class="grid 2xl:grid-cols-5 md:grid-cols-4 sm:grid-cols-3 grid-cols-2 items-center gap-4 mx-4 mt-4">
                    <div>
                        <x-label for="fecha" value="Fecha:" />
                        <b>{{$query->fecha}}</b>
                    </div>
                    <div>
                        <x-label for="descripcion" value="Descripcion:" />
                        <b>{{$query->descripcion}}</b>
                    </div>
                </div>
                <div class="grid 2xl:grid-cols-5 md:grid-cols-4 sm:grid-cols-3 grid-cols-2 items-center gap-4 mx-4 mt-4">
                    <div>
                        <x-label for="monto" value="Monto:" />
                        <b>{{ number_format($query->monto, 2, ",", ".") }}</b>
                    </div>
                    <div>
                        <x-label for="Estatus" value="Estatus:" />
                        <b>
                            @if( $query->status == 0)
                                <button type="button" class="btn bg-orange-500" style="background-color: orange !important;">CARGADO</button>
                            @else
                                <button type="button" class="btn btn-sm btn-success">PROCESADO</button>                        
                            @endif
                        </b>
                    </div>
                </div>
            </div>
            <footer class="flex justify-around items-center flex-col-reverse lg:flex-row mb-4 gap-2 mt-4">
                <button type="button" onclick="history.back();"
                    class="rounded-md border border-solid border-red-500 text-red-500 hover:bg-red-500 hover:text-white lg:w-1/3 w-full h-10 text-lg">Regresar</button>
                <button type="button"
                    class="rounded-md bg-blue-400 text-white hover:bg-blue-800 lg:w-1/3 w-full h-10 text-lg" id="analizar">Analizar</button>                
            </footer>
        </form>
        <br />
        <div id="loading-indicator" class="d-flex justify-content-center d-none">
            <i class="bx bx-loader me-1" ></i>
            Analizando...
        </div>
        <div id="resp_analisis"></div>
        <br /><br />
    </div>    
    <script>
        const divResultado = document.getElementById("resp_analisis");
        const hiddenElement = document.getElementById('loading-indicator');

        document.getElementById("analizar").addEventListener("click", function() {
            divResultado.textContent = '';
            hiddenElement.classList.toggle('d-none');
            document.getElementById("analizar").disabled = true;
            document.getElementById('loading-indicator').style.display = 'block';
            fetch('{{ route("archivo-sinu.analisis") }}', {
                method: 'post',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                body: JSON.stringify({
                    // Your data here
                    id: '{{$query->id}}',
                })
                })
                .then(response => response.json())
                .then(data => {
                    document.getElementById("analizar").disabled = false;
                    hiddenElement.classList.toggle('d-none');
                    console.log(data); // Handle the response
                    divResultado.innerHTML = `${data.mensaje}`;
                })
                .catch(error => {
                console.error('Error:', error);
                });
        });

        document.getElementById("procesar").addEventListener("click", function() {
            alert('toca procesar');
        });
    </script>
</x-app-layout>
