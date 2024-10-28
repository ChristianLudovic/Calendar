# Utiliser une image PHP avec FPM
FROM php:8.2-fpm

# Installer Node.js et npm de manière plus fiable
RUN apt-get update && apt-get install -y ca-certificates curl gnupg
RUN mkdir -p /etc/apt/keyrings
RUN curl -fsSL https://deb.nodesource.com/gpgkey/nodesource-repo.gpg.key | gpg --dearmor -o /etc/apt/keyrings/nodesource.gpg
RUN echo "deb [signed-by=/etc/apt/keyrings/nodesource.gpg] https://deb.nodesource.com/node_18.x nodistro main" | tee /etc/apt/sources.list.d/nodesource.list
RUN apt-get update && apt-get install -y nodejs

# Installer les dépendances système et les extensions PHP
RUN apt-get install -y \
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

# Créer le fichier .env et le configurer
COPY .env.example .env
RUN sed -i 's/APP_ENV=local/APP_ENV=production/' .env
RUN sed -i 's/APP_DEBUG=true/APP_DEBUG=false/' .env

# Installer les dépendances PHP
RUN composer install --optimize-autoloader --no-dev

# Installer et configurer Tailwind
RUN npm install
RUN npm install -D tailwindcss postcss autoprefixer
RUN npx tailwindcss init -p

# Construction des assets
RUN npm run build

# Générer la clé d'application
RUN php artisan key:generate

# Configuration de la base de données
RUN mkdir -p /var/www/html/database
RUN touch /var/www/html/database/database.sqlite
RUN chmod 777 /var/www/html/database/database.sqlite

# Exécuter les migrations d'abord
RUN php artisan migrate --force


# Maintenant les optimisations Laravel
RUN php artisan view:clear
RUN php artisan route:clear
RUN php artisan config:clear
RUN php artisan cache:clear
RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:cache

# Permissions
RUN chown -R www-data:www-data /var/www/html/storage \
    /var/www/html/bootstrap/cache \
    /var/www/html/database \
    /var/www/html/public

# Script d'entrée
RUN echo '#!/bin/bash\n\
php artisan migrate --force\n\
php artisan serve --host=0.0.0.0 --port=80' > /usr/local/bin/docker-entrypoint.sh

RUN chmod +x /usr/local/bin/docker-entrypoint.sh

EXPOSE 80

ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]