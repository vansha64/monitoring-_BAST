# Setup GitHub Repository & Push Code

## Repository Target
**URL:** https://github.com/vansha64/monitoring-_BAST.git

---

## Step 1: Install Git (Jika Belum)

### Download Git untuk Windows
1. Buka https://git-scm.com/download/win
2. Download installer (64-bit atau 32-bit sesuai sistem)
3. Jalankan installer, klik Next saja sampai selesai
4. **Restart** Command Prompt atau PowerShell

### Verifikasi Installasi
```bash
git --version
```
Harus muncul versi, contoh: `git version 2.40.0`

---

## Step 2: Setup Git Config

```bash
git config --global user.name "vansha64"
git config --global user.email "email@example.com"
```

---

## Step 3: Initialize Repository & Push

Buka **Command Prompt** atau **PowerShell** (bukan terminal IDE):

```bash
# Masuk ke folder project
cd d:\Web\MonitoringSurat-master

# Initialize git repository
git init

# Add semua file
git add .

# Commit pertama
git commit -m "Initial commit - MonitoringSurat application with all modules"

# Tambahkan remote repository
git remote add origin https://github.com/vansha64/monitoring-_BAST.git

# Push ke GitHub
git push -u origin main
```

**Catatan:** Jika ada error `main`, coba dengan `master`:
```bash
git push -u origin master
```

---

## Step 4: Login GitHub (Saat Push)

Saat pertama kali push, akan diminta login:

### Opsi A: HTTPS (Username + Password/Token)
1. Masukkan username: `vansha64`
2. Masukkan password: **Personal Access Token** (bukan password GitHub!)

**Cara buat Personal Access Token:**
1. Login ke https://github.com
2. Settings → Developer settings → Personal access tokens
3. Generate new token (classic)
4. Centang: `repo` (full control)
5. Generate dan copy token

### Opsi B: GitHub CLI (Lebih Mudah)
```bash
# Install GitHub CLI dulu (https://cli.github.com/)
gh auth login
gh repo create monitoring-_BAST --public --source=. --push
```

---

## Step 5: Buat Issues di GitHub

Setelah push berhasil, buat issues via GitHub website:

### Cara Manual (Via Website)
1. Buka https://github.com/vansha64/monitoring-_BAST/issues
2. Klik tombol **"New issue"** (warna hijau)
3. Isi dengan template di bawah

### Template Issues (Copy & Paste)

---

#### Issue #1: [FEATURE] Import Database Otomatis
```markdown
**Priority:** High  
**Label:** enhancement, database  

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
```

---

#### Issue #2: [BUG] Validasi No Kontrak Duplikat
```markdown
**Priority:** High  
**Label:** bug, data-integrity  

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
```

---

#### Issue #3: [FEATURE] Notifikasi Email untuk POM
```markdown
**Priority:** Medium  
**Label:** enhancement, notification  

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
```

---

#### Issue #4: [FEATURE] Export PDF untuk Laporan
```markdown
**Priority:** Medium  
**Label:** enhancement, reporting  

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
```

---

#### Issue #5: [BUG] Fix BAST1 Form Submission
```markdown
**Priority:** Critical  
**Label:** bug, bast1  

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
```

---

#### Issue #6: [FEATURE] Dashboard dengan Chart/Graph
```markdown
**Priority:** Medium  
**Label:** enhancement, dashboard  

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
```

---

#### Issue #7: [SECURITY] Implementasi CSRF Token
```markdown
**Priority:** High  
**Label:** security  

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
```

---

#### Issue #8: [FEATURE] Advanced Search & Filter
```markdown
**Priority:** Medium  
**Label:** enhancement, search  

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
```

---

#### Issue #9: [FEATURE] Backup & Restore Database
```markdown
**Priority:** Medium  
**Label:** enhancement, database  

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
```

---

#### Issue #10: [BUG] Fix Date Format Consistency
```markdown
**Priority:** Low  
**Label:** bug, ui  

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
```

---

## Troubleshooting Push

### Error: "Failed to connect to github.com"
- Cek koneksi internet
- Cek apakah ada proxy/firewall blocking

### Error: "Permission denied"
- Pastikan Personal Access Token sudah benar
- Pastikan token memiliki scope `repo`
- Cek apakah Anda memiliki access ke repository

### Error: "Could not resolve host: github.com"
- Cek DNS settings
- Coba: `ipconfig /flushdns`

### Error: "Updates were rejected"
```bash
# Force push (hati-hati, ini akan overwrite remote)
git push origin main --force

# Atau pull dulu
git pull origin main
git push origin main
```

---

## Quick Command Reference

```bash
# Check status
git status

# Add file
git add namafile.php

# Add all files
git add .

# Commit
git commit -m "pesan commit"

# Push
git push origin main

# Pull (download update dari GitHub)
git pull origin main

# View log
git log --oneline

# Create new branch
git checkout -b nama-branch

# Switch branch
git checkout main
```

---

## Setelah Push Berhasil

1. **Buka** https://github.com/vansha64/monitoring-_BAST
2. **Verifikasi** semua file sudah muncul
3. **Buat issues** dengan cara di atas
4. **Share** repository link ke tim

Selamat! Code sudah di-push ke GitHub 🎉
