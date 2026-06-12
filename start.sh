#!/bin/sh

set -e

cd /app

if [ ! -f .env ]; then
    echo "📄 Creating .env from .env.docker..."
    cp .env.docker .env
fi

if ! grep -q "APP_KEY=" .env || [ "$(grep 'APP_KEY=' .env | cut -d= -f2)" = "" ]; then
    echo "🔑 Generating APP_KEY..."
    php artisan key:generate --force
fi

# Ensure Docker-compatible DB settings
if grep -q '^DB_HOST=' .env; then
    sed -i 's/^DB_HOST=.*/DB_HOST=mongodb/' .env
else
    echo 'DB_HOST=mongodb' >> .env
fi
if grep -q '^DB_PORT=' .env; then
    sed -i 's/^DB_PORT=.*/DB_PORT=27017/' .env
fi
echo "🔧 Docker environment configured (DB_HOST=mongodb)"

echo "📦 Installing Composer dependencies..."
composer install --no-interaction --prefer-dist --no-dev

echo "📦 Installing npm dependencies..."
npm install

echo "🏗️  Building assets..."
npm run build

echo "🌱 Running seeders..."
php artisan db:seed --force 2>/dev/null || echo "⚠️  Seeder skipped (might already be seeded)"

echo "🚀 Starting Laravel at http://0.0.0.0:8000"
exec php artisan serve --host=0.0.0.0 --port=8000
