#!/bin/bash

echo "Starting Laravel deployment build..."

php artisan config:clear
php artisan cache:clear
php artisan config:cache
php artisan migrate --force

echo "Build completed."
