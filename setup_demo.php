<?php
$db_file = '/tmp/demo.sqlite';

try {
    $db = new PDO('sqlite:' . $db_file);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create tables
    $queries = [
        "CREATE TABLE IF NOT EXISTS user (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT,
            email TEXT UNIQUE,
            image TEXT,
            password TEXT,
            role_id INTEGER,
            is_active INTEGER,
            date_created INTEGER
        )",
        "CREATE TABLE IF NOT EXISTS user_role (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            role TEXT
        )",
        "CREATE TABLE IF NOT EXISTS user_menu (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            menu TEXT
        )",
        "CREATE TABLE IF NOT EXISTS user_access_menu (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            role_id INTEGER,
            menu_id INTEGER
        )",
        "CREATE TABLE IF NOT EXISTS user_sub_menu (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            menu_id INTEGER,
            title TEXT,
            url TEXT,
            icon TEXT,
            is_active INTEGER
        )",
        "CREATE TABLE IF NOT EXISTS user_final_account (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            no_kontrak TEXT,
            nama_pt TEXT,
            pekerjaan TEXT
        )",
        "CREATE TABLE IF NOT EXISTS user_asbuiltdrawing (
            id_asbuilt INTEGER PRIMARY KEY AUTOINCREMENT,
            no_kontrak TEXT,
            tgl_terima TEXT,
            status TEXT,
            keterangan TEXT,
            updated_by TEXT
        )",
        "CREATE TABLE IF NOT EXISTS user_closing (
            id_closing INTEGER PRIMARY KEY AUTOINCREMENT,
            no_kontrak TEXT,
            nama_pt TEXT,
            pekerjaan TEXT,
            tgl_terima_bast TEXT,
            file_pdf TEXT,
            tgl_closing TEXT,
            scan_fa TEXT,
            keterangan_fa TEXT,
            updated_by TEXT,
            is_active INTEGER
        )",
        "CREATE TABLE IF NOT EXISTS user_parsial (
            id_parsial INTEGER PRIMARY KEY AUTOINCREMENT,
            lokasi TEXT,
            area TEXT,
            pekerjaan TEXT,
            nama_kontraktor TEXT,
            no_dokumen TEXT,
            tgl_kirim_pom TEXT,
            tgl_kembali_pom TEXT,
            tgl_kembali_kontraktor TEXT,
            keterangan TEXT,
            scan_pdf TEXT,
            status_revisi INTEGER
        )",
        "CREATE TABLE IF NOT EXISTS ci_sessions (
            id varchar(128) NOT NULL,
            ip_address varchar(45) NOT NULL,
            timestamp INTEGER DEFAULT 0 NOT NULL,
            data blob NOT NULL,
            PRIMARY KEY (id)
        )",
        "CREATE TABLE IF NOT EXISTS user_bast2 (
            id_bast2 INTEGER PRIMARY KEY AUTOINCREMENT,
            id_bast INTEGER,
            no_kontrak TEXT,
            tgl_pom TEXT,
            kembali_pom TEXT,
            tgl_terima_bast2 TEXT,
            tgl_pusat2 TEXT,
            tgl_kontraktor2 TEXT,
            file_pdf_bast2 TEXT,
            keterangan2 TEXT,
            is_revisi INTEGER,
            created_by TEXT,
            updated_by TEXT
        )",
        "CREATE TABLE IF NOT EXISTS user_asbuilt_drawing (
            id_asbuilt INTEGER PRIMARY KEY AUTOINCREMENT,
            no_kontrak TEXT,
            tgl_terima TEXT,
            status TEXT,
            keterangan TEXT,
            updated_by TEXT
        )",
        "CREATE TABLE IF NOT EXISTS user_final_account_milenial (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            no_kontrak TEXT,
            nama_pt TEXT,
            pekerjaan TEXT,
            created_by TEXT,
            updated_by TEXT
        )"
    ];

    foreach ($queries as $query) {
        $db->exec($query);
    }

    // Insert Dummy Data
    $db->exec("INSERT OR IGNORE INTO user_role (id, role) VALUES (1, 'Administrator'), (2, 'User')");
    
    // admin@demo.com / password
    $password = password_hash('password', PASSWORD_DEFAULT);
    $db->exec("INSERT OR IGNORE INTO user (id, name, email, image, password, role_id, is_active, date_created) 
               VALUES (1, 'Demo Admin', 'admin@demo.com', 'default.jpg', '$password', 1, 1, " . time() . ")");

    $db->exec("INSERT OR IGNORE INTO user_menu (id, menu) VALUES (1, 'Admin'), (2, 'User'), (3, 'Menu'), (4, 'Pemasangan')");
    $db->exec("INSERT OR IGNORE INTO user_access_menu (role_id, menu_id) VALUES (1, 1), (1, 2), (1, 3), (1, 4), (2, 2)");

    $db->exec("INSERT OR IGNORE INTO user_sub_menu (menu_id, title, url, icon, is_active) VALUES 
        (1, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 1),
        (2, 'My Profile', 'user', 'fas fa-fw fa-user', 1),
        (2, 'Edit Profile', 'user/edit', 'fas fa-fw fa-user-edit', 1),
        (2, 'Report', 'user/laporan', 'fas fa-fw fa-file-alt', 1),
        (4, 'Kontrak', 'user/finalaccount', 'fas fa-fw fa-file-contract', 1),
        (4, 'Asbuiltdrawing', 'user/asbuiltdrawing', 'fas fa-fw fa-drafting-compass', 1),
        (4, 'BAST 1', 'user/getBAST', 'fas fa-fw fa-certificate', 1),
        (4, 'BAST 2', 'user/getBAST2', 'fas fa-fw fa-award', 1),
        (4, 'Final Account', 'user/closing', 'fas fa-fw fa-file-invoice-dollar', 1),
        (4, 'Data Pemasangan', 'user/partial', 'fas fa-fw fa-tools', 1),
        (3, 'Menu Management', 'menu', 'fas fa-fw fa-folder', 1),
        (3, 'Submenu Management', 'menu/submenu', 'fas fa-fw fa-folder-open', 1)");

    $db->exec("INSERT OR IGNORE INTO user_final_account (no_kontrak, nama_pt, pekerjaan) VALUES 
        ('CONT/2026/001', 'PT. Global Solusindo', 'Pembangunan Gedung A'),
        ('CONT/2026/002', 'PT. Maju Bersama', 'Renovasi Kantor Pusat'),
        ('CONT/2026/003', 'PT. Teknologi Masa Depan', 'Instalasi Jaringan Fiber Optik'),
        ('CONT/2026/004', 'PT. Konstruksi Jaya', 'Pembangunan Jembatan Layang'),
        ('CONT/2026/005', 'PT. Energi Terbarukan', 'Pemasangan Panel Surya'),
        ('CONT/2026/006', 'PT. Arsitektur Modern', 'Desain Interior Lobby Utama'),
        ('CONT/2026/007', 'PT. Logistik Cepat', 'Pengadaan Kendaraan Operasional'),
        ('CONT/2026/008', 'PT. Keamanan Nasional', 'Sistem Monitoring CCTV Kota'),
        ('CONT/2026/009', 'PT. Pangan Lestari', 'Pembangunan Gudang Pendingin'),
        ('CONT/2026/010', 'PT. Sejahtera Abadi', 'Pemeliharaan Taman Kota'),
        ('CONT/2026/011', 'PT. Cipta Karya', 'Rehabilitasi Saluran Air'),
        ('CONT/2026/012', 'PT. Inti Perkasa', 'Pembangunan Menara Telekomunikasi'),
        ('CONT/2026/013', 'PT. Graha Citra', 'Finishing Apartemen Sudirman'),
        ('CONT/2026/014', 'PT. Sinar Dunia', 'Pengadaan Lampu Jalan LED'),
        ('CONT/2026/015', 'PT. Baja Mulia', 'Konstruksi Rangka Atap Stadion')");

    $db->exec("INSERT OR IGNORE INTO user_asbuiltdrawing (no_kontrak, tgl_terima, status, keterangan) VALUES 
        ('CONT/2026/001', '2026-05-01', 'Selesai', 'Dokumen lengkap'),
        ('CONT/2026/002', '2026-05-05', 'Proses', 'Menunggu tanda tangan'),
        ('CONT/2026/003', '2026-05-07', 'Selesai', 'Revisi terakhir disetujui'),
        ('CONT/2026/004', '2026-05-10', 'Pending', 'Kekurangan lampiran foto'),
        ('CONT/2026/005', '2026-05-12', 'Proses', 'Tahap verifikasi lapangan'),
        ('CONT/2026/006', '2026-05-15', 'Selesai', 'Arsip fisik sudah diterima'),
        ('CONT/2026/007', '2026-05-18', 'Proses', 'Review oleh tim teknis'),
        ('CONT/2026/008', '2026-05-20', 'Selesai', 'Scan digital tersedia'),
        ('CONT/2026/009', '2026-05-22', 'Pending', 'Data ukur belum valid'),
        ('CONT/2026/010', '2026-05-25', 'Proses', 'Menunggu persetujuan PM')");

    $db->exec("INSERT OR IGNORE INTO user_bast (id_asbuilt, keterangan, tgl_terima_bast, opsi_retensi, is_revisi, created_by) VALUES 
        (1, 'BAST 1 Selesai', '2026-05-02', '5%', 0, 'Demo Admin'),
        (3, 'BAST 1 Disetujui', '2026-05-08', '5%', 0, 'Demo Admin'),
        (6, 'Penyerahan Tahap 1', '2026-05-16', '5%', 0, 'Demo Admin'),
        (8, 'Dokumen BAST Lengkap', '2026-05-21', '5%', 0, 'Demo Admin')");

    $db->exec("INSERT OR IGNORE INTO user_parkir (perusahaan, nama_member, no_kendaraan, jenis_kendaraan, status, tgl_pembuatan, tgl_berakhir) VALUES 
        ('PT. Global Solusindo', 'Budi Santoso', 'B 1234 ABC', 'Mobil', 'Aktif', '2026-01-01', '2026-12-31'),
        ('PT. Maju Bersama', 'Siti Aminah', 'D 5678 XYZ', 'Motor', 'Aktif', '2026-02-01', '2027-01-31'),
        ('PT. Teknologi Masa Depan', 'Andi Wijaya', 'B 9999 FFF', 'Mobil', 'Aktif', '2026-03-15', '2027-03-14'),
        ('PT. Konstruksi Jaya', 'Rina Pratama', 'B 2233 KKK', 'Mobil', 'Non-Aktif', '2026-01-10', '2026-07-10'),
        ('PT. Energi Terbarukan', 'Eko Prasetyo', 'F 4455 GGG', 'Motor', 'Aktif', '2026-04-20', '2027-04-19'),
        ('PT. Arsitektur Modern', 'Maya Sari', 'B 7788 LLL', 'Mobil', 'Aktif', '2026-05-01', '2027-04-30'),
        ('PT. Logistik Cepat', 'Hendra Kurniawan', 'B 1122 MMM', 'Mobil', 'Aktif', '2026-05-05', '2027-05-04'),
        ('PT. Keamanan Nasional', 'Agus Setiawan', 'B 3344 NNN', 'Motor', 'Aktif', '2026-05-10', '2027-05-09'),
        ('PT. Pangan Lestari', 'Dewi Lestari', 'B 5566 OOO', 'Mobil', 'Aktif', '2026-05-12', '2027-05-11'),
        ('PT. Sejahtera Abadi', 'Rully Hidayat', 'B 7788 PPP', 'Mobil', 'Aktif', '2026-05-15', '2027-05-14')");

    $db->exec("INSERT OR IGNORE INTO user_parsial (lokasi, area, pekerjaan, nama_kontraktor, no_dokumen, tgl_kirim_pom, tgl_kembali_pom, status_revisi) VALUES 
        ('Jakarta Selatan', 'Gedung A1', 'Pemasangan AC Central', 'PT. Global Solusindo', 'DOC/PAR/001', '2026-05-01', '2026-05-05', 0),
        ('Bandung', 'Mall Citra', 'Instalasi Listrik Lt. 2', 'PT. Maju Bersama', 'DOC/PAR/002', '2026-05-03', '2026-05-07', 0),
        ('Surabaya', 'Gudang Pusat', 'Pemasangan Rak Heavy Duty', 'PT. Logistik Cepat', 'DOC/PAR/003', '2026-05-05', '2026-05-10', 1),
        ('Medan', 'Kantor Cabang', 'Painting & Finishing', 'PT. Arsitektur Modern', 'DOC/PAR/004', '2026-05-08', '2026-05-12', 0),
        ('Makassar', 'Area Parkir', 'Pemasangan Kanopi Baja', 'PT. Baja Mulia', 'DOC/PAR/005', '2026-05-10', '2026-05-15', 0),
        ('Semarang', 'Lobby Utama', 'Pemasangan Marmer', 'PT. Graha Citra', 'DOC/PAR/006', '2026-05-12', '2026-05-18', 0),
        ('Yogyakarta', 'Ruang Server', 'Instalasi Pemadam Api', 'PT. Teknologi Masa Depan', 'DOC/PAR/007', '2026-05-15', '2026-05-20', 0),
        ('Bali', 'Villa Resort', 'Lansekap & Kolam Renang', 'PT. Sejahtera Abadi', 'DOC/PAR/008', '2026-05-18', '2026-05-25', 0),
        ('Palembang', 'Stadion Utama', 'Pemasangan Sound System', 'PT. Sinar Dunia', 'DOC/PAR/009', '2026-05-20', '2026-05-28', 0),
        ('Balikpapan', 'Kilang Minyak', 'Upgrade Sistem Piping', 'PT. Inti Perkasa', 'DOC/PAR/010', '2026-05-22', '2026-05-30', 0)");

    // echo "Demo database initialized successfully.\n";

} catch (PDOException $e) {
    // echo "Error: " . $e->getMessage() . "\n";
}
