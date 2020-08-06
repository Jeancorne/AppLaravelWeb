AppLaravelWeb es una solucion que permite ejecutar CRUD para clientes y usuarios con roles de administrador y vendedor bajo el framework de Laravel.

Al descargar el proyecto se debe ejecutar por consola, los siguientes códigos en orden:
< composer install >,
< composer run post-root-package-install >,
< php artisan migrate >,
< php artisan key:generate >,
< php artisan config:cache >,
< php artisan cache:clear >,
< php artisan serve >
Instala composer, crea el archivo .env, hace la migraciones de las tablas, genera la key de acceso, limpia cache y ejecuta servidor.
Antes hacer el migrate, se debe crear una base de datos en el motor MYSQL llamada: dbproyectolaravel.
