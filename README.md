# Laravel Project Setup with Sail

This Laravel project is set up using Laravel Sail for local development on Windows 11.

## Setup Instructions

1. Ensure you have Docker Desktop installed and running on your Windows machine.
2. Navigate to the project directory:
   ```
   cd laravel-project
   ```
3. Start Laravel Sail:
   ```
   ./vendor/bin/sail up -d
   ```
4. Access the application at:
   ```
   http://localhost
   ```
5. To stop Sail:
   ```
   ./vendor/bin/sail down
   ```

## Authentication Setup

To install Laravel Breeze for authentication scaffolding, run:
```
./vendor/bin/sail composer require laravel/breeze --dev
./vendor/bin/sail artisan breeze:install
./vendor/bin/sail npm install && npm run dev
./vendor/bin/sail artisan migrate
```

## Database

The default database is MySQL configured in the Sail environment.

## Notes

- Make sure Docker is running before starting Sail.
- Use Sail commands prefixed with `./vendor/bin/sail` inside the project directory.
