#!/bin/bash

time for i in {1..500} ; do echo $i ; curl http://localhost/proyectos/api-rest-symfony/web/users ; done

exit 0
