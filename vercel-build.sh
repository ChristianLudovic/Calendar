#!/bin/bash

echo "Installing dependencies"
npm ci

echo "Building the application"
npm run build

echo "Setting up Laravel"
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Build completed"