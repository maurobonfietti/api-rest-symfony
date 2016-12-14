# api-rest-symfony

Api Rest With Symfony...


## HOW TO INSTALL:

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


## MODO DE USO:

- Ver Usuarios:
```
$ curl http://localhost:8000/users
```


- Ver Usuario por Id:
```
$ curl http://localhost:8000/users/1
```


- Crear Nuevo Usuario:
```
$ curl -X POST http://localhost:8000/users/ -d '{"name":"Luis"}' -H 'Content-Type: application/json'
```


- Actualizar Usuario:
```
$ curl -X PUT http://localhost:8000/users/1 -d '{"name":"Lucas","email":"lucas@gmail.com"}' -H 'Content-Type: application/json'
```


- Eliminar Usuario:
```
$ curl -X DELETE http://localhost:8000/users/2
```

