# Gunakan image PHP 8.0 CLI yang lebih ringan
FROM php:8.0-cli

# Install dependencies dan ekstensi PHP
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libsqlite3-dev \
    libzip-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    zip \
    unzip \
    sqlite3 \
    git && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install mysqli mbstring pdo pdo_sqlite zip gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER=1

# Salin semua file proyek
COPY . /var/www/html/
WORKDIR /var/www/html

# Install dependencies via Composer
RUN composer install --no-dev --optimize-autoloader

# Pastikan folder database, logs, dan assets bisa diakses
RUN mkdir -p application/database application/logs application/cache && \
    chmod -R 777 application/database application/logs application/cache && \
    chmod -R 755 assets

# Jalankan setup database dummy saat build
RUN php setup_demo.php

# Gunakan PHP Built-in Server agar tidak ada konflik Apache/MPM
CMD php -S 0.0.0.0:$PORT index.php
