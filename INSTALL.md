# Panduan Instalasi Monitoring Surat

## System Requirements

### Minimum Requirements
- PHP >= 7.4
- MySQL >= 5.7 atau MariaDB >= 10.2
- Apache >= 2.4 atau Nginx >= 1.18
- 100MB disk space
- 512MB RAM

### Recommended
- PHP 8.0+
- MySQL 8.0
- Apache dengan mod_rewrite enabled
- 1GB+ RAM untuk dataset besar

## Instalasi Step-by-Step

### Step 1: Download/Clone Project
```bash
# Clone dari GitHub
git clone https://github.com/ervanshary/MonitoringSurat.git

# Atau download ZIP dan extract ke folder web server
# Contoh: C:\xampp\htdocs\MonitoringSurat
# Atau: /var/www/html/MonitoringSurat
```

### Step 2: Setup Database

#### Opsi A: Import via phpMyAdmin
1. Buka browser, akses `http://localhost/phpmyadmin`
2. Login dengan user MySQL (default: root)
3. Klik tab **Import**
4. Klik **Choose File** dan pilih `database_monitoring_surat.sql`
5. Klik **Go** dan tunggu proses selesai

#### Opsi B: Import via Command Line (Windows)
```cmd
# Buka Command Prompt atau PowerShell

# Buat database baru
mysql -u root -p -e "CREATE DATABASE IF NOT EXISTS monitoring_surat;"

# Import SQL file
mysql -u root -p monitoring_surat < database_monitoring_surat.sql
```

#### Opsi C: Import via Command Line (Linux/Mac)
```bash
# Login ke MySQL
mysql -u root -p

# Buat database
CREATE DATABASE monitoring_surat CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EXIT;

# Import file
mysql -u root -p monitoring_surat < database_monitoring_surat.sql
```

### Step 3: Konfigurasi Database

Edit file: `application/config/database.php`

```php
$active_group = 'default';
$query_builder = TRUE;

$db['default'] = array(
    'dsn'    => '',
    'hostname' => 'localhost',      // Ganti jika MySQL di server lain
    'username' => 'root',           // Username MySQL
    'password' => '',               // Password MySQL (kosong jika tidak ada)
    'database' => 'monitoring_surat', // Nama database
    'dbdriver' => 'mysqli',
    'dbprefix' => '',
    'pconnect' => FALSE,
    'db_debug' => (ENVIRONMENT !== 'production'),
    'cache_on' => FALSE,
    'cachedir' => '',
    'char_set' => 'utf8mb4',
    'dbcollat' => 'utf8mb4_unicode_ci',
    'swap_pre' => '',
    'encrypt' => FALSE,
    'compress' => FALSE,
    'stricton' => FALSE,
    'failover' => array(),
    'save_queries' => TRUE
);
```

### Step 4: Setup Web Server

#### Apache (XAMPP/WAMP)
1. Pastikan mod_rewrite aktif:
   - Buka `httpd.conf`
   - Cari: `#LoadModule rewrite_module modules/mod_rewrite.so`
   - Hapus tanda `#` di awal baris
   - Restart Apache

2. Pastikan `.htaccess` ada di root folder:
   ```apache
   RewriteEngine On
   RewriteCond %{REQUEST_FILENAME} !-f
   RewriteCond %{REQUEST_FILENAME} !-d
   RewriteRule ^(.*)$ index.php/$1 [L]
   ```

#### Nginx
Tambahkan konfigurasi berikut ke server block:
```nginx
location / {
    try_files $uri $uri/ /index.php?$query_string;
}

location ~ \.php$ {
    include snippets/fastcgi-php.conf;
    fastcgi_pass unix:/var/run/php/php7.4-fpm.sock;
}
```

### Step 5: Set Permissions (Linux/Mac)
```bash
# Set ownership
sudo chown -R www-data:www-data /var/www/html/MonitoringSurat

# Set permissions
chmod -R 755 /var/www/html/MonitoringSurat
chmod -R 777 /var/www/html/MonitoringSurat/application/logs
chmod -R 777 /var/www/html/MonitoringSurat/uploads
```

