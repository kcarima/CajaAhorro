@use('App\Models\UNEG\Sede', 'Sede')

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        html {
            font-size: 10pt;
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        td {
            border: 1px solid black;
            padding: 0 0.5rem 0.5rem 0.5rem;
            text-align: left;
        }

        .no-border {
            border: none;
        }
    </style>
</head>
<body style="padding: 1rem;">
    <table style="font-size: 0.9rem; padding-top: 0;">
        <tr>
            <td colspan="12" style="text-align: center; font-size: 1.2rem;" class="no-border">
                <img style="margin-left: 10rem; width: 50rem;" src="{{ public_path('/storage/configuraciones/header.png') }}" alt="">
                    {{-- <img style="margin-left: 5rem; width: 40rem;" src="{{ asset('/storage/configuraciones/header.png') }}" alt=""> --}}
            </td>
        </tr>
        <tr>
            <td colspan="12" style="text-align: center; font-size: 1.2rem;" class="no-border">SOLICITUD DE INSCRIPCIÓN</td>
        </tr>
        <tr>
            <td colspan="6" style="text-align: center; font-size: 0.8rem;" class="no-border">INGRESO</td>
            <td colspan="6" style="text-align: center; font-size: 0.8rem;" class="no-border">REINGRESO</td>
        </tr>
        <tr>
            <td colspan="6" style="border-bottom: none;">APELLIDOS Y NOMBRES:</td>
            <td colspan="3" style="border-bottom: none;">CÉDULA DE IDENTIDAD:</td>
            <td colspan="3" style="border-bottom: none;">FECHA DE NACIMIENTO: </td>
        </tr>
        <tr>
            <td colspan="6" style="border-top: none;"></td>
            <td colspan="3" style="border-top: none;"></td>
            <td colspan="3" style="border-top: none;"></td>
        </tr>
        <tr>
            <td colspan="5" style="border-bottom: none;">NRO. DE FICHA:</td>
            <td colspan="4" style="border-bottom: none;">TELF. HABITACIÓN:</td>
            <td colspan="3" style="border-bottom: none;">TELF. MÓVIL: </td>
        </tr>
        <tr>
            <td colspan="5" style="border-top: none;"></td>
            <td colspan="4" style="border-top: none;"></td>
            <td colspan="3" style="border-top: none;"></td>
        </tr>
        <tr>
            <td colspan="8" style="border-bottom: none;">CORREO ELECTRÓNICO:</td>
            <td colspan="4" style="border-bottom: none;">CARGO:</td>
        </tr>
        <tr>
            <td colspan="8" style="border-top: none;"></td>
            <td colspan="4" style="border-top: none;"></td>
        </tr>
        <tr>
            <td colspan="12" style="font-weight: bold; text-align: center;">DATOS BANCARIOS</td>
        </tr>
        <tr>
            <td colspan="3" style="border-bottom: none;">BANCO</td>
            <td colspan="2" rowspan="2">TIPO DE CUENTA:</td>
            <td colspan="1">A</td>
            <td colspan="1"></td>
            <td colspan="5" style="border-bottom: none;">NRO. DE CUENTA: (20 dígitos)</td>
        </tr>
        <tr>
            <td colspan="4" style="border-top: none;"></td>
            <td colspan="1">C</td>
            <td colspan="1"></td>
            <td colspan="5" style="border-top: none;"></td>
        </tr>
        <tr>
            <td colspan="12" style="font-weight: bold; text-align: center;">TIPO DE NÓMINA</td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center;">ADMINISTRATIVO</td>
            <td></td>
            <td colspan="2" style="text-align: center;">DOCENTE</td>
            <td></td>
            <td colspan="2" style="text-align: center;">OBRERO</td>
            <td></td>
            <td colspan="2" style="text-align: center;">OBRERO-VIGILANTE</td>
            <td></td>
        </tr>
        <tr>
            <td colspan="12" style="font-weight: bold; text-align: center;">ESTATUS DEL PERSONAL</td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center;">ACTIVO</td>
            <td></td>
            <td colspan="2" style="text-align: center;">JUBILADO</td>
            <td></td>
            <td colspan="2" style="text-align: center;">PENSIONADO</td>
            <td></td>
            <td colspan="2" style="text-align: center;">INCAPACITADO</td>
            <td></td>
        </tr>
        <tr>
            <td colspan="12" style="text-align: center;"><span style="font-weight: bold;">UBICACIÓN</span> (Sede donde labora)</td>
        </tr>
        @foreach (Sede::all()->chunk(4) as $chunks)
            <tr>
                @foreach ($chunks as $sede)
                    <td colspan="2">{{ $sede->nombre }}</td>
                    <td></td>
                @endforeach
            </tr>
        @endforeach
        <tr>
            <td colspan="12" style="font-weight: bold; text-align: center; border-bottom: none;">AUTORIZACIÓN</td>
        </tr>
        <tr>
            <td colspan="12" style="padding: 0.5rem; text-align: justify; border-top: none; border-bottom: none;">
                SOLICITO FORMALMENTE A LA JUNTA DIRECTIVA DE LA CAJA DE AHORROS Y PREVICIÓN SOCIAL DE LOS TRABAJADORES DE LA UNIVERSIDAD NACIONAL EXPERIMENTAL DE GUAYANA (CAUNEG), MI INSCRIPCIÓN COMO ASOCIADO DE LA MISMA, CON PLENOS DERECHOS DE DISFRUTAR DE LOS BENEFICIOS QUE DICHA ASOCIACIÓN BRINDA A SUS ASOCIADOS Y COMPROMETIÉNDOME A ACEPTAR, CUMPLIR Y VELAR POR EL CUMPLIMIENTO DE LAS LEYES, ESTATUTOS, NORMAS Y PROCEDIMIENTOS PAUTADOS, QUE RIGEN A ESTA ASOCIACIÓN.
            </td>
        </tr>
        <tr>
            <td colspan="12" style="padding: 0.5rem; text-align: justify; border-top: none; border-bottom: none;">POR TAL MOTIVO, AUTORIZO A CAUNEG A QUE SE SIRVA DESCONTAR DE MI SUELDO LA CUOTA CORRESPONDIENTE.</td>
        </tr>
        <tr>
            <td colspan="6" style="text-align: center; padding: 1rem 1rem 0.5rem 1rem; border-top: none; border-right: none;">
                ____________________________________
                <br>
                FIRMA
            </td>
            <td colspan="6" style="text-align: center; padding: 1rem 1rem 0.5rem 1rem; border-top: none; border-left: none;">
                __________/__________/__________
                <br>
                FECHA
            </td>
        </tr>
        <tr>
            <td colspan="12" style="text-align: center; font-weight: bold;">(SOLO PARA USO DE CAUNEG)</td>
        </tr>
        <tr>
            <td style="font-size: 0.9rem;" colspan="2">APROBADO:</td>
            <td style="font-size: 0.9rem;">SI</td>
            <td style="font-size: 0.9rem;">NO</td>
            <td style="font-size: 0.9rem;" colspan="2">FECHA:</td>
            <td style="font-size: 0.9rem;" colspan="6">DESCONTAR POR NÓMINA A PARTIR DEL:</td>
        </tr>
        <tr>
            <td colspan="12" style="border-top: none; border-bottom: none;">OBSERVACIONES:</td>
        </tr>
        <tr>
            <td colspan="12" style="padding: 1.5rem; border-top: none;"></td>
        </tr>
    </table>
</body>
</html>
