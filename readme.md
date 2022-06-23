# Introduction

**Link to Teamwork project**

## ROX team

| Name           | Role         |
| -------------- | ------------ |
| someone@rox.nl | Developer    |
| colin@rox.nl   | Scrum master |

# Installation

```bash
git clone git@github.com:roxdigital/<repo>.git
cd <repo>
cp .env.<setup type>.example .env
```

## Project-specific .env keys

```bash

```

## Laravel Sail (Docker)

```bash
docker run --rm \
  -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs

# Run this only if there isn't already a docker-compose.yml file in the project root!
./vendor/bin/sail install
```

You will now have to indicate the services that you'll be using.

```bash
./vendor/bin/sail up
```

Make sure to update the [.env](./.env) with the right credentials, and set the `DB_HOST` to `mysql`.
Enter the following commands in a new terminal window:

```bash
./vendor/bin/sail artisan key:generate
./vendor/bin/sail artisan migrate:fresh --seed
./vendor/bin/sail npm ci
./vendor/bin/sail npm run dev
```

More information about the Laravel Sail setup can be found in this repo's [laravel sail](./docs/base-repo/laravel-sail.md) documentation.

## Devcontainer

Follow the instructions in the Laravel Sail section. Afterwards you will have to run "Remote-Containers: Attach to Running Container..." from the VSCode command pallette.

More information about devcontainers can be found in this repo's [devcontainer documentation](./docs/base-repo/devcontainer.md).

## Laravel Valet

```bash
valet secure
valet use php@8.1
composer install
php artisan key:generate
php artisan migrate:fresh --seed
npm ci
npm run dev
valet open
```

## Deployment with Forge

```bash
# Change to the project directory
cd $FORGE_SITE_PATH

# Turn on maintenance mode
php artisan down || true

# Pull the latest changes from the git repository
git pull origin $FORGE_SITE_BRANCH

# Install/update composer dependencies without dev dependencies.
composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev

# Restart FPM
( flock -w 10 9 || exit 1
    echo 'Restarting FPM...'; sudo -S service $FORGE_PHP_FPM reload ) 9>/tmp/fpmlock

# Run database migrations
php artisan migrate --force

# Refresh caches
php artisan cache:clear
php artisan auth:clear-resets
php artisan route:cache
php artisan config:cache
php artisan view:cache

# Install node_modules
npm ci

# Build assets using Laravel Mix
npm run production

# Turn off maintenance mode
php artisan up
```

Contact [leon@rox.nl](mailto:leon@rox.nl) to have the pipelines set up.

# Base repository

This repository was based on the [Base Laravel repository](https://github.com/roxdigital/base-laravel-template). More information about its features can be found at [docs/base-repo/readme.md](docs/base-repo/readme.md).
