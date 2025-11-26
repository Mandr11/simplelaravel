#!/usr/bin/env bash
set -euo pipefail

cd /var/www/html || exit 1

# If vendor is missing or empty, run composer install
if [ ! -d vendor ] || [ -z "$(ls -A vendor 2>/dev/null || true)" ]; then
  echo "[entrypoint] vendor/ missing or empty — running composer install"
  composer install --prefer-dist --no-progress --no-suggest --no-interaction || true
fi

# If Vite manifest missing, build assets
if [ ! -f public/build/manifest.json ]; then
  echo "[entrypoint] public/build/manifest.json not found — building Vite assets"
  if command -v npm >/dev/null 2>&1; then
    npm install || true
    npm run build || true
  else
    echo "[entrypoint] npm not available — skipping asset build"
  fi
fi

# Ensure storage/bootstrap cache dirs exist and have correct permissions
mkdir -p storage framework bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache || true

# Clear compiled views and caches so stale compiled templates won't trigger errors
if command -v php >/dev/null 2>&1; then
  php artisan view:clear || true
  php artisan cache:clear || true
fi

# Drop to the real CMD
exec "$@"
