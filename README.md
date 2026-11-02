# Website UKM Sosial Rencang

Website resmi **Rencang**, Unit Kegiatan Mahasiswa (UKM) sosial di Universitas Multimedia Nusantara: <https://rencang.umn.ac.id>.

Isinya profil organisasi, kategori kegiatan, dan arsip program (GEDURASI, SENTERA, Sharing Caring Helping, Rencang Cepat Tanggap, Keakraban). Semua halaman bersifat statis: tidak ada login, form, atau database.

| | |
|---|---|
| Framework | Laravel 12 (PHP ≥ 8.2) |
| Frontend | Blade + Bootstrap 4.5, jQuery 3.5 (lewat CDN), CSS per halaman di `public/css` |
| Database | Tidak dipakai |
| Hosting | Server IT UMN, unggah lewat FTP (lihat [docs/DEPLOY.md](docs/DEPLOY.md)) |

> ⚠️ **Laravel 12 hanya menerima patch keamanan sampai 24 Februari 2027.** Rencanakan upgrade ke Laravel 13 (butuh PHP 8.3) sebelum tanggal itu. Detail di [docs/AUDIT_DAN_ROADMAP.md](docs/AUDIT_DAN_ROADMAP.md) §10.

---

## Menjalankan di komputer sendiri

Kebutuhan: **PHP 8.2+** (misalnya dari XAMPP atau Laragon), **Composer 2**, dan **Git**. Node.js tidak diperlukan.

```bash
git clone https://github.com/calvnvn/Rencang-2022.git rencang-website
cd rencang-website
composer install
copy .env.example .env
php artisan key:generate
```

`.env.example` berisi nilai **produksi**. Untuk lokal, ubah empat baris ini di `.env`:

```dotenv
APP_ENV=local
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000
SESSION_SECURE_COOKIE=false
```

Lalu jalankan:

```bash
php artisan serve
```

Buka <http://127.0.0.1:8000>. Butuh koneksi internet karena Bootstrap dan jQuery dimuat dari CDN.

## Struktur folder

```
app/Support/EventBanner.php     Logika kapan banner event di beranda tampil
config/rencang.php              Data organisasi & banner event (ubah di sini, bukan di Blade)
routes/web.php                  Daftar semua halaman (Route::view)
resources/views/
  layouts/app.blade.php         Kerangka HTML: <head>, navbar, footer, script
  partials/navbar.blade.php
  partials/footer.blade.php
  pages/*.blade.php             Satu file per halaman, nama = slug URL
  errors/404|500|503.blade.php  Halaman error bergaya Rencang
public/
  css/<halaman>/*.css           CSS per halaman
  fonts/, images/, js/          Aset statis
tests/
  Feature/PagesTest.php         Semua halaman 200, aset ada, 404, banner
  Unit/EventBannerTest.php
docs/                           Dokumentasi proyek (lihat daftar di bawah)
```

## Tugas yang sering dilakukan

### Mengganti atau menyembunyikan banner event di beranda

1. Buka `config/rencang.php`, ubah bagian `event_banner`:
   ```php
   'event_banner' => [
       'name' => 'NAMA EVENT',
       'ends_at' => '2026-12-01 23:59:00',   // format wajib: YYYY-MM-DD HH:MM:SS (WIB)
       'registration_url' => 'https://forms.gle/...',
   ],
   ```
2. Ganti teks dan logo banner di `resources/views/pages/home.blade.php` (blok di dalam `@if ($showBanner)`).
3. Setelah `ends_at` lewat, banner dan countdown **hilang sendiri**. Tanggal yang salah format membuat banner tidak tampil.

### Menambah halaman baru

1. Buat `resources/views/pages/nama-halaman.blade.php`, mulai dengan `@extends('layouts.app')`.
2. Daftarkan di `routes/web.php`:
   ```php
   Route::view('/nama-halaman', 'pages.nama-halaman', ['title' => 'Rencang - Nama'])->name('nama-halaman');
   ```
3. Tambahkan baris ke daftar `pages()` di `tests/Feature/PagesTest.php`.
4. Jalankan `composer test`.

### Konvensi

- **Nama route = slug URL = nama file view**, huruf kecil dengan tanda hubung (`sharing-caring-helping`).
- Tautan antarhalaman memakai `route('nama')`; aset memakai `asset('path')`. Jangan menulis path relatif seperti `images/...` tanpa `asset()`.
- Nama file aset baru: huruf kecil, tanpa spasi (`foto-kegiatan-1.webp`), dan sebaiknya < 300 KB.

## Pengecekan sebelum commit

```bash
composer test        # semua test harus lulus
composer lint        # format kode PHP (Laravel Pint); perbaiki otomatis dengan: vendor\bin\pint
composer audit       # tidak boleh ada advisory keamanan
```

## Dokumentasi

| Dokumen | Isi |
|---|---|
| [docs/DEPLOY.md](docs/DEPLOY.md) | Cara mengunggah ke server UMN, checklist, rollback |
| [docs/MIGRASI_LARAVEL_12.md](docs/MIGRASI_LARAVEL_12.md) | Apa yang berubah dari Laravel 8 ke 12 dan bukti pengujiannya |
| [docs/AUDIT_DAN_ROADMAP.md](docs/AUDIT_DAN_ROADMAP.md) | Temuan keamanan, kualitas, aksesibilitas, dan rencana perbaikan |
| [docs/ARCHITECTURE.md](docs/ARCHITECTURE.md) | Analisis arsitektur versi lama (Laravel 8), latar belakang upgrade |
| [docs/PRD.md](docs/PRD.md) | Kebutuhan produk, persona, dan ruang lingkup |
| [docs/DESIGN_SYSTEM.md](docs/DESIGN_SYSTEM.md) | Warna, tipografi, komponen, dan audit kontras |

## Kontak

UKM Sosial Rencang · <rencang@umn.ac.id> · Instagram [@rencangaye](https://www.instagram.com/rencangaye/)
