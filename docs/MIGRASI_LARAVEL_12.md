# Catatan Migrasi: Laravel 8 → Laravel 12

> **Tanggal:** 2 November 2026 · **Branch:** `upgrade-laravel-12` (dipotong dari `upgrade-php-8.2`, commit `8224205`)
> **Status:** kode selesai dan lulus uji lokal; **belum di-commit dan belum di-deploy**.
> Dokumen terkait: [AUDIT_DAN_ROADMAP.md](AUDIT_DAN_ROADMAP.md) (Fase M) · [DEPLOY.md](DEPLOY.md)

## 1. Ringkasan

| | Sebelum | Sesudah |
|---|---|---|
| Laravel | 8.83.29 (EOL) | **12.70.2** |
| Skeleton | Laravel 8 | `laravel/laravel` **v12.12.2** |
| PHP | `^7.3\|^8.0` | `^8.2` (diuji di 8.2.12) |
| Advisory keamanan (`composer audit`) | 54 → 6 (setelah Fase 1) | **0** |
| Test otomatis | 2 test contoh bawaan | **28 test, 46 assertion** |
| Route | 10 halaman + catch-all + `/api/user` | 10 halaman (URL tidak berubah) |

**Prinsip migrasi:** URL dan tampilan dipertahankan sama (*paritas*). Perubahan hanya yang disengaja: perbaikan yang murah dikerjakan sekalian, sesuai daftar Fase M di dokumen audit. Semuanya tercatat di §5.

## 2. Dependensi

### `composer.json`

| Bagian | Sebelum | Sesudah | Alasan |
|---|---|---|---|
| `name` | `laravel/laravel` | `rencang/website` | Identitas proyek |
| `require.php` | `^7.3\|^8.0` | `^8.2` | Syarat Laravel 12 |
| `minimum-stability` | `dev` (lalu `stable` di Fase 1) | `stable` | Cegah paket versi pengembangan |
| `config.platform.php` | – | `8.2.0` | Composer memilih paket yang pasti jalan di PHP 8.2, versi minimum server UMN. **Naikkan saat pindah ke Laravel 13** |
| `scripts` | bawaan Laravel 8 | + `setup`, `test`, `lint`; tanpa `dev`/npm/migrate | Proyek tidak memakai Node.js maupun database |

### Paket yang dibuang

| Paket | Alasan |
|---|---|
| `laravel/sanctum` | Hanya melayani `/api/user` yang tidak dipakai (audit RTE-01) |
| `fruitcake/laravel-cors` | Abandoned; tidak ada API |
| `swiftmailer/swiftmailer` | Abandoned; bawaan Laravel 8, tidak ada pengiriman email |
| `facade/ignition` | Halaman error Laravel 8; diganti bawaan Laravel 12 |
| `laravel/sail`, `fakerphp/faker` | Tidak dipakai (tanpa Docker, tanpa database) |
| Laravel Mix + `axios` (`package.json`) | Tidak dipakai; seri axios 0.x punya advisory |

### Yang tetap ada

- `laravel/tinker` (REPL untuk developer).
- `laravel/pint`, `phpunit/phpunit` 11, `nunomaduro/collision` 8, `mockery/mockery` (hanya dev).
- **`guzzlehttp/guzzle` 7.16.1 tetap terpasang** karena dibutuhkan langsung oleh `laravel/framework` 12. Ini berbeda dari rencana di audit (STK-03). Versinya sudah tanpa advisory.

## 3. Pemetaan file

### View (dipindah dengan `git mv`, riwayat Git tetap tersambung)

| Lama | Baru |
|---|---|
| `views/template/app.blade.php` | `views/layouts/app.blade.php` |
| `views/template/navbar.blade.php` | `views/partials/navbar.blade.php` |
| `views/template/footer.blade.php` | `views/partials/footer.blade.php` |
| `views/page/home.blade.php` | `views/pages/home.blade.php` |
| `views/page/WhatWeDo.blade.php` | `views/pages/what-we-do.blade.php` |
| `views/page/WhoWeAre.blade.php` | `views/pages/who-we-are.blade.php` |
| `views/page/event.blade.php` | `views/pages/event.blade.php` |
| `views/page/gedurasi.blade.php` | `views/pages/gedurasi.blade.php` |
| `views/page/sentera.blade.php` | `views/pages/sentera.blade.php` |
| `views/page/sch.blade.php` | `views/pages/sharing-caring-helping.blade.php` |
| `views/page/rencangCT.blade.php` | `views/pages/rencang-cepat-tanggap.blade.php` |
| `views/page/Keakraban.blade.php` | `views/pages/keakraban.blade.php` |
| `views/page/soon.blade.php` | `views/pages/coming-soon.blade.php` |

