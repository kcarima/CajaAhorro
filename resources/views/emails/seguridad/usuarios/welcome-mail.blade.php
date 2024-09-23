<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bienvenido</title>
    <style>
        .button {
            display: inline-block;
            border: none;
            padding: 1rem 2rem;
            margin: 0;
            text-decoration: none;
            background: #0069ed;
            color: white !important;
            font-family: sans-serif;
            font-size: 1rem;
            cursor: pointer;
            text-align: center;
            -webkit-appearance: none;
            -moz-appearance: none;
        }

        .button:hover,
        .button:focus {
            background: #0053ba;
        }

    </style>
</head>

<body>
    <main
        style="border-radius: 1rem; padding: 1rem; width: 60%; margin-left: auto; margin-right: auto; display: flex; flex-direction:column; align-items:center">
        <header style="display: flex; justify-content: center;">
            <img style="width: 5rem;" src="{{ get_logo_sistema() }}" alt="logo cauneg">
        </header>
        <section style="font-size: 1.5rem;">
            <h1>Bienvenido a la caja de ahorros UNEG 🎉</h1>
            <p>Estimado {{ $nombre }}.</p>
            <p>Su registro ha sido realizado de manera exitosa.</p>
            <p>Puede ingresar al sistema con los siguientes datos: </p>
            <p>
                Usuario: {{ $usuario }}
                <br>
                Contraseña: {{ $password }}
            </p>
        </section>
        <a class="button" href="{{ route('login') }}">Acceder</a>
    </main>
</body>

</html>
