# Utiliser une image PHP avec les extensions nécessaires
FROM php:8.1-fpm

# Installer les dépendances
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install zip pdo_sqlite

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copier les fichiers de l'application
COPY . /var/www/html

# Changer le répertoire de travail
WORKDIR /var/www/html

# Installer les dépendances PHP
RUN composer install --optimize-autoloader --no-dev

# Changer les permissions du dossier storage
RUN chown -R www-data:www-data /var/www/html/storage

# Exposer le port 80
EXPOSE 80

# Commande pour démarrer le serveur PHP
CMD php artisan serve --host=0.0.0.0 --port=80
