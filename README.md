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


## MODO DE USO:

- Ver usuarios:
```
$ curl http://localhost:8000/users
```


- Ver usuario por Id:
```
$ curl http://localhost:8000/users/1
```


- Crear nuevo usuario:
```
$ curl -X POST http://localhost:8000/users/ -d '{"name":"Luis"}' -H 'Content-Type: application/json'
```


- Actualizar usuario:
```
$ curl -X PUT http://localhost:8000/users/1 -d '{"name":"Lucas","email":"lucas@gmail.com"}' -H 'Content-Type: application/json'
```


- Eliminar usuario:
```
$ curl -X DELETE http://localhost:8000/users/2
```


- Ver cantidad de usuarios:
```
$ curl http://localhost:8000/countusers
```