### File baru

| File | Fungsi |
|---|---|
| `config/rencang.php` | Nama, email, dan banner event (tanggal akhir, tautan pendaftaran) |
| `app/Support/EventBanner.php` | Menentukan apakah banner masih tampil |
| `resources/views/errors/404.blade.php` | Halaman "tidak ditemukan" dengan navbar dan footer |
| `resources/views/errors/{500,503}.blade.php` + `errors/rencang.blade.php` | Halaman error mandiri (tidak bergantung pada layout utama) |
| `public/css/errors/errors.css` | Gaya halaman error (kontras warna lolos AA) |
| `tests/Feature/PagesTest.php`, `tests/Unit/EventBannerTest.php` | Test otomatis |
| `README.md` | Ditulis ulang khusus proyek ini |

### File yang dihapus

- **Kode Laravel 8:** 9 controller halaman, `app/Http/Kernel.php`, 8 middleware, 4 service provider (Auth, Broadcast, Event, Route), `app/Console/Kernel.php`, `app/Exceptions/Handler.php`. Fungsinya kini ada di `bootstrap/app.php`. `Controller.php` dan `AppServiceProvider.php` diganti versi skeleton Laravel 12.
- **Fitur tak terpakai:** `routes/api.php`, `routes/channels.php`, model `User`, 4 migrasi, factory, seeder, `config/{cors,sanctum,broadcasting,hashing,view}.php`, `resources/lang/en`.
- **File mati:** `views/welcome.blade.php`, `views/page/template.blade.php` (merujuk CSS yang tidak ada), `public/js/navbar/navbar.js`, `public/web.config` (IIS), `server.php`, `webpack.mix.js`, `package.json`, `.styleci.yml`, `resources/js`, `resources/css`.
- `config/*` lain dan `bootstrap/app.php` diganti versi skeleton Laravel 12.

**Tidak berubah:** seluruh `public/css` (kecuali `home3.css`, lihat §5), `public/fonts`, `public/images`, dan `public/js/sweetalert`. Nama dan lokasi aset sengaja tidak diubah supaya tampilan identik; penggantian nama aset dijadwalkan di Fase K bersama optimasi gambar.

## 4. Route

URL **tidak ada yang berubah**. Nama route diganti agar sama dengan slug URL.

| URL | Nama lama | Nama baru |
|---|---|---|
| `/` | `home` | `home` |
| `/what-we-do` | `wwd` | `what-we-do` |
| `/who-we-are` | `wwa` | `who-we-are` |
| `/event` | `event` | `event` |
| `/gedurasi` | `gedurasi` (terdaftar 2×) | `gedurasi` |
| `/sentera` | `sentera` | `sentera` |
| `/sharing-caring-helping` | `sch` | `sharing-caring-helping` |
| `/rencang-cepat-tanggap` | `rct` | `rencang-cepat-tanggap` |
| `/keakraban` | `keakraban` | `keakraban` |
| `/soon` | `soon` | `coming-soon` |

**Dihapus:** catch-all `Route::any('{query}')` (semua URL salah dialihkan ke beranda) dan `/api/user`. **Tidak ditambahkan:** endpoint health `/up` bawaan Laravel 12, karena tidak ada sistem pemantauan yang memakainya.

Controller diganti `Route::view()`, karena semua halaman hanya menampilkan view.

## 5. Perubahan yang terlihat pengguna

