# Quick Start Guide - SIM SOP Rumah Sakit Sanglah

## Setup Database (5 menit)

### 1. Buat Database MySQL

Buka MySQL CLI atau phpMyAdmin:

```sql
CREATE DATABASE sanglah_sop CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 2. Konfigurasi sudah tersedia di `.env`

File `.env` sudah dikonfigurasi untuk MySQL lokal:
- Database: `sanglah_sop`
- User: `root`
- Password: (kosong)
- Host: `127.0.0.1`

Jika kredensial MySQL Anda berbeda, edit file `.env` sesuai kebutuhan.

---

## Install & Setup (10 menit)

### 1. Install Dependencies (jika belum)

```bash
composer install
npm install
```

### 2. Jalankan Migrasi Database

```bash
php artisan migrate
```

Output yang diharapkan:
```
✓ roles
✓ units  
✓ users
✓ sops
✓ sop_versions
✓ validations
✓ notifications
✓ activity_logs
✓ password_reset_tokens
✓ sessions
```

### 3. Isi Data Awal (Seeder)

```bash
php artisan db:seed
```

Output yang diharapkan:
```
Database seeding completed successfully.
```

Data yang ditambahkan:
- 3 roles
- 8 units
- 5 users (1 admin, 2 validator, 2 user)

### 4. Buat Storage Link

```bash
php artisan storage:link
```

Output:
```
The [public/storage] link has been created.
```

### 5. Build Frontend Assets

**Untuk Development (dengan hot reload):**
```bash
npm run dev
```
Biarkan terminal ini tetap berjalan.

**Atau untuk Production:**
```bash
npm run build
```

---

## Jalankan Aplikasi

### Terminal 1: Laravel Server

```bash
php artisan serve
```

Output:
```
INFO  Server running on [http://127.0.0.1:8000].
```

**Akses:** http://localhost:8000

---

## Login Pertama Kali

### Super Administrator
```
Email: admin@sanglah.go.id
Password: password
```
**Akses:** Full system access

### Validator IGD
```
Email: validator.igd@sanglah.go.id
Password: password
```
**Akses:** Membuat & validasi SOP

### Validator Rawat Inap
```
Email: validator.ranap@sanglah.go.id
Password: password
```
**Akses:** Membuat & validasi SOP

### User/Pegawai IGD
```
Email: pegawai.igd@sanglah.go.id
Password: password
```
**Akses:** Lihat & download SOP

### User/Pegawai Rawat Inap
```
Email: pegawai.ranap@sanglah.go.id
Password: password
```
**Akses:** Lihat & download SOP

---

## Verifikasi Setup

### 1. Cek Database
```bash
php artisan db:show
```

Harus menunjukkan database `sanglah_sop` dengan 10 tabel.

### 2. Cek Tables
```bash
php artisan db:table roles
```

Harus menampilkan 3 roles.

### 3. Test Login
Buka browser → http://localhost:8000 → Login dengan salah satu akun di atas.

---

## Troubleshooting Cepat

### Problem: Cannot create database
```bash
# Cek MySQL service aktif
# Windows: Services → MySQL
# Linux: sudo systemctl status mysql
```

### Problem: Migration error
```bash
# Reset database
php artisan migrate:fresh
# Jalankan ulang seeder
php artisan db:seed
```

### Problem: Permission denied on storage
```bash
# Windows (PowerShell as Admin):
icacls storage /grant "Everyone:(OI)(CI)F" /T
icacls bootstrap/cache /grant "Everyone:(OI)(CI)F" /T

# Linux/Mac:
chmod -R 775 storage bootstrap/cache
```

### Problem: npm run dev error
```bash
# Clear cache
npm cache clean --force
# Reinstall
rm -rf node_modules package-lock.json
npm install
```

---

## Next Steps

Setelah setup berhasil:

1. ✅ **Authentication** → Install Laravel Breeze (next step)
2. ✅ **Models** → Buat Eloquent models dengan relasi
3. ✅ **Controllers** → Implement business logic
4. ✅ **Views** → Buat UI dengan Blade templates
5. ✅ **Testing** → Test fitur-fitur utama

---

## Command Reference

| Command | Deskripsi |
|---------|-----------|
| `php artisan serve` | Jalankan development server |
| `php artisan migrate` | Jalankan migrasi database |
| `php artisan migrate:fresh` | Reset & migrasi ulang |
| `php artisan db:seed` | Isi data awal |
| `php artisan migrate:fresh --seed` | Reset + migrasi + seed |
| `php artisan storage:link` | Buat symlink storage |
| `php artisan route:list` | Lihat semua routes |
| `php artisan config:cache` | Cache konfigurasi |
| `php artisan config:clear` | Clear cache konfigurasi |
| `npm run dev` | Development mode (hot reload) |
| `npm run build` | Build production assets |

---

## Selesai! 🎉

Aplikasi sudah siap digunakan. Untuk panduan lengkap, lihat:
- [README.md](../README.md) - Overview project
- [SETUP_GUIDE.md](./SETUP_GUIDE.md) - Panduan setup lengkap
- [DATABASE_STRUCTURE.md](./DATABASE_STRUCTURE.md) - Struktur database
- [WORKFLOW.md](./WORKFLOW.md) - Alur kerja sistem

Jika ada masalah, hubungi tim IT atau buat issue di repository.
