# Utiliser une image PHP avec FPM
FROM php:8.2-fpm

# Installer les dépendances système et les extensions PHP requises par Laravel
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    libsqlite3-dev \
    libonig-dev \
    libcurl4-openssl-dev \
    pkg-config \
    libssl-dev \
    && docker-php-ext-install zip pdo_sqlite mbstring curl

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copier les fichiers de l'application
COPY . /var/www/html

# Changer le répertoire de travail
WORKDIR /var/www/html

# Supprimer le cache de Composer
RUN composer clear-cache

# Installer les dépendances PHP avec Composer
RUN composer install --optimize-autoloader --no-dev

#ajouter une base de données
RUN touch /var/www/html/database/database.sqlite


# Changer les permissions du dossier storage et cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Exposer le port 80
EXPOSE 80

# Commande pour démarrer le serveur PHP
CMD php artisan serve --host=0.0.0.0 --port=80
