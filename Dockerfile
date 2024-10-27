# Utiliser une image PHP avec FPM
FROM php:8.1-fpm

# Installer les dépendances système et les extensions PHP
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    libsqlite3-dev \
    && docker-php-ext-install zip pdo_sqlite \
    && docker-php-ext-install pdo mbstring

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copier les fichiers de l'application
COPY . /var/www/html

# Changer le répertoire de travail
WORKDIR /var/www/html

# Supprimer le cache de Composer
RUN composer clear-cache

# Installer les dépendances PHP
RUN composer install --optimize-autoloader --no-dev

# Changer les permissions du dossier storage et cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Exposer le port 80
EXPOSE 80

# Commande pour démarrer le serveur PHP
CMD php artisan serve --host=0.0.0.0 --port=80
