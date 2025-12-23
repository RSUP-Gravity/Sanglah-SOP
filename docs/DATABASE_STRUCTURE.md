# Struktur Database - SIM SOP Rumah Sakit Sanglah

## Overview
Database untuk Sistem Informasi Manajemen SOP menggunakan MySQL dengan struktur relasional yang terorganisir.

## Tabel Database

### 1. roles
Menyimpan jenis role/peran pengguna dalam sistem.

| Kolom | Tipe | Deskripsi |
|-------|------|-----------|
| id | BIGINT (PK) | ID unik role |
| name | VARCHAR | Nama role (super_admin, validator, user) |
| display_name | VARCHAR | Nama tampilan role |
| description | TEXT | Deskripsi role |
| created_at | TIMESTAMP | Waktu pembuatan |
| updated_at | TIMESTAMP | Waktu update terakhir |

**Data Default:**
- Super Administrator
- Validator SOP
- User/Pegawai

---

### 2. units
Menyimpan data unit/bagian rumah sakit.

| Kolom | Tipe | Deskripsi |
|-------|------|-----------|
| id | BIGINT (PK) | ID unik unit |
| code | VARCHAR | Kode unit (unik) |
| name | VARCHAR | Nama unit |
| description | TEXT | Deskripsi unit |
| is_active | BOOLEAN | Status aktif |
| created_at | TIMESTAMP | Waktu pembuatan |
| updated_at | TIMESTAMP | Waktu update terakhir |

**Data Default:**
- IGD (Instalasi Gawat Darurat)
- Rawat Inap
- Rawat Jalan
- Laboratorium
- Radiologi
- Farmasi
- Teknologi Informasi
- Administrasi

---

### 3. users
Menyimpan data pengguna sistem.

| Kolom | Tipe | Deskripsi |
|-------|------|-----------|
| id | BIGINT (PK) | ID unik user |
| role_id | BIGINT (FK) | Foreign key ke roles |
| unit_id | BIGINT (FK) | Foreign key ke units (nullable) |
| name | VARCHAR | Nama lengkap |
| nip | VARCHAR | Nomor Induk Pegawai (unik) |
| email | VARCHAR | Email (unik) |
| email_verified_at | TIMESTAMP | Waktu verifikasi email |
| password | VARCHAR | Password (hashed) |
| phone | VARCHAR | Nomor telepon |
| address | TEXT | Alamat |
| is_active | BOOLEAN | Status aktif |
| remember_token | VARCHAR | Token remember me |
| created_at | TIMESTAMP | Waktu pembuatan |
| updated_at | TIMESTAMP | Waktu update terakhir |

**Relasi:**
- Belongs to: roles, units
- Has many: sops, validations, notifications, activity_logs

---

### 4. sops
Menyimpan data SOP (Standar Operasional Prosedur).

| Kolom | Tipe | Deskripsi |
|-------|------|-----------|
| id | BIGINT (PK) | ID unik SOP |
| unit_id | BIGINT (FK) | Foreign key ke units |
| created_by | BIGINT (FK) | Foreign key ke users (pembuat) |
| sk_number | VARCHAR | Nomor SK (unik) |
| sk_date | DATE | Tanggal penetapan SK |
| title | VARCHAR | Judul SOP |
| description | TEXT | Deskripsi SOP |
| version | VARCHAR | Versi SOP (default: 1.0) |
| status | ENUM | Status: draft, pending, approved, rejected, archived |
| file_path | VARCHAR | Path file PDF |
| file_name | VARCHAR | Nama file PDF |
| rejection_note | TEXT | Catatan penolakan |
| approved_at | TIMESTAMP | Waktu approval |
| approved_by | BIGINT (FK) | Foreign key ke users (validator) |
| created_at | TIMESTAMP | Waktu pembuatan |
| updated_at | TIMESTAMP | Waktu update terakhir |
| deleted_at | TIMESTAMP | Waktu soft delete |

**Relasi:**
- Belongs to: units, users (created_by), users (approved_by)
- Has many: sop_versions, validations

**Status Flow:**
1. draft → SOP baru dibuat
2. pending → Menunggu validasi
3. approved → Disetujui validator
4. rejected → Ditolak validator
5. archived → Diarsipkan

---

### 5. sop_versions
Menyimpan histori versi SOP.

| Kolom | Tipe | Deskripsi |
|-------|------|-----------|
| id | BIGINT (PK) | ID unik versi |
| sop_id | BIGINT (FK) | Foreign key ke sops |
| version | VARCHAR | Nomor versi |
| changes_description | TEXT | Deskripsi perubahan |
| file_path | VARCHAR | Path file PDF versi ini |
| file_name | VARCHAR | Nama file PDF |
| created_by | BIGINT (FK) | Foreign key ke users (pembuat) |
| created_at | TIMESTAMP | Waktu pembuatan |
| updated_at | TIMESTAMP | Waktu update terakhir |

**Relasi:**
- Belongs to: sops, users

---

### 6. validations
Menyimpan data proses validasi SOP.

