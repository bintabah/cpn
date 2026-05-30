#!/bin/bash
set -e

if [ "$DB_CONNECTION" = "mysql" ]; then
    echo "==> Waiting for MySQL to be ready..."
    until php -r "
        try {
            new PDO(
                'mysql:host=' . getenv('DB_HOST') . ';port=' . getenv('DB_PORT'),
                getenv('DB_USERNAME'),
                getenv('DB_PASSWORD')
            );
            exit(0);
        } catch (Exception \$e) {
            exit(1);
        }
    " 2>/dev/null; do
        echo "    MySQL not ready yet, retrying in 3s..."
        sleep 3
    done
    echo "==> MySQL is ready."
fi

echo "==> Fixing storage permissions..."
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

echo "==> Caching config..."
php artisan config:cache

echo "==> Starting Apache..."
exec "$@"
