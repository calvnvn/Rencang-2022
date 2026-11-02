# Audit Menyeluruh & Roadmap Perbaikan: Website Rencang

> **Tanggal:** 2 November 2026 · **Basis kode:** branch `upgrade-php-8.2` (Laravel 8.83.29, PHP 8.2.12 lokal)
> **Tujuan:** daftar lengkap hal yang kurang profesional, rawan, atau sulit dirawat, beserta *kapan* sebaiknya diperbaiki: saat migrasi ke Laravel 12, sesudahnya, atau jangka panjang.
> Dokumen terkait: [ARCHITECTURE.md](ARCHITECTURE.md) · [PRD.md](PRD.md) · [DESIGN_SYSTEM.md](DESIGN_SYSTEM.md)

---

## 0. Ringkasan untuk pengurus

Website ini kecil dan sederhana, dan itu kabar baik: **tidak ada celah yang bisa langsung dieksploitasi pada kode saat ini**. Masalah utamanya ada di tiga hal:

1. **Fondasi usang.** Laravel 8 sudah tidak didukung. Bahkan Laravel 12, target migrasi kita, hanya mendapat patch keamanan sampai **24 Februari 2027**.
2. **Kebersihan & konfigurasi.** Ada endpoint API yang tidak dipakai tapi terbuka, tidak ada security header, cookie dipasang di setiap halaman, URL salah dialihkan diam-diam ke beranda, dan library frontend yang tidak dipakai ikut dimuat.
3. **Keberlanjutan organisasi.** Repo, akses server, dan pengetahuan teknis melekat pada **orang**, bukan pada **UKM**. Setiap pergantian generasi, akses hilang. Ini yang membuat situs sempat terancam di-*suspend*.

**10 prioritas teratas**

| # | Masalah | Keparahan | Kapan |
|---|---|---|---|
| 1 | Laravel 8 EOL, 5 advisory termasuk 1 *critical* (tidak terpapar) | Tinggi | Migrasi |
| 2 | Laravel 12 hanya aman sampai 24 Feb 2027 → perlu rencana Laravel 13 (PHP 8.3) | Tinggi | Jangka panjang |
| 3 | Kredensial FTP 2018 tersimpan sebagai teks biasa di inbox bersama | Tinggi | **Segera** |
| 4 | Repo dan akses bergantung pada akun pribadi alumni | Tinggi | Jangka panjang |
| 5 | Risiko `.env` terbuka bila document root server bukan `public/` (belum diverifikasi) | Tinggi (bila terjadi) | Saat deploy |
| 6 | Endpoint `/api/user` terbuka dengan CORS `*`, padahal tidak dipakai | Sedang | Migrasi |
| 7 | Tidak ada security header; cookie tanpa flag `Secure` | Sedang | Setelah migrasi |
| 8 | *Catch-all* redirect: tidak ada halaman 404 | Sedang | Migrasi |
| 9 | 29 gambar > 1 MB (71,4 MB); total aset ±93 MB | Tinggi (UX) | Setelah migrasi |
| 10 | HTML tidak valid dan konten basi (CARITAS 2022, © 2020, Gen 13/14) | Sedang | Migrasi + setelahnya |

Label waktu yang dipakai di seluruh dokumen:
- **[M]** dikerjakan **saat migrasi** Laravel 12, karena lebih murah dikerjakan sekalian;
- **[P]** **pasca-migrasi** (hardening, konten, UX);
- **[J]** **jangka panjang** (proses dan organisasi);
- **[S]** **segera**, tidak bergantung pada kode.

---

## 1. Metode

| Sumber bukti | Yang dilakukan |
|---|---|
| Kode | Membaca semua route, controller, view, CSS, config, middleware, `composer.json/.lock`, `package.json` |
| Uji runtime | Menjalankan app di PHP 8.2.12 lokal, menembak semua route, endpoint API, path sensitif (`/.env`), dan membaca header respons |
| Dependensi | `composer audit` (Composer 2.9.2): dari 54 advisory di 13 paket, setelah update tinggal 6 di 2 paket |
| Metrik | Menghitung tag tidak seimbang, inline style/JS, atribut `alt`, ukuran aset |
| Riset | OWASP Top 10:2025, tabel dukungan Laravel, Core Web Vitals, studi aksesibilitas web perguruan tinggi Indonesia, literatur sistem informasi UKM, UU PDP (lihat §11) |

Batasan: server produksi belum bisa diakses (situs ditutup IT), jadi temuan terkait server, seperti HTTPS, document root, dan header dari Apache, masih **belum terverifikasi**.

