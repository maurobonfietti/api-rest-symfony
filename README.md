# API REST SYMFONY

Un ejemplo de API REST con Symfony3.


## INSTALACIÓN:

En la ruta preferida, descargar el proyecto:

```
$ git clone https://github.com/maurobonfietti/api-rest-symfony.git
$ cd api-rest-symfony/
$ composer install
$ php bin/console doctrine:database:create
$ php bin/console doctrine:schema:update --force
$ php bin/console doctrine:fixtures:load
$ php bin/console server:start
$ phpunit
```

===

## MODO DE USO:


### Ver usuarios:
```
$ curl http://localhost:8000/users
```
Respuesta:
```
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
$ curl http://localhost:8000/countusers
```
Respuesta:
```
Status: 200 OK

"Cantidad de usuarios: 32"
```
