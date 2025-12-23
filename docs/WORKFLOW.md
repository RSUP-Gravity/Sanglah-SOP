# Workflow Sistem SIM SOP

## 1. Alur Kerja SOP (SOP Workflow)

### A. Pembuatan SOP Baru

```
1. Validator Login
2. Akses Menu "Buat SOP Baru"
3. Isi Form SOP:
   - Nomor SK
   - Tanggal Penetapan SK
   - Judul SOP
   - Unit Terkait
   - Deskripsi SOP
   - Upload File PDF
4. Submit → Status: DRAFT
5. Validator review → Kirim untuk Validasi
6. Status berubah: PENDING
7. Sistem kirim notifikasi ke validator yang ditunjuk
```

### B. Validasi SOP

```
1. Validator menerima notifikasi
2. Buka detail SOP
3. Review konten SOP dan file PDF
4. Pilihan:
   a. APPROVE:
      - Klik tombol "Setujui"
      - Status SOP: APPROVED
      - approved_at: timestamp sekarang
      - approved_by: user_id validator
      - Notifikasi ke pembuat SOP
      - SOP aktif dan dapat dilihat User
      
   b. REJECT:
      - Klik tombol "Tolak"
      - Isi catatan penolakan
      - Status SOP: REJECTED
      - rejection_note: catatan validator
      - Notifikasi ke pembuat SOP
      - SOP tidak dapat dilihat User
```

### C. Revisi SOP

```
1. Jika SOP ditolak, Validator dapat revisi
2. Buka SOP yang ditolak
3. Klik "Revisi SOP"
4. Edit data SOP
5. Upload file PDF baru (opsional)
6. Submit → Status kembali ke PENDING
7. Proses validasi ulang
```

### D. Versioning SOP

```
1. Untuk SOP yang sudah APPROVED
2. Validator klik "Buat Versi Baru"
3. Sistem otomatis:
   - Simpan versi lama ke tabel sop_versions
   - Buat record baru di sop_versions dengan version++
4. Isi form perubahan:
   - Deskripsi perubahan
   - Upload file PDF baru
5. Submit → Status: PENDING
6. Proses validasi seperti SOP baru
7. Setelah approved, versi baru menjadi aktif
```

### E. Arsip SOP

```
1. Super Admin atau Validator
2. Pilih SOP yang akan diarsipkan
3. Klik "Arsipkan"
4. Status berubah: ARCHIVED
5. SOP tidak muncul di daftar aktif
6. Tetap dapat dilihat di menu "Arsip"
```

---

## 2. Alur User Management

### A. Menambah User Baru (Super Admin)

```
1. Super Admin login
2. Menu "Manajemen User"
3. Klik "Tambah User"
4. Isi form:
   - Nama Lengkap
   - NIP
   - Email
   - Role (Super Admin/Validator/User)
   - Unit
   - Nomor Telepon
   - Alamat
5. Sistem generate password default
6. Submit
7. User baru dapat login dengan:
   - Email: yang didaftarkan
   - Password: password default (harus diganti saat login pertama)
```

### B. Edit User (Super Admin)

```
1. Super Admin login
2. Menu "Manajemen User"
3. Pilih user yang akan diedit
4. Edit data yang diperlukan
5. Submit
6. Activity log tercatat
```

### C. Nonaktifkan User (Super Admin)

```
1. Super Admin login
2. Menu "Manajemen User"
3. Pilih user
4. Toggle status aktif
5. User tidak dapat login
6. Data user tetap tersimpan
```

---

## 3. Alur Notifikasi

### A. Notifikasi Validasi

```
TRIGGER: SOP status berubah ke PENDING

Sistem otomatis:
1. Cari validator yang sesuai dengan unit SOP
2. Buat record di tabel notifications:
   - user_id: validator
   - type: sop_validation_request
   - title: "SOP Baru Menunggu Validasi"
   - message: "SOP '[judul]' memerlukan validasi Anda"
   - data: {sop_id, sk_number}
3. Notifikasi muncul di menu notifikasi validator
4. Badge counter notifikasi bertambah
5. (Opsional) Kirim email ke validator
```

### B. Notifikasi Approval

```
TRIGGER: SOP disetujui validator

Sistem otomatis:
1. Buat notifikasi untuk pembuat SOP
2. Isi notifikasi:
   - type: sop_approved
   - title: "SOP Disetujui"
   - message: "SOP '[judul]' telah disetujui"
3. Update status is_read: false
4. Notifikasi muncul di menu pembuat SOP
```

### C. Notifikasi Rejection

```
TRIGGER: SOP ditolak validator

Sistem otomatis:
1. Buat notifikasi untuk pembuat SOP
2. Isi notifikasi:
   - type: sop_rejected
   - title: "SOP Ditolak"
   - message: "SOP '[judul]' ditolak. Alasan: [catatan]"
3. Notifikasi muncul di menu pembuat SOP
4. Highlight merah untuk notifikasi rejection
```

---

## 4. Alur Activity Log

Setiap aksi penting dicatat dalam activity_logs:

### A. Log Creation

```
TRIGGER: SOP baru dibuat

Record:
- user_id: pembuat
- action: created
- model_type: App\Models\Sop
- model_id: id SOP
- description: "Membuat SOP baru: [judul]"
- new_values: {semua data SOP}
- ip_address: IP pembuat
- user_agent: Browser info
```

### B. Log Update

```
TRIGGER: SOP diupdate

Record:
- user_id: pengupdate
- action: updated
- model_type: App\Models\Sop
- model_id: id SOP
- description: "Mengupdate SOP: [judul]"
- old_values: {data sebelum update}
- new_values: {data setelah update}
- ip_address: IP pengupdate
- user_agent: Browser info
```