---

## 2. Standar acuan

Supaya perbaikan tidak berdasarkan selera, berikut patokan yang dipakai.

### 2.1 Fitur umum website UKM (literatur)

Sejumlah penelitian sistem informasi UKM di Indonesia, yang saya baca dari abstrak dan cuplikannya (lihat §11), konsisten memuat fitur inti berikut:

| Fitur umum | Ada di Rencang? | Catatan |
|---|---|---|
| Profil organisasi (sejarah, visi-misi) | ✅ | Kuat: Who We Are |
| Informasi kegiatan / jadwal | ⚠️ | Hanya arsip Gen 13–14 (2021) |
| Galeri dokumentasi | ✅ | Per program, foto belum dioptimasi |
| Pendaftaran anggota baru (oprec) | ⚠️ | Hanya tautan bit.ly di banner basi |
| Berita / artikel | ❌ | Menu "Articles" → Coming Soon |
| Struktur kepengurusan | ❌ | Menu "Our Family" → Coming Soon |
| Kontak / kerja sama | ⚠️ | Hanya ikon sosmed + alamat |
| Panel admin untuk mengelola konten | ❌ | Semua konten di-*hardcode* |

Inbox `rencang@umn.ac.id` menunjukkan banyak permintaan **media partner** dan kerja sama yang masuk lewat email. Halaman "Kerja Sama / Media Partner" yang berisi syarat dan kontak akan mengurangi balas-membalas email.

### 2.2 Keamanan: OWASP Top 10:2025

Kategori yang paling relevan untuk situs ini: **A02 Security Misconfiguration**, **A03 Software Supply Chain Failures** (kategori baru), **A09 Logging & Alerting Failures**, dan **A10 Mishandling of Exceptional Conditions** (kategori baru). A01 Broken Access Control kurang relevan karena situs tidak punya login.

### 2.3 Aksesibilitas: WCAG 2.2 level AA

Studi tentang website perguruan tinggi di Indonesia (2020; Sistemasi 2026 dengan WCAG 2.2) menemukan bahwa sebagian besar situs **belum memenuhi** standar WCAG. Target realistis untuk Rencang: AA pada komponen baru, perbaikan bertahap pada yang lama.

### 2.4 Kinerja: Core Web Vitals

Ambang "baik" pada persentil ke-75 kunjungan: **LCP ≤ 2,5 s**, **INP ≤ 200 ms**, **CLS ≤ 0,1**.

### 2.5 Privasi: UU No. 27/2022 (PDP)

UU PDP sudah berlaku penuh (masa penyesuaian 2 tahun sejak Oktober 2022). Pemrosesan data harus punya dasar sah (mis. persetujuan) dan tujuan yang jelas, serta data dijaga keamanannya. Relevan untuk **form oprec** dan **foto dokumentasi**.

### 2.6 Siklus hidup framework

| Versi | PHP | Security fix sampai |
|---|---|---|
| Laravel 8 (sekarang) | 7.3–8.1 (resmi) | Sudah berakhir |
| **Laravel 12** (target migrasi) | 8.2–8.5 | **24 Februari 2027** |
| Laravel 13 | 8.3–8.5 | ±Q1 2028 |

---

## 3. Stack & dependensi

| ID | Temuan | Bukti | Keparahan | Rekomendasi | Kapan |
|---|---|---|---|---|---|
| STK-01 | Laravel 8 EOL; `composer audit` sisa 5 advisory Laravel (1 critical, 1 high, 2 medium, 1 low) + 1 Flysystem | `composer audit` | Tinggi | Migrasi ke Laravel 12 terbaru (≥ 12.70) | [M] |
| STK-02 | Laravel 12 hanya aman sampai 24 Feb 2027; Laravel 13 butuh PHP 8.3, sedangkan PHP lokal (XAMPP) 8.2.12 dan versi server belum diketahui | Tabel dukungan Laravel | Tinggi | Tanyakan versi PHP server. Bila ≥ 8.3, rencanakan Laravel 13 sebelum Feb 2027, dan pasang PHP 8.3 di lokal | [J] |
| STK-03 | Paket tak terpakai: `laravel/sanctum`, `guzzlehttp/guzzle`, `fruitcake/laravel-cors` (abandoned), `swiftmailer` (abandoned, bawaan L8), `laravel/sail` | `composer.json`, audit | Sedang | Jangan bawa ke skeleton baru | [M] |
| STK-04 | Library frontend usang: Bootstrap 4.5.0 (seri 4 EOL), **jQuery UI 1.12.1 tidak dipakai** tapi kena CVE-2021-41182/41183/41184 & CVE-2022-31160, Popper 1.x | `template/app.blade.php:13–41` | Sedang | Hapus jQuery UI **[M]**. Migrasi ke Bootstrap 5 **[P]** (perlu ubah class & atribut `data-bs-*`) | [M]/[P] |
| STK-05 | `package.json` memuat Laravel Mix & `axios ^0.21`, padahal tidak dipakai. Seri axios 0.x punya advisory yang baru diperbaiki di 1.x | `package.json` | Rendah (tidak terpasang) | Buang. Bila nanti butuh build tool, pakai Vite bawaan Laravel 12 | [M] |
| STK-06 | `"php": "^7.3\|^8.0"` dan dulu `"minimum-stability": "dev"` | `composer.json:8, 60` | Rendah | Skeleton Laravel 12 sudah memakai `^8.2` dan `stable` | [M] |

