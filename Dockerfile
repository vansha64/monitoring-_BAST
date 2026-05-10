# Gunakan image PHP 8.0 CLI yang lebih ringan
FROM php:8.0-cli

# Install dependencies dan ekstensi PHP
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libsqlite3-dev \
    sqlite3 \
    git && \
    docker-php-ext-install mysqli mbstring pdo pdo_sqlite

# Salin semua file proyek
COPY . /var/www/html/
WORKDIR /var/www/html

# Pastikan folder database dan logs bisa ditulis
RUN mkdir -p application/database application/logs application/cache && \
    chmod -R 777 application/database application/logs application/cache

# Jalankan setup database dummy saat build
RUN php setup_demo.php

# Gunakan PHP Built-in Server agar tidak ada konflik Apache/MPM
# Ini jauh lebih stabil untuk kebutuhan demo di Railway
CMD php -S 0.0.0.0:$PORT index.php
