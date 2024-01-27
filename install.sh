#!/bin/bash
docker-compose up --build -d
docker exec -t shab-app composer install --no-scripts
docker exec -t shab-app php artisan key:generate
    echo "Waiting 14 second for database container be ready ..."
    sleep 14
docker exec -t shab-app php artisan migrate --seed --force
docker exec -t shab-app chown -R $USER:www-data storage
docker exec -t shab-app chown -R $USER:www-data bootstrap/cache
