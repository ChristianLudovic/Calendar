#!/bin/bash

# Vérifier si la base de données existe
if [ ! -f /var/www/html/database/database.sqlite ]; then
    touch /var/www/html/database/database.sqlite
    chmod 777 /var/www/html/database/database.sqlite
fi

# Exécuter les migrations si nécessaire
php artisan migrate --force

# Démarrer le serveur
php artisan serve --host=0.0.0.0 --port=80