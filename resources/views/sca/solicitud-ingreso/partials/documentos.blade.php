<section class="mb-4">
    <header class="w-full text-white bg-blue-800 text-center text-xl p-2">Documentos</header>
    <div class="text-lg w-full text-black py-2 border-2 border-solid border-gray-300">
        <div class="grid grid-cols-1 lg:grid-cols-2 lg:gap-4 gap-2 mx-4">
            <div>
                <x-label for="doc_cedula" value="Copia de la Cédula de Identidad" />
                <input id="doc_cedula" class="filled" name="doc_cedula" type="file" data-max-size="100" accept="image/*,.pdf">
            </div>
            <div>
                <x-label for="doc_resolucion" value="Resolución" />
                <input type="file" class="filled" id="doc_resolucion" data-max-size="100" name="doc_resolucion" accept=".pdf">
            </div>
        </div>
    </div>
</section>
