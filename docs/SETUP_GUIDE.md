# Panduan Setup dan Konfigurasi

## Prasyarat

Pastikan Anda telah menginstall:
- PHP 8.2 atau lebih tinggi
- Composer
- MySQL 8.0 atau lebih tinggi
- Node.js dan NPM

## Langkah-Langkah Setup

### 1. Konfigurasi Database

Sudah dikonfigurasikan di file `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sanglah_sop
DB_USERNAME=root
DB_PASSWORD=
```

### 2. Buat Database MySQL

Buka MySQL CLI atau phpMyAdmin, kemudian jalankan:

```sql
CREATE DATABASE sanglah_sop CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 3. Install Dependencies

Jika belum terinstall, jalankan:

```bash
composer install
npm install
```

### 4. Generate Application Key

Sudah otomatis ter-generate saat instalasi Laravel. Jika perlu generate ulang:

```bash
php artisan key:generate
```

### 5. Jalankan Database Migration

```bash
php artisan migrate
```

Akan membuat tabel-tabel:
- roles
- units
- users (dengan modifikasi)
- sops
- sop_versions
- validations
- notifications
- activity_logs
- password_reset_tokens
- sessions

### 6. Jalankan Database Seeder

```bash
php artisan db:seed
```

Akan mengisi data default:
- 3 roles (Super Admin, Validator, User)
- 8 units (IGD, Rawat Inap, Rawat Jalan, Lab, Radiologi, Farmasi, IT, Admin)
- 5 users (1 admin, 2 validator, 2 user pegawai)

### 7. Build Frontend Assets

```bash
npm run build
```

Atau untuk development mode dengan hot reload:

```bash
npm run dev
```

### 8. Jalankan Server Development

```bash
php artisan serve
```

Server akan berjalan di: **http://localhost:8000**

## Login Default

### Super Administrator
- **Email**: admin@sanglah.go.id
- **Password**: password
- **Akses**: Full access ke seluruh sistem

### Validator IGD
- **Email**: validator.igd@sanglah.go.id
- **Password**: password
- **Akses**: Membuat dan memvalidasi SOP

### Validator Rawat Inap
- **Email**: validator.ranap@sanglah.go.id
- **Password**: password
- **Akses**: Membuat dan memvalidasi SOP

### User/Pegawai IGD
- **Email**: pegawai.igd@sanglah.go.id
- **Password**: password
- **Akses**: Melihat dan mengunduh SOP

### User/Pegawai Rawat Inap
- **Email**: pegawai.ranap@sanglah.go.id
- **Password**: password
- **Akses**: Melihat dan mengunduh SOP

## Struktur Folder Penting

```
SANGLAH-SOP/
├── app/
│   ├── Http/
│   │   ├── Controllers/    # Controller untuk logika bisnis
│   │   └── Middleware/     # Middleware untuk authorization
│   ├── Models/             # Eloquent models
│   └── Services/           # Business logic services
├── database/
│   ├── migrations/         # Database migrations
│   └── seeders/            # Database seeders
├── resources/
│   ├── views/              # Blade templates
│   └── js/                 # JavaScript files
├── routes/
│   └── web.php             # Web routes
├── storage/
│   └── app/
│       └── public/
│           └── sops/       # Folder untuk upload SOP PDF
└── public/
    └── storage/            # Symlink ke storage/app/public
```

## Konfigurasi Storage untuk Upload File

Buat symlink untuk storage:

```bash
php artisan storage:link
```

Ini akan membuat symbolic link dari `public/storage` ke `storage/app/public`, sehingga file yang diupload dapat diakses via web.

## Testing

Untuk menjalankan test:

```bash
php artisan test
```

## Code Style

Untuk memeriksa dan memperbaiki code style menggunakan Laravel Pint:

```bash
./vendor/bin/pint
```

## Troubleshooting

### Error: "Access denied for user 'root'@'localhost'"

Pastikan MySQL server berjalan dan kredensial di `.env` benar.

### Error: "SQLSTATE[HY000] [1049] Unknown database"

Pastikan database `sanglah_sop` sudah dibuat.

### Error: "Class 'App\Models\...' not found"

Jalankan:
```bash
composer dump-autoload
```

### Error: Storage link sudah ada

Jika sudah ada symlink, hapus dulu:
```bash
rm public/storage
php artisan storage:link
```

## Development Mode

### Terminal 1: Laravel Server
```bash
php artisan serve
```

### Terminal 2: Vite Dev Server (Hot Reload)
```bash
npm run dev
```

Akses aplikasi di: http://localhost:8000

## Production Deployment

1. Set environment ke production di `.env`:
   ```env
   APP_ENV=production
   APP_DEBUG=false
   ```

2. Optimize Laravel:
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

3. Build production assets:
   ```bash
   npm run build
   ```

4. Setup proper web server (Apache/Nginx) dengan document root ke folder `public/`

## Next Steps

Setelah setup berhasil, Anda dapat:

1. **Install Laravel Breeze** untuk authentication UI
2. **Membuat Models** dengan relasi
3. **Membuat Controllers** untuk business logic
4. **Membuat Views** dengan Blade templates
5. **Implementasi fitur SOP management**
6. **Implementasi workflow validasi**
7. **Implementasi notifikasi sistem**

## Support

Untuk bantuan lebih lanjut, hubungi tim IT Rumah Sakit Sanglah atau lihat dokumentasi di folder `docs/`.
