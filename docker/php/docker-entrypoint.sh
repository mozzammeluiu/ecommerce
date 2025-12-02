#!/bin/sh
set -e

# If .env missing, try to copy from .env.example
if [ ! -f /var/www/html/.env ]; then
  if [ -f /var/www/html/.env.example ]; then
    cp /var/www/html/.env.example /var/www/html/.env
    echo "Copied .env.example to .env"
  else
    echo ".env and .env.example not found"
  fi
fi

# Ensure permissions for runtime
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache || true
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache || true

# Install composer dependencies (if composer.json exists)
# Skip composer install at runtime to avoid script errors; dependencies are installed at build time.

# Generate app key if artisan exists
if [ -f /var/www/html/artisan ]; then
  php /var/www/html/artisan key:generate --force || true
  # Try to run package discovery explicitly; ignore failures
  php /var/www/html/artisan package:discover || true
fi

exec "$@"