| Kolom | Tipe | Deskripsi |
|-------|------|-----------|
| id | BIGINT (PK) | ID unik validasi |
| sop_id | BIGINT (FK) | Foreign key ke sops |
| validator_id | BIGINT (FK) | Foreign key ke users (validator) |
| status | ENUM | Status: pending, approved, rejected |
| notes | TEXT | Catatan validator |
| validated_at | TIMESTAMP | Waktu validasi |
| created_at | TIMESTAMP | Waktu pembuatan |
| updated_at | TIMESTAMP | Waktu update terakhir |

**Relasi:**
- Belongs to: sops, users (validator)

---

### 7. notifications
Menyimpan notifikasi untuk pengguna.

| Kolom | Tipe | Deskripsi |
|-------|------|-----------|
| id | BIGINT (PK) | ID unik notifikasi |
| user_id | BIGINT (FK) | Foreign key ke users |
| type | VARCHAR | Tipe notifikasi |
| title | VARCHAR | Judul notifikasi |
| message | TEXT | Isi notifikasi |
| data | JSON | Data tambahan (sop_id, dll) |
| is_read | BOOLEAN | Status sudah dibaca |
| read_at | TIMESTAMP | Waktu dibaca |
| created_at | TIMESTAMP | Waktu pembuatan |
| updated_at | TIMESTAMP | Waktu update terakhir |

**Tipe Notifikasi:**
- sop_validation_request → SOP menunggu validasi
- sop_approved → SOP disetujui
- sop_rejected → SOP ditolak

**Relasi:**
- Belongs to: users

---

### 8. activity_logs
Menyimpan log aktivitas sistem untuk audit trail.

| Kolom | Tipe | Deskripsi |
|-------|------|-----------|
| id | BIGINT (PK) | ID unik log |
| user_id | BIGINT (FK) | Foreign key ke users (nullable) |
| action | VARCHAR | Jenis aksi (created, updated, deleted, validated, rejected) |
| model_type | VARCHAR | Tipe model yang diubah |
| model_id | BIGINT | ID model yang diubah |
| description | TEXT | Deskripsi aktivitas |
| old_values | JSON | Nilai sebelum perubahan |
| new_values | JSON | Nilai setelah perubahan |
| ip_address | VARCHAR | IP address user |
| user_agent | VARCHAR | User agent browser |
| created_at | TIMESTAMP | Waktu aktivitas |
| updated_at | TIMESTAMP | Waktu update terakhir |

**Index:**
- (model_type, model_id) → untuk pencarian log berdasarkan model

**Relasi:**
- Belongs to: users

---

### 9. password_reset_tokens
Menyimpan token reset password (default Laravel).

| Kolom | Tipe | Deskripsi |
|-------|------|-----------|
| email | VARCHAR (PK) | Email user |
| token | VARCHAR | Token reset |
| created_at | TIMESTAMP | Waktu pembuatan |

---

### 10. sessions
Menyimpan data session pengguna (default Laravel).

| Kolom | Tipe | Deskripsi |
|-------|------|-----------|
| id | VARCHAR (PK) | ID session |
| user_id | BIGINT (FK) | Foreign key ke users |
| ip_address | VARCHAR | IP address |
| user_agent | TEXT | User agent browser |
| payload | LONGTEXT | Data session |
| last_activity | INTEGER | Waktu aktivitas terakhir |

---

## Diagram Relasi (ERD)

```
roles (1) ----< (N) users (1) ----< (N) sops
                      |                    |
                      |                    +----< (N) sop_versions
                      |                    |
                      |                    +----< (N) validations
                      |
                      +----< (N) notifications
                      |
                      +----< (N) activity_logs

units (1) ----< (N) users
      (1) ----< (N) sops
```

## Konfigurasi Database

File: `.env`

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sanglah_sop
DB_USERNAME=root
DB_PASSWORD=
```

## Cara Setup Database

1. **Buat database MySQL:**
   ```sql
   CREATE DATABASE sanglah_sop CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```

2. **Jalankan migrasi:**
   ```bash
   php artisan migrate
   ```

3. **Jalankan seeder:**
   ```bash
   php artisan db:seed
   ```

## User Default Setelah Seeder

| Role | Email | Password | Unit |
|------|-------|----------|------|
| Super Admin | admin@sanglah.go.id | password | IT |
| Validator | validator.igd@sanglah.go.id | password | IGD |
| Validator | validator.ranap@sanglah.go.id | password | Rawat Inap |
| User | pegawai.igd@sanglah.go.id | password | IGD |
| User | pegawai.ranap@sanglah.go.id | password | Rawat Inap |

## Catatan Penting

1. **Soft Delete**: Tabel `sops` menggunakan soft delete untuk menjaga audit trail
2. **Cascade Delete**: Hapus user akan menghapus semua data terkait
3. **Foreign Keys**: Semua relasi menggunakan foreign key constraint
4. **Index**: activity_logs memiliki composite index untuk performa
5. **JSON Fields**: notifications dan activity_logs menggunakan JSON untuk data fleksibel
6. **Timestamps**: Semua tabel memiliki created_at dan updated_at
7. **Encoding**: UTF-8 (utf8mb4) untuk mendukung karakter Indonesia

## Backup & Maintenance

Untuk backup database:
```bash
mysqldump -u root -p sanglah_sop > backup_sanglah_sop_$(date +%Y%m%d).sql
```

Untuk restore:
```bash
mysql -u root -p sanglah_sop < backup_sanglah_sop_YYYYMMDD.sql
```
