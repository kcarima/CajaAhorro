@use('App\Models\UNEG\Sede', 'Sede')
@inject('configuracion', 'App\Repositories\SCA\ConfiguracionRepository')

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
    <table style="font-size: 1rem; padding-top: 0;">
        <tr>
            <td colspan="12" style="text-align: center; font-size: 1.2rem;" class="no-border">
                <img style="margin-left: 10rem; width: 50rem;" src="{{ public_path('/storage/configuraciones/header.png') }}" alt="">
                    {{-- <img style="margin-left: 5rem; width: 40rem;" src="{{ asset('/storage/configuraciones/header.png') }}" alt=""> --}}
            </td>
        </tr>
        <tr>
            <td colspan="12" style="text-align: center; line-height: 3.8;" class="no-border">PLANILLA DECLARACIÓN DE BENEFICIARIOS DE MONTEPIO</td>
        </tr>
        <tr>
            <td colspan="12" style="text-align: justify; line-height: 3.8;" class="no-border">YO, __________ PORTADOR (A) DE LA CEDULA DE IDENTIDAD N° __________, DECLARO ANTE EL CONSEJO DE ADMINISTRACIÓN DE LA CAJA DE AHORROS Y PREVISION SOCIAL DE LOS TRABAJADORES DE LA UNIVERSIDAD NACIONAL EXPERIMENTAL  DE GUAYANA (CAUNEG), QUE LAS PERSONAS ABAJO SEÑALADAS SERAN LOS UNICOS Y LEGITIMOS BENEFICIARIOS DEL MONTEPIO QUE OTORGA CAUNEG A SUS ASOCIADOS, DE ACUERDO A LO ESTABLECIDO EN EL ARTÍCULO N° 100  VIGENTE DE LOS ESTATUTOS. QUE DICE:</td>
        </tr>
        <tr>
            <td colspan="12" style="text-align: justify; line-height: 3.8;" class="no-border">“En caso de fallecimiento de algunos de los miembros de CAUNEG, cada asociado contribuirá con el 0,5% sueldo integral, el cual será descontado mediante una sola cuota.”</td>
        </tr>
        <tr>
            <td colspan="3">APELLIDOS Y NOMBRES</td>
            <td colspan="3">CEDULA N°</td>
            <td colspan="3">PARENTESCO</td>
            <td colspan="3">% DE ADJUDICACIÓN</td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td colspan="3"></td>
            <td colspan="3"></td>
            <td colspan="3"></td>
        </tr>
        <tr>
            <td colspan="12" class="no-border" style="padding: 10rem 10rem 2rem 10rem; text-align: center;">Firma: __________</td>
        </tr>
        <tr>
            <td colspan="12" class="no-border" style="padding: 0 10rem 2rem 10rem; text-align: center;">Cédula: __________</td>
        </tr>
        <tr>
            <td colspan="12" class="no-border">
                <hr>
            </td>
        </tr>
        <tr>
            <td colspan="12" class="no-border" style="text-align: center; color: #959595">{{ $configuracion->get('Direccion') }} - Telf. {{ $configuracion->get('Telefono') }} - E-mail: {{ $configuracion->get('Email') }}</td>
        </tr>
        <tr>
            <td colspan="12" class="no-border" style="text-align: center; color: #959595">{{ $configuracion->get('Ciudad') }} - {{ $configuracion->get('Estado')}}</td>
        </tr>
    </table>
</body>
</html>
