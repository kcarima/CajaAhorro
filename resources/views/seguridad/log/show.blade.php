<x-app-layout titulo="Detalle Log #{{ $actividad->id }}">

    @php

    $LogEvent = \App\Classes\Enums\LogEvent::class;

    $encabezados = match ($actividad->event) {
        $LogEvent::UPDATED->value => ['Atributo', 'Valor Anterior', 'Valor Nuevo'],
        $LogEvent::CREATED->value, $LogEvent::RESTORED->value => ['Atributo', 'Valor Nuevo'],
        $LogEvent::DELETED->value => ['Atributo', 'Valor Anterior'],
    };

    $column_a = match ($actividad->event) {
        $LogEvent::UPDATED->value, $LogEvent::CREATED->value, $LogEvent::RESTORED->value => 'attributes',
        $LogEvent::DELETED->value => 'old',
    };

    $column_b = match ($actividad->event) {
        $LogEvent::UPDATED->value => 'old',
        $LogEvent::CREATED->value, $LogEvent::DELETED->value, $LogEvent::RESTORED->value => null,
    };

@endphp

<x-tabla titulo="Detalle Log #{{ $actividad->id }}">

    <x-tabla.header :encabezados="$encabezados"  />

    <tbody>
        @foreach ($actividad->properties[$column_a] as $key => $attribute)
            <tr>
                <td class="text-center">
                    @if(str_contains($key, '.'))
                        @php
                            list($modelo, $atributo) = explode('.', $key);
                        @endphp
                        {{ "($modelo) $atributo" }}
                    @else
                        {{ $key }}
                    @endif
                </td>
                @if ($column_b)
                    <td class="text-center">
                        @if (preg_match(
                                '/^https?:\/\/(?:www\.)?[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b(?:[-a-zA-Z0-9()@:%_\+.~#?&\/=]*)$/',
                                $actividad->properties[$column_b][$key]))
                            <a target="_blank"
                                href="{{ $actividad->properties[$column_b][$key] }}">{{ $actividad->properties[$column_b][$key] }}</a>
                        @else
                            {{ $actividad->properties[$column_b][$key] }}
                        @endif
                    </td>
                @endif
                <td class="text-center">
                    @if (preg_match(
                            '/^https?:\/\/(?:www\.)?[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b(?:[-a-zA-Z0-9()@:%_\+.~#?&\/=]*)$/',
                            $attribute))
                        <a target="_blank" href="{{ $attribute }}">$attribute</a>
                    @else
                        <span>
                            {{ $attribute }}
                        </span>
                     @endif
                </td>

        </tr>
        @endforeach
    </tbody>

</x-tabla>

</x-app-layout>
