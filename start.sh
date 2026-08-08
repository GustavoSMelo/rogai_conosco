#!/bin/sh

set -e

until php artisan tinker --execute="DB::connection()->getPdo()"; do
    echo "Waiting for database..."
    sleep 2
done

echo "Connected to database"
php artisan config:clear
php artisan migrate --seed --force
php artisan cache:clear
php artisan view:clear

# Generate encrypted dashboard password from DASHBOARD_PLAIN_PASSWORD or interactive prompt
if [ -t 0 ] && [ -z "${DASHBOARD_PLAIN_PASSWORD}" ]; then
    printf "Enter dashboard password: "
    stty -echo 2>/dev/null
    read DASHBOARD_PLAIN_PASSWORD
    stty echo 2>/dev/null
    printf "\n"
fi

if [ -n "${DASHBOARD_PLAIN_PASSWORD}" ]; then
    echo "Generating encrypted dashboard password..."
    ENCRYPTED=$(php artisan dashboard:password "${DASHBOARD_PLAIN_PASSWORD}" | sed -n 's/^DASHBOARD_PASSWORD=//p')
    if [ -n "${ENCRYPTED}" ]; then
        sed -i "s|^DASHBOARD_PASSWORD=.*|DASHBOARD_PASSWORD=${ENCRYPTED}|" .env
        echo "Dashboard password updated in .env"
    fi
fi

(while true; do
  php artisan schedule:run --no-interaction
  sleep 60
done) &

php-fpm -D
nginx -g "daemon off;"
