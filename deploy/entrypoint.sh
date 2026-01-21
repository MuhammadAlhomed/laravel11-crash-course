#!/bin/sh
set -e

echo "Laravel init starting..."

# Create .env if missing
if [ ! -f .env ]; then
  if [ -f .env.custom ]; then  
    echo "Creating .env from ConfigMap"
    cp .env.custom .env
  else
    echo "No .env specified!"
  fi
fi

echo "Loading environment variables from .env file..."
set -a # automatically export all variables
source .env
set +a

# Generate APP_KEY if missing
if [ -z "$APP_KEY" ]; then
  echo "Generating APP_KEY..."
  php artisan key:generate --force
fi

# SQLite database
DB_FILE="${DB_DATABASE:-storage/database.sqlite}"

if [ ! -f "$DB_FILE" ]; then
  echo "Creating SQLite database at $DB_FILE..."
  mkdir -p "$(dirname "$DB_FILE")"
  touch "$DB_FILE"
fi

echo "Ensuring Laravel cache directories exist..."
mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views

# Storage link
if [ ! -L public/storage ]; then
  echo "Creating storage symlink..."
  php artisan storage:link || true
fi

# Optional migrations and optimizations
if [ "$RUN_MIGRATIONS" = "true" ]; then
  echo "Running optimizations..."
  php artisan optimize:clear
  echo "Running migrations..."
  php artisan migrate --force
fi

echo "Starting reverb server..."
php artisan reverb:start --host=0.0.0.0 --port=6001 &

echo "Laravel init done!"

exec "$@"