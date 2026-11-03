# Rencang Website

[![PHP](https://img.shields.io/badge/PHP-8.2%2B-777BB4?logo=php&logoColor=white)](https://www.php.net/)
[![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?logo=laravel&logoColor=white)](https://laravel.com/)

Website resmi **UKM Sosial Rencang**, Universitas Multimedia Nusantara (UMN). Alamat resmi: `rencang.umn.ac.id`.

*Official website of Rencang, the student social community at Universitas Multimedia Nusantara, Indonesia.*

## Tentang

**Rencang** ("sahabat" dalam bahasa Jawa) adalah komunitas sosial mahasiswa UMN yang berdiri sejak 23 September 2007. Kegiatannya berfokus pada membantu sesama dalam bentuk materi maupun non-materi, mempererat kekeluargaan antaranggota, dan mengembangkan potensi anggotanya.

Website ini memperkenalkan Rencang kepada calon anggota, mitra, dan masyarakat umum, serta mengarsipkan kegiatan-kegiatannya.

### Isi website

| Halaman | Isi |
|---|---|
| Beranda | Sambutan, pengantar singkat tentang Rencang, dan banner event yang sedang berjalan |
| What We Do | Empat kategori kegiatan: Tahunan, Unggulan, Keakraban, dan Insidental |
| Who We Are | Profil, makna nama dan logo, tujuan, visi dan misi |
| Event | Rangkuman program kegiatan Generasi 13 dan 14 |
| Halaman program | GEDURASI (literasi), SENTERA (dukungan bagi pejuang kanker anak), Sharing Caring Helping (donor darah), Rencang Cepat Tanggap (bantuan bencana), dan Keakraban |

Website ini bersifat statis: tidak ada login, formulir, maupun database.

## Teknologi

- PHP 8.2 atau lebih baru, [Laravel 12](https://laravel.com/)
- Blade untuk tampilan, [Bootstrap 4](https://getbootstrap.com/docs/4.5/) dan jQuery (dimuat lewat CDN), serta CSS per halaman
- PHPUnit untuk pengujian dan [Laravel Pint](https://laravel.com/docs/pint) untuk format kode

## Menjalankan di komputer sendiri

**Yang dibutuhkan:** [PHP](https://www.php.net/downloads) 8.2+ dan [Composer](https://getcomposer.org/) 2. Node.js **tidak** diperlukan.

```bash
git clone <URL-repositori-ini> rencang-website
cd rencang-website
composer setup
php artisan serve
```

Buka <http://127.0.0.1:8000> di browser.

`composer setup` memasang dependensi, membuat file `.env` dari `.env.example`, dan membuat kunci aplikasi. Selama pengembangan, ubah `APP_ENV=local` dan `APP_DEBUG=true` di `.env` supaya pesan error tampil lengkap.

> Butuh koneksi internet, karena Bootstrap dan jQuery dimuat dari CDN. Bila Composer melaporkan ekstensi PHP yang belum aktif (misalnya `mbstring` atau `openssl`), aktifkan di `php.ini` lalu ulangi.

## Pengujian dan format kode

```bash
composer test    # menjalankan semua test
composer lint    # memeriksa format kode (perbaiki otomatis: vendor/bin/pint)
```

## Struktur proyek

```
config/rencang.php          Data organisasi dan pengaturan banner event
routes/web.php              Daftar halaman
resources/views/
  layouts/                  Kerangka halaman bersama
  partials/                 Navbar dan footer
  pages/                    Satu file per halaman
  errors/                   Halaman 404, 500, dan 503
public/
  css/                      CSS per halaman
  fonts/ images/ js/        Aset statis
tests/                      Pengujian otomatis
```

## Mengelola konten

**Banner event di beranda.** Atur nama, tanggal berakhir, dan tautan pendaftaran di `config/rencang.php`. Setelah tanggal berakhir lewat, banner dan hitung mundurnya tersembunyi otomatis. Format tanggal harus `YYYY-MM-DD HH:MM:SS`.

**Menambah halaman.**

1. Buat `resources/views/pages/nama-halaman.blade.php` yang diawali `@extends('layouts.app')`.
2. Daftarkan di `routes/web.php`:
   ```php
   Route::view('/nama-halaman', 'pages.nama-halaman', ['title' => 'Rencang - Nama'])->name('nama-halaman');
   ```
3. Tambahkan halaman itu ke daftar di `tests/Feature/PagesTest.php`, lalu jalankan `composer test`.

Gunakan `route('nama')` untuk tautan antarhalaman dan `asset('path')` untuk aset.

## Kontak

UKM Sosial Rencang, Universitas Multimedia Nusantara
Email: <rencang@umn.ac.id> · Instagram: [@rencangaye](https://www.instagram.com/rencangaye/)
