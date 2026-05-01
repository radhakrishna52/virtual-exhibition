#!/bin/bash
set -e

# Use Railway's PORT or default to 80
PORT="${PORT:-80}"

# Update Apache to listen on the correct port
sed -i "s/Listen 80/Listen $PORT/" /etc/apache2/ports.conf
# Update all instances of port 80 to the dynamic port in site configs
find /etc/apache2/sites-enabled/ -type f -exec sed -i "s/:80/:$PORT/g" {} +

echo "Starting Apache on port $PORT"
exec "$@"
