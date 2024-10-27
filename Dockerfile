# Utiliser une image PHP avec FPM
FROM php:8.2-fpm

# Installer Node.js et npm
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

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

# Créer le fichier .env à partir de .env.example
RUN cp .env.example .env

# Supprimer le cache de Composer
RUN composer clear-cache

# Installer les dépendances PHP avec Composer
RUN composer install --optimize-autoloader --no-dev

# Installer les dépendances npm et compiler les assets
RUN npm install
RUN npm run build

# Générer la clé d'application
RUN php artisan key:generate

# Créer le dossier database s'il n'existe pas
RUN mkdir -p /var/www/html/database

# Créer et configurer la base de données SQLite
RUN touch /var/www/html/database/database.sqlite
RUN chmod 777 /var/www/html/database/database.sqlite

# Changer les permissions des dossiers importants
RUN chown -R www-data:www-data /var/www/html/storage \
    /var/www/html/bootstrap/cache \
    /var/www/html/database \
    /var/www/html/public/build

# Optimiser Laravel
RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:cache

# Exécuter les migrations
RUN php artisan migrate --force

# Exposer le port 80
EXPOSE 80

# Créer un script d'entrée
COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Utiliser le script d'entrée
ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]