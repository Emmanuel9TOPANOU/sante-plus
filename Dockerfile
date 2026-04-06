FROM php:8.2-fpm

# Installation des dépendances système nécessaires
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

# Installation des extensions PHP pour Laravel et PostgreSQL
RUN docker-php-ext-install pdo_pgsql mbstring exif pcntl bcmath gd zip

# Installation de Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
COPY . .

# Installation des dépendances PHP uniquement (On saute la compilation JS pour l'instant)
RUN composer install --no-dev --optimize-autoloader

# On donne les permissions aux dossiers de stockage (Très important pour Laravel)
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Commande de lancement officielle pour Render
CMD php artisan serve --host=0.0.0.0 --port=$PORT