# Gunakan image PHP dengan Apache
FROM php:8.0-apache

# Install dependencies dan ekstensi PHP (mysqli, pdo_sqlite, mbstring)
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libsqlite3-dev \
    sqlite3 \
    git && \
    docker-php-ext-install mysqli mbstring pdo pdo_sqlite

# Aktifkan mod_rewrite Apache
RUN a2enmod rewrite

# Salin semua file proyek ke dalam container
COPY . /var/www/html/

# Pastikan folder database dan logs bisa ditulis
RUN mkdir -p /var/www/html/application/database /var/www/html/application/logs /var/www/html/application/cache && \
    chown -R www-data:www-data /var/www/html && \
    chmod -R 777 /var/www/html/application/database /var/www/html/application/logs /var/www/html/application/cache

# Jalankan setup database otomatis saat build
RUN php /var/www/html/setup_demo.php

# Expose port 80 (HTTP)
EXPOSE 80

# Jalankan Apache di container
CMD ["apache2-foreground"]
