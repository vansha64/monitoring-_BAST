# Issues Monitoring Surat

## Daftar Issue yang Perlu Diselesaikan

### 1. [FEATURE] Import Database Otomatis
**Priority:** High  
**Label:** enhancement, database  
**Status:** Open

**Deskripsi:**  
Membuat fitur import database otomatis saat pertama kali aplikasi dijalankan atau melalui halaman admin.

**Tugas:**
- [ ] Buat installer page untuk import SQL
- [ ] Validasi koneksi database
- [ ] Auto-import struktur tabel
- [ ] Insert data default (admin user, menu, role)

**Acceptance Criteria:**
- Admin bisa mengakses halaman installer di `/install`
- Validasi database connection sebelum import
- Progress bar saat import berjalan
- Notifikasi sukses/gagal

---

### 2. [BUG] Validasi No Kontrak Duplikat
**Priority:** High  
**Label:** bug, data-integrity  
**Status:** Open

**Deskripsi:**  
Perlu validasi lebih ketat pada no_kontrak agar tidak ada duplikat di tabel user_final_account dan tabel terkait.

**Tugas:**
- [ ] Cek duplikat sebelum insert
- [ ] Tampilkan pesan error yang jelas
- [ ] Case-insensitive comparison
- [ ] Trim whitespace pada input

**Acceptance Criteria:**
- Sistem menolak no_kontrak yang sudah ada
- Pesan error: "No Kontrak sudah terdaftar"
- Tidak ada duplikat di database

---

### 3. [FEATURE] Notifikasi Email untuk POM
**Priority:** Medium  
**Label:** enhancement, notification  
**Status:** Open

**Deskripsi:**  
Sistem mengirim email notifikasi saat dokumen POM sudah melewati 7 hari dan belum dikembalikan.

**Tugas:**
- [ ] Setup email configuration
- [ ] Buat email template
- [ ] Cron job untuk cek POM overdue
- [ ] Kirim email reminder otomatis

**Acceptance Criteria:**
- Email terkirim ke admin saat POM > 7 hari
- Email berisi detail no_kontrak, tanggal kirim, hari terlewat
- Email dikirim sekali per hari

---

### 4. [FEATURE] Export PDF untuk Laporan
**Priority:** Medium  
**Label:** enhancement, reporting  
**Status:** Open

**Deskripsi:**  
Tambahkan fitur export laporan monitoring ke format PDF selain Excel yang sudah ada.

**Tugas:**
- [ ] Integrasi library PDF (TCPDF/Dompdf)
- [ ] Design template laporan PDF
- [ ] Tambah button "Export PDF"
- [ ] Support filter yang sama dengan Excel

**Acceptance Criteria:**
- Tombol "Export PDF" di halaman Laporan
- PDF terdownload dengan nama yang sesuai
- Format PDF rapi dengan header, footer, tabel

---

### 5. [BUG] Fix BAST1 Form Submission
**Priority:** Critical  
**Label:** bug, bast1  
**Status:** Open

**Deskripsi:**  
Issue pada form submission BAST1 yang kadang gagal atau data tidak tersimpan dengan benar.

**Tugas:**
- [ ] Debug form submission BAST1
- [ ] Cek validasi field
- [ ] Fix error handling
- [ ] Test dengan berbagai skenario

**Acceptance Criteria:**
- Form BAST1 submit dengan sukses
- Data tersimpan di tabel user_bast1
- Tidak ada error di console/log

---

### 6. [FEATURE] Dashboard dengan Chart/Graph
**Priority:** Medium  
**Label:** enhancement, dashboard  
**Status:** Open

**Deskripsi:**  
Membuat dashboard visual dengan chart untuk monitoring statistik data.

**Tugas:**
- [ ] Integrasi Chart.js
- [ ] Chart: Total Kontrak per PT
- [ ] Chart: Status BAST (BAST1 vs BAST2)
- [ ] Chart: Parkir aktif vs non-aktif
- [ ] Chart: Barang Masuk vs Keluar

**Acceptance Criteria:**
- Dashboard menampilkan minimal 4 chart
- Data real-time dari database
- Responsive design

---

### 7. [SECURITY] Implementasi CSRF Token
**Priority:** High  
**Label:** security  
**Status:** Open

**Deskripsi:**  
Menambahkan CSRF protection pada semua form untuk mencegah serangan CSRF.

**Tugas:**
- [ ] Aktifkan CSRF di CodeIgniter config
- [ ] Tambahkan CSRF token di semua form
- [ ] Validasi token di controller
- [ ] Test semua form submission

**Acceptance Criteria:**
- Semua form memiliki CSRF token
- Form tanpa token ditolak
- Tidak ada error CSRF saat submit normal

---

### 8. [FEATURE] Advanced Search & Filter
**Priority:** Medium  
**Label:** enhancement, search  
**Status:** Open

**Deskripsi:**  
Fitur pencarian advanced dengan multiple filter untuk semua modul.

**Tugas:**
- [ ] Filter by date range
- [ ] Filter by PT/Kontraktor
- [ ] Filter by status
- [ ] Search across multiple fields
- [ ] Save search preferences

**Acceptance Criteria:**
- User bisa filter dengan multiple criteria
- Hasil pencarian akurat
- URL berubah sesuai filter (shareable)

---

### 9. [FEATURE] Backup & Restore Database
**Priority:** Medium  
**Label:** enhancement, database  
**Status:** Open

**Deskripsi:**  
Fitur backup dan restore database dari halaman admin.

**Tugas:**
- [ ] Button "Backup Database" → download .sql
- [ ] Button "Restore Database" → upload .sql
- [ ] Validasi file SQL sebelum restore
- [ ] Backup otomatis harian (cron)

**Acceptance Criteria:**
- Backup menghasilkan file SQL lengkap
- Restore berhasil mengembalikan data
- Validasi file sebelum restore
- Cron job backup berjalan tiap hari

---

### 10. [BUG] Fix Date Format Consistency
**Priority:** Low  
**Label:** bug, ui  
**Status:** Open

**Deskripsi:**  
Memastikan format tanggal konsisten di seluruh aplikasi (DD/MM/YYYY atau YYYY-MM-DD).

**Tugas:**
- [ ] Audit semua input tanggal
- [ ] Audit semua display tanggal
- [ ] Standarisasi format YYYY-MM-DD untuk DB
- [ ] Standarisasi format DD/MM/YYYY untuk UI

**Acceptance Criteria:**
- Format tanggal konsisten di UI
- Format YYYY-MM-DD di database
- Tidak ada error parsing tanggal

---

## Cara Membuat Issue Baru

Format issue baru:

```markdown
### [TYPE] Judul Issue
**Priority:** High/Medium/Low
**Label:** label1, label2
**Status:** Open/In Progress/Closed

**Deskripsi:**
Penjelasan singkat tentang issue.

**Tugas:**
- [ ] Task 1
- [ ] Task 2
- [ ] Task 3

**Acceptance Criteria:**
- Kriteria 1
- Kriteria 2
```

## Label yang Digunakan

| Label | Deskripsi |
|-------|-----------|
| bug | Sesuatu yang rusak |
| enhancement | Fitur baru |
| documentation | Dokumentasi |
| database | Terkait database |
| security | Masalah keamanan |
| ui | User Interface |
| high-priority | Prioritas tinggi |
| low-priority | Prioritas rendah |
