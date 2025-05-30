#!/bin/bash

# Run composer install
composer install --no-interaction --no-dev --prefer-dist

# Make sure data directories are writable
mkdir -p storage/logs
chmod -R 775 storage
chmod -R 775 src/Models/Data

# Clear any caches
php -r "opcache_reset();" 2>/dev/null || true

echo "Deployment preparation complete!"
