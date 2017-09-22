#!/usr/bin/env bash

docker-compose exec php bash -c "compose install"
docker-compose exec php bash -c "php artisan key:generate"
docker-compsoe exec php bash -c "php artisan migrate"
docker-compose exec php bash -c "php artisan vendor:publish"
