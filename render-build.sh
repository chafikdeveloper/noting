#!/usr/bin/env bash
# Exit on error
set -o errexit

npm install
npm run build
composer install --no-dev --optimizer-autoloader
php artisan config:cache
php artisan route:cache
php artisan migrate --force
