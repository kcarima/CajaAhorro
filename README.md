# Sistema de Caja de Ahorros
Sistema de Caja de Ahorros hecho en Laravel 10.

## Indice
- [Dependencias](#dependencias)
- [Instrucciones de instalacion](#instrucciones-para-instalar)
- [Ejecución](#ejecución)

## Dependencias
- PHP >= 8.3
- Composer >= 2.4.1
- Laravel >= 11
- NodeJS >= 22.0

## Instrucciones para instalar
- Clona el repositorio a tu computadora
- En la carpeta del proyecto abre una consola y ejecuta el siguiente comando => `composer install`
- Luego ejecutamos el siguiente comando => `npm install`
- Ahora debemos crear el archivo .env para eso ejecutamos el siguiente comando => `cp .env.example .env`
- En el archivo .env que se acaba de crear se debe configurar la base de datos.
- Debemos generar la llave de encriptacion de la app que se realiza con el siguiente comando => `php artisan key:generate`
- Por último ejecutamos => `npm run dev `

## Ejecución
Con una consola en la carpeta del proyecto ejecutamos => `php artisan serve`
Lo que iniciara el servidor de desarrollo, una vez iniciado entramos desde la url proporcionada por el servidor de pruebas.
