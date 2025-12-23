# Sistem Informasi Manajemen SOP Rumah Sakit Sanglah

> Sistem Informasi Manajemen (SIM) untuk pengelolaan Standar Operasional Prosedur (SOP) di lingkungan Rumah Sakit Sanglah. 
> Dikembangkan menggunakan Laravel 12 fullstack dengan MySQL sebagai database.

[![Laravel](https://img.shields.io/badge/Laravel-12.x-red.svg)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-blue.svg)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-8.0+-orange.svg)](https://mysql.com)

## 📋 Daftar Isi

- [Fitur Utama](#-fitur-utama)
- [Teknologi](#-teknologi)
- [Quick Start](#-quick-start)
- [Dokumentasi](#-dokumentasi)
- [Status Project](#-status-project)
- [Lisensi](#-lisensi)

## ✨ Fitur Utama

### 👥 Role & Hak Akses
- **Super Admin**: Manajemen penuh sistem, user management, role management, audit log, backup data
- **Validator**: Membuat SOP baru, validasi SOP, pembatalan SOP dengan catatan
- **User (Pegawai)**: Melihat, mencari, dan mengunduh SOP yang telah divalidasi

### 📝 Manajemen SOP
- ✅ Pembuatan SOP dengan data lengkap (nomor SK, tanggal, judul, unit, deskripsi, versi, status)
- ✅ Upload file SOP format PDF
- ✅ Workflow validasi SOP (approve/reject)
- ✅ Versioning SOP (tracking perubahan)
- ✅ Histori SOP lengkap dengan audit trail

### 🔔 Notifikasi
- ✅ Notifikasi sistem untuk validator (SOP menunggu validasi)
- ✅ Notifikasi status SOP (disetujui/dibatalkan)
- ⏳ Opsional: notifikasi email (planned)

### 📊 Audit & Log
- ✅ Tracking semua aktivitas SOP
- ✅ Log pembuatan, validasi, revisi, dan penghapusan
- ✅ Informasi lengkap (siapa, kapan, apa, dari mana)

## 🛠️ Teknologi

| Komponen | Teknologi |
|----------|-----------|
| **Framework** | Laravel 12 |
| **Database** | MySQL 8.0+ |
| **Authentication** | Laravel Breeze (planned) |
| **Frontend** | Blade Templates + Tailwind CSS |
| **Language** | PHP 8.2+ |
| **Package Manager** | Composer, NPM |

## 🚀 Quick Start

### 1. Buat Database MySQL

```sql
CREATE DATABASE sanglah_sop CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Atau gunakan file SQL yang tersedia:
```bash
# Jika menggunakan MySQL CLI
mysql -u root -p < database/create_database.sql
```

### 2. Install Dependencies

```bash
composer install
npm install
```

### 3. Setup Database

```bash
# Jalankan migrasi
php artisan migrate

# Isi data awal
php artisan db:seed

# Buat storage link
php artisan storage:link
```

### 4. Build Assets & Run

```bash
# Build frontend assets
npm run build

# Jalankan development server
php artisan serve
```

**Akses:** http://localhost:8000

### 5. Login

| Role | Email | Password |
|------|-------|----------|
| **Super Admin** | admin@sanglah.go.id | password |
| **Validator** | validator.igd@sanglah.go.id | password |
| **User** | pegawai.igd@sanglah.go.id | password |

## 📚 Dokumentasi

Dokumentasi lengkap tersedia di folder `docs/`:

| Dokumen | Deskripsi |
|---------|-----------|
| [📖 Quick Start Guide](docs/QUICK_START.md) | Panduan cepat setup dalam 15 menit |
| [⚙️ Setup Guide](docs/SETUP_GUIDE.md) | Panduan instalasi lengkap dan troubleshooting |
| [🗄️ Database Structure](docs/DATABASE_STRUCTURE.md) | Struktur database, relasi, dan ERD |
| [🔄 Workflow](docs/WORKFLOW.md) | Alur kerja sistem dan business logic |

## 📊 Struktur Database

### Tabel Utama
- **roles** - 3 role: Super Admin, Validator, User
- **units** - 8 unit rumah sakit default
- **users** - Data pengguna dengan role dan unit
- **sops** - Data SOP dengan status workflow
- **sop_versions** - Histori versi SOP
- **validations** - Data proses validasi
- **notifications** - Notifikasi sistem
- **activity_logs** - Audit trail lengkap

### Relasi
```
roles (1:N) users (1:N) sops (1:N) sop_versions
units (1:N) users              |
units (1:N) sops               +---> validations
users (1:N) notifications
users (1:N) activity_logs
```

Untuk detail lengkap, lihat [Database Structure](docs/DATABASE_STRUCTURE.md).

## 🔐 User Default

Setelah menjalankan seeder:

| Role | Email | Password | Unit |
|------|-------|----------|------|
| Super Admin | admin@sanglah.go.id | password | IT |
| Validator | validator.igd@sanglah.go.id | password | IGD |
| Validator | validator.ranap@sanglah.go.id | password | Rawat Inap |
| User | pegawai.igd@sanglah.go.id | password | IGD |
| User | pegawai.ranap@sanglah.go.id | password | Rawat Inap |

> ⚠️ **Penting**: Ubah password default setelah login pertama kali!

## 📁 Struktur Project

```
SANGLAH-SOP/
├── app/
│   ├── Http/
│   │   ├── Controllers/     # Business logic controllers
│   │   └── Middleware/      # Custom middleware
│   ├── Models/              # Eloquent models
│   └── Services/            # Service layer
├── database/
│   ├── migrations/          # Database migrations (10 tables)
│   ├── seeders/             # Data seeders (roles, units, users)
│   └── create_database.sql  # SQL script helper
├── docs/                    # Dokumentasi lengkap
│   ├── QUICK_START.md
│   ├── SETUP_GUIDE.md
│   ├── DATABASE_STRUCTURE.md
│   └── WORKFLOW.md
├── resources/
│   ├── views/               # Blade templates
│   └── js/                  # JavaScript & CSS
├── routes/
│   └── web.php              # Web routes
├── storage/
│   └── app/public/sops/     # Upload SOP files
└── .env                     # Environment config (MySQL)
```

## 🎯 Status Project

### ✅ Completed
- [x] Laravel 12 project setup
- [x] Database structure & migrations
- [x] Database seeders (roles, units, users)
- [x] Environment configuration (.env)
- [x] Documentation (README, guides, workflow)
- [x] Git configuration

### ⏳ In Progress / Planned
- [ ] Laravel Breeze authentication
- [ ] Eloquent models & relationships
- [ ] Controllers & routes
- [ ] Blade templates & UI
- [ ] SOP CRUD functionality
- [ ] Validation workflow
- [ ] Notification system
- [ ] File upload & management
- [ ] Activity logging
- [ ] User management (admin)
- [ ] Search & filter
- [ ] Dashboard & statistics

## 🔨 Development

### Mode Development

**Terminal 1: Laravel Server**
```bash
php artisan serve
```

**Terminal 2: Vite Dev Server (Hot Reload)**
```bash
npm run dev
```

### Testing
```bash
php artisan test
```

### Code Style (Laravel Pint)
```bash
./vendor/bin/pint
```

### Useful Commands

```bash
# Reset database
php artisan migrate:fresh --seed

# Clear all caches
php artisan optimize:clear

# View routes
php artisan route:list

# Check database
php artisan db:show

# View specific table
php artisan db:table users
```

## 🐛 Troubleshooting

### Database Connection Error
```bash
# Cek MySQL service aktif
# Verifikasi kredensial di .env
# Test koneksi: php artisan db:show
```

### Migration Error
```bash
# Reset & migrate ulang
php artisan migrate:fresh
php artisan db:seed
```

### Permission Error (Storage)
```bash
# Windows (PowerShell as Admin)
icacls storage /grant "Everyone:(OI)(CI)F" /T
icacls bootstrap/cache /grant "Everyone:(OI)(CI)F" /T

# Linux/Mac
chmod -R 775 storage bootstrap/cache
```

Untuk troubleshooting lengkap, lihat [Setup Guide](docs/SETUP_GUIDE.md).

## 🤝 Contributing

Project ini dikembangkan untuk internal Rumah Sakit Sanglah. Untuk kontribusi atau feedback, hubungi tim IT.

## 📝 Lisensi

Sistem ini dikembangkan untuk Rumah Sakit Sanglah. © 2025 RS Sanglah.

## 📞 Kontak

Untuk pertanyaan, dukungan teknis, atau feedback:
- **Tim IT Rumah Sakit Sanglah**
- **Email**: it@sanglah.go.id

---

**Dibuat dengan ❤️ untuk Rumah Sakit Sanglah**
