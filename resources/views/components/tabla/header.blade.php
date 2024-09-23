<thead>
    <tr>
        @foreach ($encabezados as $index => $encabezado)
            <th class="text-center" {{ isset($anchos[$index]) ? "width=$anchos[$index]" : '' }}> {{ $encabezado }} </th>
        @endforeach
    </tr>
</thead>
