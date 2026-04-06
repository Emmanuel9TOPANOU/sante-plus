FROM php:8.2-fpm

# Installation des dépendances système (Correction du -y)
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libpq-dev \
    libzip-dev

# Nettoyage du cache pour réduire la taille de l'image
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Installation des extensions PHP nécessaires à Laravel et PostgreSQL
RUN docker-php-ext-install pdo_pgsql mbstring exif pcntl bcmath gd zip

# Installation de Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
COPY . .

# Installation des dépendances Laravel
RUN composer install --no-dev --optimize-autoloader

# Commande de lancement pour Render
CMD php artisan serve --host=0.0.0.0 --port=$PORT