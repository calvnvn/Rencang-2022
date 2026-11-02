# Panduan Deploy ke Server UMN

> Untuk versi Laravel 12 (branch `upgrade-laravel-12`). Server dikelola **IT Infrastructure UMN**; akses ke folder situs lewat **FTP**.
> Dokumen terkait: [MIGRASI_LARAVEL_12.md](MIGRASI_LARAVEL_12.md) · [AUDIT_DAN_ROADMAP.md](AUDIT_DAN_ROADMAP.md) §11

> ⚠️ Bagian yang ditandai **[KONFIRMASI IT]** belum diketahui pasti. Isi dulu jawabannya sebelum deploy, dan perbarui dokumen ini setelahnya supaya generasi berikutnya tidak menebak lagi.

## 1. Yang perlu diketahui sebelum mulai

| Hal | Nilai | Sumber |
|---|---|---|
| Domain | `rencang.umn.ac.id` | – |
| Host FTP | `alchemist.umn.ac.id` pada 2018 **[KONFIRMASI IT]** | Tiket Helpdesk UMN #2711 (inbox `rencang@umn.ac.id`) |
| Username / kata sandi FTP | **Jangan ditulis di dokumen, email, atau chat.** Simpan di password manager organisasi | Minta reset ke IT; kredensial lama tersimpan sebagai teks biasa (audit SEC-07) |
| Versi PHP server | ≥ 8.2 **[KONFIRMASI IT: versi persis]** | Email IT 27 Okt 2026 |
| Document root | Idealnya folder `public/` **[KONFIRMASI IT]** | – |
| Composer / SSH di server | Kemungkinan tidak ada **[KONFIRMASI IT]** | – |
| Database | Tidak dipakai | – |

## 2. Susunan file di server

Pilih satu sesuai jawaban IT.

**A. Document root menunjuk ke folder `public/` (ideal).** Unggah seluruh proyek ke satu folder, misalnya `rencang/`. Server menampilkan `rencang/public`, sehingga `.env`, `vendor/`, dan `storage/` tidak bisa diakses dari internet.

**B. Document root adalah folder tetap seperti `public_html/` dan tidak bisa diubah.**
1. Unggah proyek **di luar** `public_html`, misalnya `~/rencang-app/`.
2. Salin **isi** folder `public/` ke `public_html/`.
3. Di `public_html/index.php`, ganti tiga path `__DIR__.'/../'` menjadi path ke folder aplikasi, misalnya `__DIR__.'/../rencang-app/'`:
   ```php
   if (file_exists($maintenance = __DIR__.'/../rencang-app/storage/framework/maintenance.php')) {
   require __DIR__.'/../rencang-app/vendor/autoload.php';
   $app = require_once __DIR__.'/../rencang-app/bootstrap/app.php';
   ```
4. Setiap mengubah aset (`css`, `images`, …), salin juga ke `public_html/`.

**Jangan pernah** meletakkan seluruh proyek langsung di dalam document root tanpa salah satu cara di atas, karena `.env` bisa diunduh siapa pun.

## 3. Membuat paket deploy di komputer sendiri

Server mungkin tidak punya Composer, jadi folder `vendor/` dibangun di lokal lalu ikut diunggah.

```bash
cd D:\College\RENCANG
```
```bash
git clone --branch upgrade-laravel-12 rencang-website rencang-build
```
```bash
cd rencang-build
```
```bash
composer install --no-dev --optimize-autoloader
```

`composer.json` sudah mengunci `platform.php` = `8.2.0`, sehingga paket yang terpasang pasti jalan di PHP 8.2 ke atas. Tidak perlu diubah selama masih Laravel 12.

Yang **diunggah**: `app/`, `bootstrap/`, `config/`, `public/`, `resources/`, `routes/`, `storage/` (hanya struktur foldernya), `vendor/`, `artisan`, `composer.json`, `composer.lock`.

Yang **tidak diunggah**: `.git/`, `tests/`, `docs/`, `.env` lokal, `phpunit.xml`, `.editorconfig`.

## 4. File `.env` di server

Laravel 12 memakai beberapa nama variabel yang berbeda dari Laravel 8 (lihat [MIGRASI_LARAVEL_12.md](MIGRASI_LARAVEL_12.md) §6). **Jangan biarkan `.env` lama apa adanya**: tanpa `CACHE_STORE`, `SESSION_DRIVER`, dan `QUEUE_CONNECTION`, Laravel 12 otomatis mencari database yang tidak ada.

1. Unduh dulu `.env` yang ada di server sebagai cadangan. Simpan di tempat aman, **jangan di repo**.
2. Buat `.env` baru dari `.env.example`. Nilainya sudah untuk produksi:
   ```dotenv
   APP_NAME=Rencang
   APP_ENV=production
   APP_KEY=base64:...        # lihat di bawah
   APP_DEBUG=false
   APP_URL=https://rencang.umn.ac.id
   APP_LOCALE=id
   LOG_CHANNEL=stack
   LOG_STACK=daily
   LOG_LEVEL=warning
   DB_CONNECTION=sqlite
   SESSION_DRIVER=file
   SESSION_SECURE_COOKIE=true
   QUEUE_CONNECTION=sync
   CACHE_STORE=file
   MAIL_MAILER=log
   ```