| Perubahan | Sebelum | Sesudah | Rujukan audit |
|---|---|---|---|
| URL salah | Dialihkan diam-diam ke beranda (302) | Halaman **404** bergaya Rencang dengan tombol ke Beranda dan Kegiatan | RTE-02, SEC-10 |
| Banner CARITAS di beranda | Selalu tampil, countdown `00` sejak Feb 2022 | **Otomatis tersembunyi** setelah tanggal di `config/rencang.php` | SEO-03 |
| Hak cipta footer | "@ 2020 …" | "© {tahun berjalan} …" | SEO-03 |
| Menu Home | Tidak pernah aktif; skrip melempar error `Syntax error, unrecognized expression: #` di setiap kunjungan beranda | Ditandai aktif, tanpa error | RTE-08 |
| Kursor berkedip "Rencang \|" (Who We Are) | **Tidak pernah berjalan**: skrip memanggil `$` di baris 237, sedangkan jQuery baru dimuat di baris 323 | Berjalan | KOD-05 |
| Tombol "Daftar" | `<a><button>` bersarang (HTML tidak valid) | `<a class="btn-cta">` dengan gaya sama; animasi hover kini halus (CSS `transition: duration .2s` yang tidak valid diperbaiki) | KOD-01 |
| Logo navbar versi ponsel | Menuju `#` | Menuju beranda | – |
| Link "Articles" di footer | `#` | `/soon`, sama seperti navbar | – |
| Gambar dekoratif SCH | Path relatif `images/SCH/…` | `asset()`, aman bila situs tidak di root domain | KOD-01 |
| Footer di halaman Keakraban | Terselip di dalam `<div class="content">` yang tidak ditutup | Di luar, seperti halaman lain (tanpa perbedaan visual, karena `.content` tidak punya gaya di halaman ini) | KOD-01 |
| `<html lang>` | `en` | `id` | KOD-07 |
| Favicon | `rel="shorcut icon"` (salah ketik) | `rel="icon"` | KOD-01 |
| Library | jQuery UI 1.12.1 (tak terpakai, ber-CVE); Typed.js juga dimuat di Who We Are | Keduanya tidak dimuat lagi. Typed.js tetap di beranda | STK-04 |
| Zona waktu aplikasi | UTC | Asia/Jakarta | – |
| Cookie sesi | `laravel_session`, tanpa flag `Secure` | `rencang-session`; flag `Secure` aktif di produksi (`SESSION_SECURE_COOKIE=true`) | SEC-03 (sebagian) |

### Perbaikan HTML lain

- `home`: satu `</div>` berlebih dibuang.
- `keakraban`: dua `<p>` tidak ditutup, `</P>` huruf besar, class tidak valid `lg-6 sm-4`, dan `<div class="content">` yang tidak ditutup. HTML yang dikomentari (gambar lama) juga dibuang.
- `navbar`: atribut tidak valid `type="button"` pada `<div>` dibuang; `aria-labelledby` kini menunjuk id yang ada; `alt` ditambahkan pada dua logo.
- `sharing-caring-helping`: blok HTML yang dikomentari dibuang.

## 6. Konfigurasi `.env`

`.env.example` kini berisi **nilai aman produksi** (`APP_ENV=production`, `APP_DEBUG=false`). Laravel 12 juga **mengganti beberapa nama variabel**, jadi `.env` lama di server harus diperbarui (lihat [DEPLOY.md](DEPLOY.md) §4):

| Variabel | Laravel 8 | Laravel 12 | Catatan |
|---|---|---|---|
| Cache | `CACHE_DRIVER` | **`CACHE_STORE`** | Bila tidak diisi, Laravel 12 memakai `database`. Wajib `file` |
| Sesi | `SESSION_DRIVER=file` | sama | Bila tidak diisi, Laravel 12 memakai `database`. Wajib `file` |
| Antrian | `QUEUE_CONNECTION=sync` | sama | Bila tidak diisi, Laravel 12 memakai `database`. Wajib `sync` |
| Filesystem | `FILESYSTEM_DRIVER` | `FILESYSTEM_DISK` | – |
| Cookie aman | – | `SESSION_SECURE_COOKIE=true` | Baru |
| Log | `LOG_CHANNEL=stack` | + `LOG_STACK=daily`, `LOG_LEVEL=warning` | Rotasi harian |
| Bahasa | – | `APP_LOCALE=id` | – |

## 7. Bukti verifikasi

Semua dijalankan di lokal: Windows, PHP 8.2.12 (XAMPP), Composer 2.9.2.