> Catatan: CVE-2024-6531 (Bootstrap 4 carousel) sempat terbit tapi kemudian **dicabut (rescinded)**. Jadi alasan pindah ke Bootstrap 5 adalah EOL dan kemudahan perawatan, bukan CVE itu.

---

## 4. API & routing

| ID | Temuan | Bukti | Keparahan | Rekomendasi | Kapan |
|---|---|---|---|---|---|
| RTE-01 | **Endpoint `/api/user` terbuka** (membalas 401 JSON), memakai Sanctum, dengan CORS `allowed_origins: ['*']` untuk `api/*`. Tidak ada fitur yang memakainya | `routes/api.php:17`, `config/cors.php`, uji lokal | Sedang | Jangan bawa `routes/api.php`. Laravel 11+ tidak lagi memuat route API secara default (harus `install:api`) | [M] |
| RTE-02 | **Catch-all** `Route::any('{query}')->where('query','.*')` mengalihkan *semua* URL salah (semua method, termasuk POST) ke `/`. Akibatnya soft-404 (buruk untuk SEO), aset hilang tidak terdeteksi (`css/home/home.css` → 302), dan error tersembunyi (OWASP A10) | `routes/web.php:39–44` | Sedang | Hapus. Buat halaman `errors/404.blade.php` yang ramah (tautan ke menu utama). Bila ada URL lama yang perlu dipertahankan, pakai `Route::permanentRedirect()` per URL | [M] |
| RTE-03 | Route `/gedurasi` didefinisikan dua kali | `routes/web.php:26, 30` | Rendah | Hapus duplikat | [M] |
| RTE-04 | 9 controller satu baris yang hanya me-*return* view | `app/Http/Controllers/*` | Rendah | `Route::view()` atau satu `PageController` yang membaca data konten | [M] |
| RTE-05 | Pola URL tidak konsisten (`/sharing-caring-helping`, `/rencang-cepat-tanggap`, `/sentera`) dan tidak punya hierarki periode, padahal program berulang tiap generasi | `routes/web.php` | Rendah | Saat migrasi **pertahankan URL lama** (paritas). Pasca-migrasi, pertimbangkan `/program/{slug}` dan `/periode/{gen}` dengan redirect 301 dari URL lama | [M]/[P] |
| RTE-06 | Nama route singkatan (`wwd`, `wwa`, `rct`) sulit dipahami developer baru | `routes/web.php` | Rendah | Nama deskriptif (`about`, `activities`, `programs.rct`) | [M] |
| RTE-07 | Navigasi lewat JavaScript (`window.location`, `onclick`) alih-alih `<a href>`. Tidak bisa dibuka di tab baru, tidak terbaca crawler, tidak bisa dipakai lewat keyboard | `event.blade.php:172`, `WhatWeDo.blade.php:142`, `home.blade.php:109`, `footer.blade.php:45–60` | Sedang | Ganti dengan tautan biasa | [P] |
| RTE-08 | Penanda menu aktif ditebak dari `pathname` di JS; Home tidak pernah aktif | `template/app.blade.php:73–75` | Rendah | Di Blade: `request()->routeIs('home')` | [P] |

---

## 5. Keamanan (dipetakan ke OWASP Top 10:2025)