3. **`APP_KEY`**: boleh memakai nilai dari `.env` lama, atau buat baru dengan `php artisan key:generate --show` di lokal lalu tempel. Karena situs tidak menyimpan data terenkripsi, mengganti kunci hanya membuat sesi pengunjung lama tidak berlaku.
4. Bila situs ternyata **belum memakai HTTPS**, sementara set `SESSION_SECURE_COOKIE=false` dan laporkan ke IT.

## 5. Mengunggah

1. **Cadangkan dulu.** Unduh seluruh folder situs yang sekarang ada di server ke komputer, misalnya `backup-2026-11-xx/`. Ini bahan rollback dan pembanding.
2. Unggah file dari langkah 3 lewat klien FTP (misalnya FileZilla), menimpa versi lama.
3. **Hapus file Laravel 8 yang tidak ada lagi di versi baru**, terutama:
   - `app/Http/Kernel.php`, `app/Http/Middleware/`, `app/Providers/{Auth,Broadcast,Event,Route}ServiceProvider.php`, `app/Console/Kernel.php`, `app/Exceptions/`
   - `routes/api.php`, `routes/channels.php`, `config/{cors,sanctum,broadcasting,hashing,view}.php`
   - `resources/views/page/` dan `resources/views/template/` (sudah diganti `pages/`, `partials/`, `layouts/`)
   - `server.php`, `webpack.mix.js`, `package.json`, `public/web.config`, `public/js/navbar/`
   
   Paling aman: hapus seluruh folder `app/`, `bootstrap/`, `config/`, `resources/`, `routes/`, `vendor/` di server **sebelum** mengunggah yang baru.
4. **Kosongkan cache Laravel 8** di server, karena cache lama akan membuat Laravel 12 gagal start:
   - semua file `.php` di `bootstrap/cache/` (biarkan `.gitignore`)
   - isi `storage/framework/views/`, `storage/framework/cache/data/`, dan `storage/framework/sessions/`
5. Pastikan **`storage/` dan `bootstrap/cache/` bisa ditulis** server (izin 775, atau sesuai arahan IT).
6. Bila ada akses terminal: `php artisan optimize`. Bila tidak ada, lewati. Situs tetap jalan tanpa cache.

## 6. Smoke test setelah unggah

| Cek | Harapan |
|---|---|
| Buka 10 halaman: `/`, `/what-we-do`, `/who-we-are`, `/event`, `/gedurasi`, `/sentera`, `/sharing-caring-helping`, `/rencang-cepat-tanggap`, `/keakraban`, `/soon` | Tampil normal, gambar dan CSS termuat |
| `https://rencang.umn.ac.id/halaman-salah` | Halaman 404 Rencang |
| **`https://rencang.umn.ac.id/.env`** | **404 atau 403.** Bila isi `.env` terlihat, **segera hapus `.env` dari server** dan hubungi IT (lihat §7) |
| `https://rencang.umn.ac.id/composer.json` | 404 atau 403 |
| Akses lewat `http://` | Dialihkan ke `https://` (urusan IT bila tidak) |
| Menu, dropdown "Who We Are?", tombol "View More" di halaman Event | Berfungsi |
| `storage/logs/laravel-*.log` | Tidak ada error baru |
| Tampilan di ponsel dan desktop | Sama seperti sebelum migrasi |

Catat tanggal, commit, dan siapa yang deploy di bagian riwayat di bawah.

## 7. Bila `/.env` atau `composer.json` bisa dibuka

Artinya document root menunjuk ke folder proyek, bukan `public/`. Solusi utama: minta IT mengarahkan document root ke `public/`, atau pakai susunan B di §2.

Sebagai pengaman sementara, `.htaccess` berikut bisa diletakkan di **root proyek** (sejajar `artisan`). Konfigurasi ini **belum pernah diuji di server UMN**: uji satu halaman dulu, dan hapus bila situs malah error 500.

```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    # Tolak file dan folder yang tidak boleh diakses publik
    RewriteRule ^(\.env|\.git|composer\.(json|lock)|artisan|app/|bootstrap/|config/|database/|resources/|routes/|storage/|tests/|vendor/) - [F,L]
    # Teruskan semua permintaan lain ke folder public/
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
```

## 8. Rollback

1. Unggah kembali cadangan dari §5 langkah 1, termasuk `.env` lama.
2. Kosongkan cache seperti §5 langkah 4.
3. Alternatif: buat paket dari branch **`upgrade-php-8.2`** (Laravel 8.83.29, sudah kompatibel PHP 8.2) dengan langkah §3, ganti `--branch upgrade-laravel-12` menjadi `--branch upgrade-php-8.2`. Versi ini memakai `.env` gaya Laravel 8.

## 9. Setelah deploy berhasil

- Balas email IT Infrastructure: situs sudah disesuaikan, versi Laravel 12.70.2, dan sudah diuji di PHP ≥ 8.2. Minta akses publik dibuka kembali.
- Tag rilis di Git, misalnya `git tag v2026.11.0` lalu `git push --tags`.
- Perbarui tabel §1 dengan jawaban IT, dan isi riwayat di bawah.

## Riwayat deploy

| Tanggal | Versi / commit | Oleh | Catatan |
|---|---|---|---|
| | | | |