| Pemeriksaan | Hasil |
|---|---|
| `php artisan test` | **28 lulus, 46 assertion, 0 warning**. Mencakup: 10 halaman membalas 200 dengan `<title>` yang benar; **semua aset lokal yang dirujuk tiap halaman benar-benar ada**; URL salah → 404; `/api/user` dan `/up` → 404; banner tampil sebelum tenggat dan hilang sesudahnya; tahun footer; logika `EventBanner` (5 kasus) |
| `vendor/bin/pint --test` | Lulus |
| `composer audit` | Tidak ada advisory |
| `composer validate` | Valid |
| `php artisan route:list` | Tepat 10 route |
| Uji HTTP langsung | `/halaman-salah`, `/.env`, `/api/user`, `/up`, `/css/home/home.css` → **404**; `/favicon.ico`, `/robots.txt` → 200 |
| Diff HTML 10 halaman lama vs baru | Semua perbedaan sesuai §5. Halaman yang isinya tidak diubah (gedurasi, sentera, RCT, event, what-we-do, soon) hanya berbeda di bagian layout |
| Browser (lebar ±800 px) | Beranda (Typed.js jalan, menu Home aktif, banner tersembunyi), Who We Are (kursor berkedip, jQuery UI tidak termuat), Event (popup Rencang Night muncul), Keakraban (footer di luar `.content`), halaman 404 tampil |
| **Perbandingan visual piksel per piksel** (versi lama dari branch `upgrade-php-8.2` vs versi baru, screenshot satu halaman penuh lewat Edge headless) | Lihat §7.1 |

### 7.1 Perbandingan visual lama vs baru

10 halaman difoto penuh di tiga lebar, lalu dibandingkan per piksel (ambang perbedaan warna > 30).

| Lebar | 9 halaman selain beranda | Beranda |
|---|---|---|
| **1280 px** (desktop) | Tinggi halaman identik. Satu-satunya perbedaan: pita ±15 px di baris hak cipta footer (0,04–0,15 % piksel) | Lebih pendek 901 px karena banner CARITAS hilang. Sisanya identik, kecuali menu Home kini tebal (aktif) |
| **768 px** (tablet) | Sama: hanya baris hak cipta footer (0,06–0,25 %) | Lebih pendek 1.249 px, karena banner |
| **375 px** (ponsel) | Sama: hanya baris hak cipta footer (0,13–0,47 %) | Lebih pendek 941 px, karena banner |

Satu efek samping di beranda: ornamen gelombang biru dekoratif di sisi kiri kini muncul di samping logo husky, karena posisinya dihitung dalam persen (`top: 30%`) dari tinggi seksi yang menjadi lebih pendek setelah banner hilang. Ini bukan kerusakan, tapi perlu diketahui bila nanti banner baru dipasang: posisi ornamen akan kembali seperti semula.

Selisih teks animasi Typed.js ("Kawan/Teman/Sahabat") di beranda berasal dari momen pengambilan gambar, bukan dari perubahan kode.

### Yang belum terverifikasi

- **Belum diuji di server UMN (Apache).** Pengujian memakai server bawaan PHP. Perilaku `.htaccess`, document root, HTTPS, dan header server baru bisa dicek setelah deploy.
- **Belum diuji di PHP 8.3 atau lebih baru.** Laravel 12 mendukungnya, dan `platform.php` 8.2.0 memastikan paketnya juga jalan di 8.2.

## 8. Yang sengaja belum dikerjakan

Sesuai roadmap, item berikut dipindah ke fase berikutnya karena mengubah tampilan atau butuh keputusan:

- Security header dan CSP, halaman publik tanpa sesi (Fase H)
- Self-host library atau SRI, `trustHosts` (Fase H)
- `.htaccess` penolak di root proyek (SEC-06). **Tidak dipasang** karena belum bisa diuji di Apache, dan konfigurasi rewrite yang salah bisa membuat seluruh situs error. Cara cek dan potongan konfigurasinya ada di [DEPLOY.md](DEPLOY.md) §7
- Optimasi gambar dan penggantian nama aset, Bootstrap 5, inline style/JS, aksesibilitas, SEO, konten baru (Fase K)
- CI, GitHub Organization, dokumen serah terima (Fase O)

## 9. Rollback

Branch **`upgrade-php-8.2`** berisi versi Laravel 8.83.29 yang sudah jalan di PHP 8.2 (6 advisory tersisa, tidak terpapar; lihat audit §3). Bila versi Laravel 12 bermasalah di server, unggah ulang paket dari branch itu dengan langkah [DEPLOY.md](DEPLOY.md) yang sama.