| ID | OWASP | Temuan | Bukti | Keparahan | Rekomendasi | Kapan |
|---|---|---|---|---|---|---|
| SEC-01 | A02 | `.env.example` default `APP_DEBUG=true`, `APP_ENV=local`. Bila ikut ke produksi, stack trace terbuka, dan advisory "XSS in Debug Page" jadi relevan | `.env.example` | Tinggi | `.env.example` versi aman produksi + checklist deploy (§10) | [M] |
| SEC-02 | A02 | **Tidak ada security header**: CSP, `X-Content-Type-Options`, `Referrer-Policy`, `Permissions-Policy`, `frame-ancestors`/`X-Frame-Options`, HSTS | Header respons lokal | Sedang | Middleware header di Laravel 12 (atau `.htaccess`). Mulai CSP sebagai **Report-Only**, karena masih banyak inline script/style (KOD-02) | [P] |
| SEC-03 | A02 | Setiap halaman memasang **2 cookie** (`XSRF-TOKEN`, `laravel_session`) tanpa flag `Secure` (`SESSION_SECURE_COOKIE` kosong), dan respons `Cache-Control: no-cache, private` sehingga halaman tidak bisa di-cache | Header respons lokal, `config/session.php` | Sedang | Minimal: `SESSION_SECURE_COOKIE=true` di produksi. Lebih baik: karena tidak ada form atau login, halaman publik dilayani **tanpa sesi** sehingga bebas cookie dan bisa di-cache | [P] |
| SEC-04 | A02 | Header `X-Powered-By: PHP/8.2.12` membocorkan versi (terlihat di lokal; server belum dicek) | Header respons lokal | Rendah | Minta IT set `expose_php=Off` bila muncul juga di server | [P] |
| SEC-05 | A03 | Script dan style dari **4 domain CDN** tanpa Subresource Integrity, termasuk domain lama `maxcdn.bootstrapcdn.com` | `template/app.blade.php`, `home.blade.php:5`, `WhoWeAre.blade.php:5` | Sedang | Host lokal di `public/vendor/` dengan versi terkunci, atau CDN + atribut `integrity` | [P] |
| SEC-06 | A02 | **Bila document root server = folder proyek** (bukan `public/`), maka `.env`, `composer.json`, `storage/logs` bisa diunduh publik. Belum terverifikasi | Pola umum deploy Laravel di shared hosting | Tinggi (bila terjadi) | Setelah deploy wajib cek `https://rencang.umn.ac.id/.env` → harus **404/403**. Tambahkan `.htaccess` penolak di root proyek sebagai lapis kedua | [M] (saat deploy) |
| SEC-07 | — | **Kredensial FTP 2018 tersimpan sebagai teks biasa** di inbox bersama `rencang@umn.ac.id` (tiket Helpdesk #2711), yang aksesnya berpindah tangan tiap generasi | Inbox Rencang | Tinggi | Minta IT **mengganti** kredensial. Simpan di password manager organisasi, jangan di email atau chat | [S] |
| SEC-08 | A02 | `TrustHosts` dinonaktifkan, sehingga header `Host` tidak divalidasi | `app/Http/Kernel.php:17` | Rendah | Di Laravel 12: `trustHosts(at: ['rencang.umn.ac.id'])` | [P] |
| SEC-09 | — | Tautan `target="_blank"` tanpa `rel="noopener"`, dan tautan **bit.ly** untuk form (rawan rusak dan sulit diverifikasi pengguna) | `home.blade.php:66` | Rendah | Tambah `rel="noopener noreferrer"`. Pakai URL form langsung atau tampilkan domain tujuan | [P] |
| SEC-10 | A10 | Tidak ada halaman error khusus (404/500/503); error tersembunyi oleh catch-all | `routes/web.php:39` | Sedang | `resources/views/errors/{404,500,503}.blade.php` bergaya Rencang | [M] |
| SEC-11 | A09 | `LOG_LEVEL=debug`, log tunggal tanpa rotasi; tidak ada yang memantau log | `.env.example`, `config/logging.php` | Rendah | `LOG_CHANNEL=daily`, `LOG_LEVEL=warning` di produksi; cek log saat tiap deploy | [P] |

**Yang sudah aman** dan perlu dipertahankan: tidak ada query database, upload, form, atau input pengguna yang diproses; output Blade memakai `{{ }}` (ter-escape); `@json($end_time)` aman.

---

## 6. Privasi & etika konten

| ID | Temuan | Keparahan | Rekomendasi | Kapan |
|---|---|---|---|---|
| PRV-01 | Pendaftaran event/oprec memakai Google Form via bit.ly. Form adalah titik pengumpulan data pribadi (UU PDP) | Sedang | Halaman **Kebijakan Privasi** singkat: data apa, untuk apa, berapa lama disimpan, siapa yang mengakses. Pernyataan persetujuan di setiap form. Form dimiliki akun `rencang@umn.ac.id`, bukan akun pribadi pengurus. Minta data seperlunya | [P] |
| PRV-02 | Cookie sesi di setiap halaman (SEC-03) | Rendah | Bila sesi dihilangkan, tidak perlu banner cookie | [P] |
| PRV-03 | Rencang banyak berkegiatan dengan **anak-anak** (literasi, desa binaan, YKAI). Foto dokumentasi dipublikasikan | Sedang | Pedoman foto: izin pendamping, hindari wajah anak yang mudah dikenali atau nama lengkap, dan sediakan jalur permintaan penghapusan foto | [J] |

---

## 7. Konsistensi & kualitas kode

| ID | Temuan | Bukti | Rekomendasi | Kapan |
|---|---|---|---|---|
| KOD-01 | **HTML tidak valid**: `home` punya 27 `<div>` buka vs 28 tutup; `Keakraban` 24 vs 23 `<div>` dan 11 `<p>` vs 9 `</p>` (paragraf tidak ditutup di baris 61–67 dan 99–104, plus `</P>` huruf besar); class tidak valid `col lg-6 sm-4`; `<a><button>` bersarang (`home.blade.php:66`); `<div type="button">` (`navbar.blade.php:31`); `rel="shorcut icon"` (`app.blade.php:10`) | Hitungan tag, baca kode | Perbaiki saat menyalin view; validasi dengan W3C validator | [M] |
| KOD-02 | **Inline style & JS**: 33 atribut `style=` (16 di Who We Are), 13 `onclick=` (6 di event, 6 di footer). Menghalangi CSP dan sulit dirawat | Hitungan | Pindah ke CSS dan file JS | [P] |
| KOD-03 | **Duplikasi**: 6 fungsi tab event × 6 baris; galeri ditulis dua kali (grid + carousel); `@font-face` di 10 file CSS; 4 halaman program yang strukturnya hampir identik | `event.blade.php:193–245`, view program | Blade component: `<x-program-page>`, `<x-gallery>`, `<x-hero>`; satu `tokens.css` (DESIGN_SYSTEM §10) | [P] |
| KOD-04 | **Penamaan campur aduk**: view `WhoWeAre`/`rencangCT`/`sch`; folder CSS `Keakraban`/`RCT`/`what-we-do`; **63 file aset bernama dengan spasi**; ekstensi `.JPG` vs `.jpg`. Rawan rusak di server Linux yang peka huruf | `resources/views`, `public/` | Konvensi: **kebab-case, huruf kecil** untuk view, folder, dan aset. Ganti nama aset pasca-migrasi bersamaan dengan optimasi gambar (PRF-01), supaya hanya sekali menyentuh semua path | [M] view / [P] aset |
| KOD-05 | Script di dalam `@section('content')` (Who We Are); Typed.js dimuat tapi tidak dipakai di Who We Are; jQuery dipakai untuk hal sepele | `WhoWeAre.blade.php:5, 172–190` | Pindah ke `@push('scripts')`; JS vanilla (Bootstrap 5 tidak butuh jQuery) | [P] |
| KOD-06 | **Konten & tanggal di-*hardcode*** (target countdown 2022 di controller, semua teks di Blade) | `HomeController.php:10` | File data konten (§9) | [P] |
| KOD-07 | `<html lang="en">` padahal konten berbahasa Indonesia; label navigasi campur Inggris–Indonesia | `app.blade.php:2` | `lang="id"`; putuskan kebijakan bahasa | [M] |
| KOD-08 | **File mati**: `welcome.blade.php`, `page/template.blade.php`, `public/js/navbar/navbar.js`, model `User` + 4 migrasi default, `resources/lang/en`, test contoh | — | Tidak dibawa ke skeleton baru | [M] |
| KOD-09 | Tidak ada formatter atau linter; riwayat commit kurang deskriptif (`"."`, `"REVISI"`) | `git log` | Laravel Pint (sudah ada di skeleton Laravel 12) + konvensi pesan commit | [M] |

---

## 8. Frontend: aksesibilitas, kinerja, SEO

Detail desain dan kontras warna ada di [DESIGN_SYSTEM.md §9](DESIGN_SYSTEM.md). Ringkasan dan tambahannya:

### 8.1 Aksesibilitas (target WCAG 2.2 AA)

| ID | Temuan | Rekomendasi | Kapan |
|---|---|---|---|
| A11Y-01 | Dari 148 atribut `alt`: 14 kosong, **28 bernilai "bukti"**; 8 `<img>` tanpa `alt` sama sekali | Alt deskriptif untuk foto; `alt=""` khusus ilustrasi dekoratif | [P] |
| A11Y-02 | Kontras gagal AA: teks tombol CTA (≈3,1:1), sapaan hero oranye (≈2,2:1), teks footer (≈4,2:1) | Lihat DESIGN_SYSTEM §9.1 | [P] |
| A11Y-03 | Elemen klik non-semantik; `outline: none` menghilangkan fokus keyboard | `<a>`/`<button>` asli; `:focus-visible` | [P] |
| A11Y-04 | Judul halaman memakai `<p>`; tidak ada satu `<h1>` per halaman | Struktur heading berurutan | [P] |
| A11Y-05 | Animasi tanpa `prefers-reduced-motion`; carousel auto-play tanpa tombol jeda | Media query + kontrol jeda | [P] |

### 8.2 Kinerja (target Core Web Vitals "baik")

| ID | Temuan | Rekomendasi | Kapan |
|---|---|---|---|
| PRF-01 | **29 gambar > 1 MB (71,4 MB)**, total ±93 MB; tanpa lazy-load, `srcset`, `width/height` | Konversi ke WebP/AVIF, lebar maks ±1600 px, target < 300 KB per foto; `loading="lazy"`; set dimensi untuk mencegah CLS | [P] |
| PRF-02 | Aset statis tanpa header cache panjang | `.htaccess` (`mod_expires`/`Cache-Control`) + nama file berversi | [P] |
| PRF-03 | Font `.ttf/.otf` tanpa `font-display` dan dideklarasi 10 kali | WOFF2 + `font-display: swap`, satu deklarasi | [P] |
| PRF-04 | Semua halaman memuat jQuery, jQuery UI, Popper, Bootstrap JS, dan SweetAlert2 (67 KB), padahal SweetAlert hanya dipakai satu popup | Muat per halaman, atau ganti popup dengan elemen HTML biasa | [M] jQuery UI / [P] sisanya |

### 8.3 SEO & konten

| ID | Temuan | Rekomendasi | Kapan |
|---|---|---|---|
| SEO-01 | Tidak ada `meta description`, Open Graph, canonical, `sitemap.xml`, atau data terstruktur (Organization JSON-LD); `favicon.ico` 0 byte | Tambah di layout; sitemap statis | [M] favicon / [P] sisanya |
| SEO-02 | Soft-404 dari catch-all | RTE-02 | [M] |
| SEO-03 | **Konten basi**: banner CARITAS (Feb 2022) dengan countdown 00, "© 2020", hanya Gen 13–14, tiga menu "Coming Soon", akun "Twitter" | Sembunyikan banner bila lewat tanggal; tahun dinamis; sembunyikan menu kosong; verifikasi akun sosmed | [M] minimal / [P] |
| SEO-04 | Fitur yang lazim di web UKM tapi belum ada (§2.1): **Oprec**, **Kegiatan terkini**, **Kepengurusan**, **Kerja Sama/Media Partner**, **Kontak** | Tambah bertahap sesuai kapasitas pengurus (§9.3) | [P]/[J] |

---

## 9. Arsitektur target pasca-migrasi

### 9.1 Struktur folder (Laravel 12)

```
app/
  Http/Middleware/SecurityHeaders.php   ← SEC-02
  View/Components/                      ← Hero, ProgramPage, Gallery, EventCard (KOD-03)
bootstrap/app.php                       ← middleware, trustHosts, exception handling
config/rencang.php                      ← nama, kontak, sosmed, alamat, periode aktif
resources/
  content/programs/*.php                ← data per program (judul, kategori, gen, tanggal, teks, foto, tema)
  views/
    layouts/app.blade.php
    partials/{navbar,footer}.blade.php
    components/…
    pages/{home,about,activities,events,program,coming-soon}.blade.php
    errors/{404,500,503}.blade.php
public/
  assets/{css,js,fonts,img}/            ← nama kebab-case, gambar teroptimasi
  .htaccess                             ← cache + header
routes/web.php                          ← Route::view / PageController, nama route deskriptif
tests/Feature/PagesTest.php             ← semua halaman 200, URL salah 404, header keamanan ada
docs/                                   ← dokumen ini + README, DEPLOY, HANDOVER
```

### 9.2 Model konten (tanpa database)

Server UMN menyediakan MySQL/phpMyAdmin, tetapi **database tidak disarankan dulu**. Alasannya: menambah permukaan serangan dan beban perawatan, sementara kontennya berubah hanya beberapa kali setahun. Mulai dengan **file data PHP** yang dibaca satu Blade component:

```php
// resources/content/programs/gedurasi.php
return [
    'slug'       => 'gedurasi',
    'nama'       => 'GEDURASI',
    'kategori'   => 'unggulan',          // tahunan | unggulan | keakraban | insidental
    'generasi'   => 13,
    'tanggal'    => '2021-02-17',
    'tagline'    => '#Read, Lead, Inspire',
    'tema'       => ['heading' => '#FFD249'],
    'blok'       => [ ['judul' => 'Tujuan Gedurasi', 'gambar' => 'gedurasi/logo.webp', 'teks' => '…'] ],
    'galeri'     => ['gedurasi/1.webp', 'gedurasi/2.webp'],
    'pendaftaran'=> null,                 // atau ['url' => '…', 'tutup' => '2026-12-01']
];
```

Menambah event = menambah satu file, tanpa menyentuh logika.

### 9.3 Kapan perlu panel admin?

Literatur web UKM sering memakai panel admin (mis. Laravel + Filament). Untuk Rencang, panel admin baru layak bila **ketiga** syarat ini terpenuhi:
1. Ada database yang dikelola IT dengan backup;
2. Ada **minimal dua** pengurus aktif yang bertanggung jawab atas akun admin;
3. Frekuensi update konten tinggi (mis. artikel rutin).

Sebelum itu, file data + Git lebih aman dan lebih mudah diwariskan.

---

## 10. Roadmap

### Fase 0: Segera (tanpa kode)
- [ ] Balas email IT, minta versi PHP persis, akses FTP baru, dan perpanjangan waktu
- [ ] **[SEC-07]** Minta IT mengganti kredensial FTP lama
- [ ] Commit pekerjaan Fase 1 (Laravel 8.83.29) sebagai titik aman cadangan

### Fase M: Migrasi Laravel 12 (branch `upgrade-laravel-12`)
Prinsip: **paritas tampilan dan URL**, ditambah perbaikan yang murah dikerjakan sekalian.
- [ ] Skeleton Laravel 12 terbaru; salin views, aset, dan route
- [ ] Tidak membawa: `routes/api.php`, Sanctum, Guzzle, CORS, Mix/axios, file mati (STK-03, STK-05, RTE-01, KOD-08)
- [ ] Hapus catch-all, buat halaman 404/500/503 (RTE-02, SEC-10)
- [ ] Hapus route duplikat, `Route::view`, nama route deskriptif (RTE-03/04/06)
- [ ] Hapus jQuery UI (STK-04)
- [ ] Perbaiki HTML tidak valid saat menyalin view; nama view kebab-case; `lang="id"`; favicon (KOD-01/04/07, SEO-01)
- [ ] `.env.example` aman produksi; sesi `file`, tanpa database (SEC-01)
- [ ] Banner event otomatis tersembunyi bila tanggal lewat; tahun footer dinamis (SEO-03 minimal)
- [ ] Laravel Pint; test fitur dasar (KOD-09)
- [ ] Bandingkan tampilan lama vs baru di 375 / 768 / 1280 px

### Fase H: Hardening (setelah situs hidup)
- [ ] Middleware security header; CSP Report-Only → enforce (SEC-02)
- [ ] Halaman publik tanpa sesi, atau minimal `SESSION_SECURE_COOKIE=true` (SEC-03)
- [ ] Self-host library frontend atau SRI (SEC-05); `trustHosts` (SEC-08); log harian (SEC-11)
- [ ] Verifikasi di server: `/.env` → 404, HTTPS + HSTS, `X-Powered-By` hilang (SEC-04/06)

### Fase K: Konten & UX
- [ ] Optimasi gambar + ganti nama aset kebab-case (PRF-01, KOD-04)
- [ ] Data konten + Blade component (KOD-03/06, §9.2)
- [ ] Bootstrap 5, JS vanilla, hapus inline style/JS (STK-04, KOD-02/05)
- [ ] Aksesibilitas (§8.1) dan SEO (§8.3)
- [ ] Halaman baru bertahap: Oprec, Kegiatan terkini, Kepengurusan, Kerja Sama, Kebijakan Privasi (SEO-04, PRV-01)

### Fase O: Operasional & keberlanjutan
- [ ] **GitHub Organization milik Rencang**, dengan pemilik akun `rencang@umn.ac.id` dan ≥ 2 admin aktif; transfer repo ke sana. Hindari akun email *student*, karena dinonaktifkan setelah lulus
- [ ] `README.md` (setup lokal, struktur, cara tambah event), `DEPLOY.md` (langkah unggah, file yang tidak boleh ditimpa, smoke test, rollback), `HANDOVER.md` (daftar akses tanpa kata sandi, siapa pemegangnya)
- [ ] CI GitHub Actions: `composer validate`, `composer audit`, `pint --test`, `php artisan test`; Dependabot untuk Composer
- [ ] Proteksi branch `main`, review PR oleh anggota lain, tag rilis tiap deploy
- [ ] **Checklist serah terima tiap generasi**: ganti kata sandi, pindahkan admin, perbarui periode & footer, cek tanggal EOL Laravel

### Fase L13: Upgrade Laravel 13 (sebelum 24 Feb 2027)
- [ ] Konfirmasi server PHP ≥ 8.3 (minta IT bila masih 8.2)
- [ ] PHP 8.3 di lokal; naikkan `laravel/framework` ke `^13`; jalankan test; deploy
- [ ] Pasang pengingat tahunan: Laravel merilis versi mayor tiap Q1

---

## 11. Checklist sebelum setiap deploy

- [ ] `php artisan test` hijau; `composer audit` tanpa advisory baru yang relevan
- [ ] `vendor/` dibangun dengan `composer install --no-dev --optimize-autoloader` dan `platform.php` = versi PHP server
- [ ] `.env` produksi: `APP_ENV=production`, `APP_DEBUG=false`, `APP_URL=https://rencang.umn.ac.id`, `APP_KEY` terisi
- [ ] Tidak menimpa `.env` dan `storage/` di server; backup versi lama sebelum unggah
- [ ] `storage/` dan `bootstrap/cache/` writable; `php artisan optimize` (bila ada akses CLI)
- [ ] Smoke test: semua halaman 200, URL acak 404, `/.env` 404/403, tidak ada error di log
- [ ] Catat tanggal, versi, dan siapa yang deploy (tag Git)

---

## 12. Referensi

**Keamanan & framework**
- OWASP Top 10:2025, pengantar resmi: <https://owasp.org/Top10/2025/0x00_2025-Introduction/>
- Laporan perubahan OWASP Top 10 2025: <https://www.theregister.com/2025/11/11/new_owasp_top_ten_broken/>
- Tabel dukungan Laravel: <https://laravel.com/framework/docs/12.x/releases.md>
- OWASP Secure Headers Project: <https://github.com/owasp/www-project-secure-headers>
- CVE-2024-6531 (Bootstrap, dicabut): <https://advisories.gitlab.com/pkg/nuget/bootstrap.sass/CVE-2024-6531>
- CVE jQuery UI: <https://www.cvelogic.com/vendor/jqueryui>
- Perubahan deploy Laravel 12 (pihak ketiga): <https://deploynix.io/blog/laravel-12-deployment-changes-what-you-need-to-know>

**Kinerja & aksesibilitas**
- Ambang Core Web Vitals: <https://web.dev/articles/defining-core-web-vitals-thresholds>
- *How Accessible the University Websites in Indonesia for People with Disabilities?* (IJDS, 2020): <https://ijds.ub.ac.id/index.php/ijds/article/view/248>
- Evaluasi aksesibilitas website universitas Indonesia dengan WCAG 2.2 (Sistemasi, 2026): <https://sistemasi.ftik.unisi.ac.id/index.php/stmsi/article/download/5824/1210>

**Literatur sistem informasi UKM** (dibaca dari abstrak/cuplikan, belum teks lengkap)
- *Sistem Informasi Pengelolaan Kegiatan UKM di Lingkungan Universitas Khairun Ternate Berbasis Web*: <https://jurnal.unimus.ac.id/index.php/ME/article/view/7569/0>
- Repositori UGM (sistem informasi UKM): <https://etd.repository.ugm.ac.id/penelitian/detail/71274>
- Jurnal UNTAR (JIKSI): <https://journal.untar.ac.id/index.php/jiksi/article/download/24154/14616/70593>
- E-journal UPB Batam: <https://ejournal.upbatam.ac.id/index.php/cbis/en/article/download/10863/4909/49629>
- Telkom University Open Library: <https://openlibrarypublications.telkomuniversity.ac.id/index.php/engineering/article/download/27676/26150/54737>

**Regulasi**
- UU No. 27 Tahun 2022 tentang Pelindungan Data Pribadi: <https://peraturan.bpk.go.id/Details/229798/uu-no-27-tahun-2022>
- Kewajiban pengendali data (Hukumonline): <https://www.hukumonline.com/berita/a/uu-pdp--pelaksanaan-kewajiban-pengendali-dan-prosesor-data-pribadi-jadi-tantangan-lt63689b9f8a255/>
