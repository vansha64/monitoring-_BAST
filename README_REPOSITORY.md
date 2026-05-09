# Monitoring Surat - Repository

## Deskripsi
Aplikasi Monitoring Surat untuk mengelola dokumen kontrak, BAST (Berita Acara Serah Terima), Final Account, Parkir, dan Gudang. Dibangun menggunakan CodeIgniter 3 dengan PHP 7.4+.

## Struktur Repository

```
MonitoringSurat/
├── application/          # Core CodeIgniter application
│   ├── config/          # Configuration files
│   ├── controllers/   # Controllers
│   ├── models/        # Models
│   └── views/         # Views
├── assets/            # CSS, JS, Images
├── system/           # CodeIgniter System
├── database_monitoring_surat.sql  # Database structure
├── .github/          # GitHub templates & workflows
├── docker-compose.yml # Docker setup
└── README.md         # This file
```

## Quick Start

### Prerequisites
- PHP 7.4 atau lebih tinggi
- MySQL 5.7 atau lebih tinggi
- Apache/Nginx web server
- Composer (opsional untuk PHPExcel)

### Installation

1. **Clone Repository**
   ```bash
   git clone https://github.com/ervanshary/MonitoringSurat.git
   cd MonitoringSurat
   ```

2. **Import Database**
   - Buka phpMyAdmin atau MySQL client
   - Import file `database_monitoring_surat.sql`
   - Atau jalankan command:
   ```bash
   mysql -u root -p < database_monitoring_surat.sql
   ```

3. **Konfigurasi Database**
   Edit file `application/config/database.php`:
   ```php
   $db['default'] = array(
       'hostname' => 'localhost',
       'username' => 'root',
       'password' => '',
       'database' => 'monitoring_surat',
       'dbdriver' => 'mysqli',
       ...
   );
   ```

4. **Setup Web Server**
   - Point document root ke folder project
   - Enable mod_rewrite (Apache)
   - Pastikan folder `application/logs` dan `uploads` writable

5. **Default Login**
   - Email: `admin@admin.com`
   - Password: `admin123`

### Docker Installation
```bash
docker-compose up -d
```

## Database Structure

### 11 Modul Utama:
1. **User Management** - Authentication & Authorization
2. **Final Account** - Data kontrak utama
3. **AsBuilt Drawing** - Tracking dokumen AsBuilt
4. **BAST** - BAST 1 & BAST 2 management
5. **Closing** - Final account closing
6. **Parkir** - Kartu parkir management
7. **Gudang** - Inventory management (Barang Masuk/Keluar)
8. **Parsial** - POM notification tracking
9. **Kontrak Milenial** - Kontrak milenial management
10. **Laporan** - Reporting system
11. **Logging** - User activity logs

### Views:
- `view_laporan_monitoring` - Laporan monitoring lengkap
- `view_parkir_expired` - Parkir yang akan expired
- `view_pom_belum_kembali` - POM yang belum dikembalikan

## Fitur Utama

### Modul Dokumen
- 📄 Final Account Management
- 📐 AsBuilt Drawing Tracking
- 📋 BAST 1 & BAST 2 Management
- 🔒 Closing Process

### Modul Operasional
- 🚗 Parkir Member Management
- 📦 Gudang/Inventory (Barang Masuk/Keluar)
- ⏰ Parsial/POM Notification
- 📊 Kontrak Milenial

### Reporting
- 📈 Excel Export
- 📑 PDF Export (planned)
- 📊 Dashboard Statistics
- 🔍 Advanced Search & Filter

## Development

### Menjalankan di Local
```bash
# Install dependencies (jika menggunakan Composer)
composer install

# Setup database
cp database_monitoring_surat.sql database_backup.sql
mysql -u root -p < database_monitoring_surat.sql
```

### Testing
- Unit tests: `application/tests/`
- Manual testing checklist: `TEST_FORM_SUBMISSION.md`

### Deployment
Checklist deployment tersedia di `DEPLOYMENT_CHECKLIST.md`

## Dokumentasi

- `DOCUMENTATION_INDEX.md` - Index dokumentasi lengkap
- `DOKUMENTASI_FUNGSI_POM.md` - Dokumentasi fungsi POM
- `README_POM_NOTIFICATION.md` - Panduan POM Notification
- `QUICK_REFERENCE_CARD.md` - Quick reference

## Issues & Bug Reports

Lihat daftar issue di `.github/ISSUES.md`

## Contributing

1. Fork repository
2. Buat branch baru (`git checkout -b feature/nama-fitur`)
3. Commit perubahan (`git commit -am 'Add some feature'`)
4. Push ke branch (`git push origin feature/nama-fitur`)
5. Buat Pull Request

## License

Project ini menggunakan lisensi yang ditentukan dalam file `license.txt`

## Kontak

- **Author:** Ervan Shary
- **Email:** ervan.shary@example.com
- **GitHub:** [@ervanshary](https://github.com/ervanshary)

## Changelog

### v1.0.0 - Initial Release
- ✅ All basic modules implemented
- ✅ Database structure completed
- ✅ User authentication system
- ✅ BAST 1 & BAST 2 workflow
- ✅ Parkir management
- ✅ Gudang inventory
- ✅ Laporan system

---

**Note:** Pastikan selalu backup database sebelum melakukan update besar.
