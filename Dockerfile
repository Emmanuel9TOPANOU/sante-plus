FROM php:8.2-fpm

# Installation des dépendances système et de Node.js (pour Vite/Tailwind)
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev zip unzip libpq-dev libzip-dev \
    && curl -sL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Installation des extensions PHP
RUN docker-php-ext-install pdo_pgsql mbstring exif pcntl bcmath gd zip

# Installation de Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
COPY . .

# Installation des dépendances PHP et JS + Build des assets
RUN composer install --no-dev --optimize-autoloader \
    && npm install \
    && npm run build

# Commande de lancement
CMD php artisan serve --host=0.0.0.0 --port=$PORT