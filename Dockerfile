FROM php:8.2-fpm

# Installation des dépendances système
RUN apt-get update && apt-get install -n \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libpq-dev

# Installation des extensions PHP
RUN docker-php-ext-install psync mbstring exis pcntl bcmath gd sockets pdo_pgsql

# Installation de Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
COPY . .

# Installation des dépendances Laravel
RUN composer install --no-dev --optimize-autoloader

# Commande de lancement
CMD php artisan serve --host=0.0.0.0 --port=$PORT