### Step 6: Verifikasi Instalasi

1. **Cek Database Connection**
   - Akses aplikasi di browser: `http://localhost/MonitoringSurat`
   - Jika ada error database, cek konfigurasi di Step 3

2. **Login Pertama Kali**
   - Email: `admin@admin.com`
   - Password: `admin123`

3. **Verifikasi Modul**
   - Dashboard: `http://localhost/MonitoringSurat/user`
   - Menu Management: `http://localhost/MonitoringSurat/menu`
   - Final Account: `http://localhost/MonitoringSurat/user/finalaccount`

## Troubleshooting

### Error: "Unable to connect to database"
- Cek apakah MySQL service berjalan
- Verifikasi username dan password di `database.php`
- Cek hostname (gunakan `127.0.0.1` jika `localhost` tidak work)

### Error: "404 Not Found"
- Cek apakah mod_rewrite aktif (Apache)
- Verifikasi `.htaccess` ada dan readable
- Cek base URL di `application/config/config.php`:
  ```php
  $config['base_url'] = 'http://localhost/MonitoringSurat/';
  ```

### Error: "Access denied for user"
- Grant privileges ke user MySQL:
  ```sql
  GRANT ALL PRIVILEGES ON monitoring_surat.* TO 'root'@'localhost';
  FLUSH PRIVILEGES;
  ```

### Error: "Table doesn't exist"
- Database belum diimport dengan benar
- Import ulang file `database_monitoring_surat.sql`
- Cek apakah nama database sesuai konfigurasi

### Error: "Class 'PhpOffice\PhpSpreadsheet\Spreadsheet' not found"
- Install Composer dependencies:
  ```bash
  composer install
  ```
- Atau download vendor dari repository yang sudah include vendor

## Post-Installation

### 1. Ganti Password Default
Setelah login, segera ganti password default untuk keamanan:
- Profile → Edit Profile → Ganti Password

### 2. Konfigurasi Email (Opsional)
Jika menggunakan fitur notifikasi email:
Edit `application/config/email.php`:
```php
$config['protocol'] = 'smtp';
$config['smtp_host'] = 'smtp.gmail.com';
$config['smtp_port'] = 587;
$config['smtp_user'] = 'your-email@gmail.com';
$config['smtp_pass'] = 'your-password';
```

### 3. Setup Cron Job (Opsional)
Untuk notifikasi otomatis:
```bash
# Edit crontab
crontab -e

# Tambahkan baris berikut untuk cek setiap jam 9 pagi
0 9 * * * curl http://localhost/MonitoringSurat/user/check_reminders
```

### 4. Backup Database
Buat backup otomatis dengan script:
```bash
#!/bin/bash
DATE=$(date +%Y%m%d_%H%M%S)
mysqldump -u root -p monitoring_surat > backup_$DATE.sql
```

## Update Aplikasi

### Manual Update
1. Backup database dan file aplikasi
2. Download versi terbaru
3. Replace file (kecuali `application/config/` dan `uploads/`)
4. Import migration SQL jika ada

### Database Migration
Jika ada update struktur database:
```bash
# Backup dulu
mysqldump -u root -p monitoring_surat > backup_before_update.sql

# Import migration
mysql -u root -p monitoring_surat < migration_v1_to_v2.sql
```

## Support

Jika mengalami masalah:
1. Cek dokumentasi di folder `.github/`
2. Lihat issue yang sudah ada di GitHub
3. Buat issue baru dengan template yang tersedia

## Referensi

- [CodeIgniter 3 Documentation](https://codeigniter.com/userguide3/)
- [MySQL Documentation](https://dev.mysql.com/doc/)
- [Apache mod_rewrite](https://httpd.apache.org/docs/current/mod/mod_rewrite.html)
