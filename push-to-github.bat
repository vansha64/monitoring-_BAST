@echo off
echo ==========================================
echo   Push MonitoringSurat ke GitHub
echo ==========================================
echo.
echo Repository: https://github.com/vansha64/monitoring-_BAST.git
echo.

REM Check if git is installed
git --version >nul 2>&1
if %errorlevel% neq 0 (
    echo [ERROR] Git belum terinstall!
    echo.
    echo Silakan install Git dulu:
    echo 1. Buka https://git-scm.com/download/win
    echo 2. Download dan install Git
    echo 3. Restart Command Prompt
    echo.
    echo Atau baca GITHUB_SETUP.md untuk panduan lengkap.
    echo.
    pause
    exit /b 1
)

echo [OK] Git terdeteksi
echo.

REM Check if git is initialized
if not exist .git (
    echo [INFO] Menginisialisasi repository Git...
    git init
    if %errorlevel% neq 0 (
        echo [ERROR] Gagal menginisialisasi Git
        pause
        exit /b 1
    )
    echo [OK] Repository diinisialisasi
) else (
    echo [OK] Repository Git sudah ada
)
echo.

REM Configure git (optional - uncomment if needed)
REM git config user.name "vansha64"
REM git config user.email "your-email@example.com"

REM Add all files
echo [INFO] Menambahkan file ke staging...
git add .
if %errorlevel% neq 0 (
    echo [ERROR] Gagal menambahkan file
    pause
    exit /b 1
)
echo [OK] File ditambahkan

echo.

REM Get commit message
echo Masukkan pesan commit (atau tekan Enter untuk default):
echo Default: "Update: [tanggal sekarang]"
set /p commit_msg="Pesan: "

if "%commit_msg%"=="" (
    for /f "tokens=2-4 delims=/ " %%a in ('date /t') do (set mydate=%%c-%%a-%%b)
    set commit_msg=Update: %mydate%
)

echo.
echo [INFO] Melakukan commit...
git commit -m "%commit_msg%"
if %errorlevel% neq 0 (
    echo [WARNING] Tidak ada perubahan untuk di-commit atau commit sudah ada
)
echo.

REM Check remote
for /f "tokens=*" %%a in ('git remote get-url origin 2^>nul') do (
    set remote_url=%%a
)

if "!remote_url!"=="" (
    echo [INFO] Menambahkan remote repository...
    git remote add origin https://github.com/vansha64/monitoring-_BAST.git
    if %errorlevel% neq 0 (
        echo [ERROR] Gagal menambahkan remote
        pause
        exit /b 1
    )
    echo [OK] Remote repository ditambahkan
) else (
    echo [OK] Remote sudah dikonfigurasi: %remote_url%
)
echo.

REM Get current branch
for /f "tokens=*" %%a in ('git branch --show-current') do (
    set current_branch=%%a
)

if "%current_branch%"=="" (
    set current_branch=main
)

echo [INFO] Push ke branch: %current_branch%
echo.
echo ------------------------------------------
echo Jika diminta login, gunakan:
echo Username: vansha64
echo Password: Personal Access Token (bukan password GitHub!)
echo ------------------------------------------
echo.

git push -u origin %current_branch%

if %errorlevel% neq 0 (
    echo.
    echo [ERROR] Push gagal!
    echo.
    echo Kemungkinan penyebab:
    echo 1. Belum login ke GitHub
    echo 2. Personal Access Token salah
    echo 3. Tidak ada koneksi internet
    echo 4. Repository tidak ditemukan
    echo.
    echo Solusi:
    echo - Buat Personal Access Token di GitHub Settings
    echo - Cek koneksi internet
    echo - Verifikasi repository URL
    echo.
    pause
    exit /b 1
)

echo.
echo ==========================================
echo   [SUKSES] Push ke GitHub berhasil!
echo ==========================================
echo.
echo Repository: https://github.com/vansha64/monitoring-_BAST.git
echo.
echo Selanjutnya:
echo 1. Buka link di atas untuk verifikasi
echo 2. Buat issues di tab Issues
echo 3. Share repository ke tim
echo.
pause
