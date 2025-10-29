#!/bin/bash
# Script to set up Laravel Breeze authentication with Sail

# Navigate to project directory
cd "$(dirname "$0")"

# Install Laravel Breeze
./vendor/bin/sail composer require laravel/breeze --dev

# Install Breeze scaffolding
./vendor/bin/sail artisan breeze:install

# Install npm dependencies and build assets
./vendor/bin/sail npm install
./vendor/bin/sail npm run dev

# Run migrations
./vendor/bin/sail artisan migrate

echo "Laravel Breeze authentication setup completed."
