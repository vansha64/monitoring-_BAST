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
            keterangan TEXT
        )",
        "CREATE TABLE IF NOT EXISTS user_bast (
            id_bast INTEGER PRIMARY KEY AUTOINCREMENT,
            id_asbuilt INTEGER,
            keterangan TEXT,
            tgl_terima_bast TEXT,
            tgl_pusat TEXT,
            tgl_kontraktor TEXT,
            file_pdf TEXT,
            opsi_retensi TEXT,
            is_revisi INTEGER,
            created_by TEXT,
            updated_by TEXT
        )",
        "CREATE TABLE IF NOT EXISTS user_bast1 (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            no_kontrak TEXT,
            nama_pt TEXT,
            pekerjaan TEXT,
            tgl_terima_bast TEXT,
            file_pdf TEXT
        )",
        "CREATE TABLE IF NOT EXISTS user_closing (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            no_kontrak TEXT,
            nama_pt TEXT,
            pekerjaan TEXT,
            tgl_terima_bast TEXT,
            file_pdf TEXT
        )",
        "CREATE TABLE IF NOT EXISTS opsi_retensi (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            nama TEXT
        )",
        "CREATE TABLE IF NOT EXISTS user_barangmasuk (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            nama_barang TEXT,
            jumlah INTEGER,
            tgl_masuk TEXT,
            keterangan TEXT
        )",
        "CREATE TABLE IF NOT EXISTS user_barangkeluar (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            nama_barang TEXT,
            jumlah INTEGER,
            tgl_keluar TEXT,
            keterangan TEXT
        )",
        "CREATE TABLE IF NOT EXISTS user_parkir (
            id_parkir INTEGER PRIMARY KEY AUTOINCREMENT,
            perusahaan TEXT,
            nama_member TEXT,
            no_kendaraan TEXT,
            no_kartu TEXT,
            jenis_kendaraan TEXT,
            tgl_pembuatan TEXT,
            tgl_berakhir TEXT,
            keterangan TEXT,
            scan_dokumen TEXT,
            status TEXT
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
            scan_pdf TEXT
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
            keterangan TEXT
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

    $db->exec("INSERT OR IGNORE INTO user_menu (id, menu) VALUES (1, 'Admin'), (2, 'User'), (3, 'Menu')");
    $db->exec("INSERT OR IGNORE INTO user_access_menu (role_id, menu_id) VALUES (1, 1), (1, 2), (1, 3), (2, 2)");

    $db->exec("INSERT OR IGNORE INTO user_sub_menu (menu_id, title, url, icon, is_active) VALUES 
        (1, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 1),
        (2, 'My Profile', 'user', 'fas fa-fw fa-user', 1),
        (2, 'Edit Profile', 'user/edit', 'fas fa-fw fa-user-edit', 1),
        (3, 'Menu Management', 'menu', 'fas fa-fw fa-folder', 1),
        (3, 'Submenu Management', 'menu/submenu', 'fas fa-fw fa-folder-open', 1)");

    $db->exec("INSERT OR IGNORE INTO user_final_account (no_kontrak, nama_pt, pekerjaan) VALUES 
        ('CONT/2026/001', 'PT. Global Solusindo', 'Pembangunan Gedung A'),
        ('CONT/2026/002', 'PT. Maju Bersama', 'Renovasi Kantor Pusat')");

    $db->exec("INSERT OR IGNORE INTO user_asbuiltdrawing (no_kontrak, tgl_terima, status, keterangan) VALUES 
        ('CONT/2026/001', '2026-05-01', 'Selesai', 'Dokumen lengkap'),
        ('CONT/2026/002', '2026-05-05', 'Proses', 'Menunggu tanda tangan')");

    $db->exec("INSERT OR IGNORE INTO user_parkir (perusahaan, nama_member, no_kendaraan, jenis_kendaraan, status) VALUES 
        ('PT. Global Solusindo', 'Budi Santoso', 'B 1234 ABC', 'Mobil', 'Aktif'),
        ('PT. Maju Bersama', 'Siti Aminah', 'D 5678 XYZ', 'Motor', 'Aktif')");

    // echo "Demo database initialized successfully.\n";

} catch (PDOException $e) {
    // echo "Error: " . $e->getMessage() . "\n";
}
