<section class="mb-4">
    <header class="w-full text-white bg-blue-800 text-center text-xl p-2">Datos Bancarios</header>
    <div class="text-lg w-full text-black pb-2 border-2 border-solid border-gray-300" id="bancos-section">
        <footer class="flex justify-end">
            <button type="button" id="agregar-banco"
                class="rounded-md bg-cyan-400 p-2 text-white m-2 hover:bg-cyan-800">Agregar banco</button>
        </footer>
    </div>
    @include('auth.partials.templates.bancos')
</section>
