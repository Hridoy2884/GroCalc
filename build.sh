#!/usr/bin/env bash
set -o errexit

# Install dependencies
composer install --no-dev --optimize-autoloader

# Set permissions
chmod -R 775 storage bootstrap/cache

# Generate the app key
php artisan key:generate

# Run migrations (only if needed)
# php artisan migrate --force
