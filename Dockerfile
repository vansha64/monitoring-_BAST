# Gunakan image PHP dengan Apache
FROM php:8.0-apache

# Install dependencies dan ekstensi PHP
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libsqlite3-dev \
    sqlite3 \
    git && \
    docker-php-ext-install mysqli mbstring pdo pdo_sqlite

# Konfigurasi Apache agar mengikuti variabel $PORT dari Railway
RUN sed -i 's/80/${PORT}/g' /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf

# Aktifkan mod_rewrite Apache dan pastikan HANYA mpm_prefork yang dimuat (hapus mpm_event agar tidak bentrok)
RUN rm -f /etc/apache2/mods-enabled/mpm_event.load /etc/apache2/mods-enabled/mpm_event.conf && \
    a2enmod mpm_prefork && a2enmod rewrite

# Salin semua file proyek
COPY . /var/www/html/

# Pastikan folder database dan logs bisa ditulis
RUN mkdir -p /var/www/html/application/database /var/www/html/application/logs /var/www/html/application/cache && \
    chown -R www-data:www-data /var/www/html && \
    chmod -R 777 /var/www/html/application/database /var/www/html/application/logs /var/www/html/application/cache

# Jalankan setup database dummy saat build
RUN php /var/www/html/setup_demo.php

# Jalankan Apache (Apache akan otomatis mendeteksi $PORT yang sudah kita sed-i tadi)
CMD ["apache2-foreground"]
