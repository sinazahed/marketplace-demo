#!/bin/bash
docker-compose up -d
docker-compose exec -T shab-app composer install --no-ansi --no-interaction --no-progress --prefer-dist
docker-compose exec -T app php artisan key:generate
docker-compose exec -T app php artisan migrate --force
docker-compose exec -T app php artisan migrate --force

