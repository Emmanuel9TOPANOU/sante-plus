FROM php:8.2-fpm

# Installation des dépendances système indispensables
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

# Nettoyage du cache apt pour éviter les erreurs d'espace
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Installation des extensions PHP (Ajout de zip et pdo_mysql pour la compatibilité)
RUN docker-php-ext-install pdo_pgsql pdo_mysql mbstring exif pcntl bcmath gd zip

# Installation de la dernière version de Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
COPY . .

# Suppression du dossier vendor et du lock s'ils existent pour forcer une installation propre
RUN rm -rf vendor composer.lock

# Installation des dépendances avec ignorance des plateformes (évite l'erreur 2)
RUN composer install --no-dev --optimize-autoloader --no-interaction --ignore-platform-reqs

# Permissions pour Laravel
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Commande de lancement
CMD php artisan serve --host=0.0.0.0 --port=$PORT