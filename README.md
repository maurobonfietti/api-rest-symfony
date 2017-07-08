# API REST SYMFONY

Un ejemplo de API REST con Symfony3.


## INSTALACIÓN:

En la ruta preferida, descargar el proyecto:

```bash
$ git clone https://github.com/maurobonfietti/api-rest-symfony.git
$ cd api-rest-symfony/
$ composer install
```


Crear base de datos, actualizar schema y completar con datos de prueba:

```bash
$ php bin/console doctrine:database:create
$ php bin/console doctrine:schema:update --force
$ php bin/console doctrine:fixtures:load
```

### CONEXIÓN MYSQL:
Si se observa algún error al crear/conectar la base de datos, hay que configurar la conexión MySQL.<br />
Completar con el **usuario** y **password** de **MySQL**.<br />
Editar el archivo de configuración: `app/config/parameters.yml`
```
parameters:
    database_host: 127.0.0.1
    database_port: null
    database_name: api-rest-symfony
    database_user: YourDatabaseUser
    database_password: YourDatabasePass
```


## PRUEBAS:

Dentro de la raíz del proyecto, iniciar el servidor web interno de PHP y ejecutar las pruebas con `phpunit`:

```bash
$ phpunit

PHPUnit 5.4.6 by Sebastian Bergmann and contributors.

.....                                                               5 / 5 (100%)

Time: 1.09 seconds, Memory: 14.00Mb

OK (5 tests, 13 assertions)

```

### NOTA:
Se puede iniciar el servidor web interno de PHP ejecutando:

```bash
$ php bin/console server:start
```

Si todo salió bien, ya se puede comenzar a utilizar la API :smiley:. <br />
Se puede acceder localmente al proyecto, ingresando a tu [localhost](http://localhost:8000/users).


## MODO DE USO:


### Ver usuarios:
```
$ curl http://localhost:8000/users
```
Respuesta:
```
Status: 200 OK

[
    {
        "id": 1,
        "name": "Mago",
        "email": "marquitos@gmail.com"
    },
    {
        "id": 3,
        "name": "Mirta García"
    },
    {
        "id": 4,
        "name": "Ignacio Luna"
    },
    {
        "id": 5,
        "name": "Antonio Díaz"
    },
    {
        "id": 6,
        "name": "Mirta Gómez",
        "email": "mirtagomez74@gomez.com.ar"
    }
]
```


### Ver usuario por Id:
```
$ curl http://localhost:8000/users/3
```
Respuesta:
```
Status: 200 OK

{
    "id": 3,
    "name": "Mirta García"
}
```


### Crear nuevo usuario:
```
$ curl -X POST http://localhost:8000/users/ -d '{"name":"Luis"}' -H 'Content-Type: application/json'
```
Respuesta:
```
Status: 200 OK

"El usuario fue creado correctamente."
```


### Actualizar usuario:
```
$ curl -X PUT http://localhost:8000/users/1 -d '{"name":"Lucas","email":"lucas@gmail.com"}' -H 'Content-Type: application/json'
```
Respuesta:
```
Status: 200 OK

"El usuario fue actualizado correctamente."
```


### Eliminar usuario:
```
$ curl -X DELETE http://localhost:8000/users/2
```
Respuesta:
```
Status: 200 OK

"El usuario fue eliminado correctamente."
```


### Ver cantidad de usuarios:
```
$ curl http://localhost:8000/users/count
```
Respuesta:
```
Status: 200 OK

"Cantidad de usuarios: 32"
```


### Ver versión de la API:
```
$ curl http://localhost:8000/version
```
Respuesta:
```
Status: 200 OK

"Version API: 0.1.3"
```