### C. Log Validation

```
TRIGGER: SOP divalidasi (approve/reject)

Record:
- user_id: validator
- action: validated
- model_type: App\Models\Sop
- model_id: id SOP
- description: "Memvalidasi SOP: [judul] - Status: [approved/rejected]"
- old_values: {status: pending}
- new_values: {status: approved/rejected, notes}
- ip_address: IP validator
- user_agent: Browser info
```

---

## 5. Alur Pencarian SOP (User)

### A. Pencarian Sederhana

```
1. User login
2. Menu "Daftar SOP"
3. Ketik keyword di search box
4. Sistem cari di:
   - Judul SOP
   - Nomor SK
   - Deskripsi
5. Tampilkan hasil
6. User klik SOP untuk lihat detail
7. User download PDF
```

### B. Pencarian Advanced

```
1. User klik "Pencarian Lanjutan"
2. Filter:
   - Unit
   - Tanggal (range)
   - Status
   - Versi
3. Submit filter
4. Tampilkan hasil sesuai filter
5. User dapat sorting:
   - Terbaru
   - Terlama
   - A-Z
   - Z-A
```

---

## 6. Role & Permissions

### A. Super Admin

**Dapat:**
- ✅ Semua akses Validator
- ✅ Manajemen user (CRUD)
- ✅ Manajemen role
- ✅ Manajemen unit
- ✅ Lihat semua activity log
- ✅ Backup/restore database
- ✅ Setting sistem
- ✅ Arsip/restore SOP
- ✅ Delete SOP (soft delete)

**Tidak dapat:**
- ❌ (tidak ada batasan)

### B. Validator

**Dapat:**
- ✅ Buat SOP baru
- ✅ Edit SOP yang dibuat sendiri (jika masih draft/rejected)
- ✅ Validasi SOP (approve/reject)
- ✅ Buat versi baru SOP
- ✅ Lihat semua SOP (termasuk draft)
- ✅ Lihat notifikasi validasi
- ✅ Download SOP PDF
- ✅ Lihat activity log SOP sendiri

**Tidak dapat:**
- ❌ Delete SOP
- ❌ Manajemen user
- ❌ Manajemen unit
- ❌ Lihat activity log user lain
- ❌ Arsip SOP
- ❌ Setting sistem

### C. User/Pegawai

**Dapat:**
- ✅ Lihat SOP yang sudah approved
- ✅ Cari SOP (simple & advanced)
- ✅ Download SOP PDF
- ✅ Lihat detail SOP
- ✅ Lihat histori versi SOP
- ✅ Lihat notifikasi (jika ada)

**Tidak dapat:**
- ❌ Buat SOP
- ❌ Edit SOP
- ❌ Validasi SOP
- ❌ Lihat SOP draft/pending/rejected
- ❌ Manajemen user
- ❌ Lihat activity log
- ❌ Setting sistem

---

## 7. Status SOP & Transisi

```
DRAFT → PENDING → APPROVED → (aktif)
                → REJECTED → (revisi) → PENDING
                
APPROVED → ARCHIVED → (tidak aktif, bisa dilihat di arsip)

APPROVED → (versi baru) → PENDING → APPROVED (versi baru aktif)
```

**Status Explanation:**
- **DRAFT**: SOP baru dibuat, belum dikirim validasi
- **PENDING**: Menunggu validasi dari validator
- **APPROVED**: Disetujui validator, aktif dan dapat dilihat user
- **REJECTED**: Ditolak validator, perlu revisi
- **ARCHIVED**: Diarsipkan, tidak aktif tapi masih bisa dilihat

---

## 8. File Management

### A. Upload SOP PDF

```
1. Validator upload file
2. Validasi:
   - Format: hanya PDF
   - Ukuran: max 10MB
   - Nama file: sanitize
3. Simpan ke: storage/app/public/sops/{year}/{month}/
4. Nama file: {timestamp}_{original_name}.pdf
5. Simpan path dan nama ke database
```

### B. Download SOP PDF

```
1. User klik "Download"
2. Sistem cek authorization:
   - Super Admin/Validator: bisa download semua
   - User: hanya SOP approved
3. Generate download URL
4. Browser download file
5. (Opsional) Log download activity
```

### C. Storage Structure

```
storage/
└── app/
    └── public/
        └── sops/
            ├── 2025/
            │   ├── 01/
            │   │   ├── 1640000000_sop_igd.pdf
            │   │   └── 1640000001_sop_ranap.pdf
            │   └── 02/
            └── 2026/
```

---

## 9. Security & Validation

### A. Input Validation

- Semua input harus divalidasi
- Gunakan Laravel Form Request
- Sanitize input untuk mencegah XSS
- CSRF protection di semua form

### B. Authorization

- Gunakan Laravel Policies
- Middleware untuk cek role
- Gate untuk permission spesifik

### C. File Security

- Validasi MIME type
- Scan virus (opsional dengan ClamAV)
- Private storage, download via controller
- Token-based download URL

---

## 10. Monitoring & Maintenance

### A. Daily Tasks

- Backup database
- Cek error log
- Monitor storage usage

### B. Weekly Tasks

- Review activity logs
- Cek notifikasi pending
- Cleanup old notifications (>30 hari)

### C. Monthly Tasks

- Database optimization
- Archive old logs
- Generate report SOP statistics

---

## Catatan Implementasi

Workflow ini akan diimplementasikan dalam:
- **Controllers**: Business logic
- **Models**: Data & relationships
- **Policies**: Authorization
- **Events & Listeners**: Notifikasi otomatis
- **Jobs**: Background tasks
- **Middleware**: Access control

Untuk implementasi detail, lihat kode di masing-masing file controller dan model.
