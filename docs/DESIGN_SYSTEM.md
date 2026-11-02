# Design System: Website Rencang

> Dokumentasi design system **yang tersirat** di kode (dikumpulkan dari 12 file CSS, 13 view Blade, dan aset di `public/`), ditambah usulan token supaya konsisten ke depannya.
> Status: Draf v1 · 2 November 2026
> Dokumen terkait: [ARCHITECTURE.md](ARCHITECTURE.md) · [PRD.md](PRD.md)

Website ini **tidak punya design system formal**: tidak ada variabel CSS, tidak ada file token, dan tiap halaman punya CSS sendiri. Dokumen ini merangkum pola yang benar-benar dipakai, lalu memberi bentuk baku yang bisa diterapkan tanpa mengubah tampilan.

---

## 1. Karakter brand

| Aspek | Wujud di website |
|---|---|
| **Kepribadian** | Hangat, ramah, kekeluargaan, sederhana. Sapaan "Halo, Sahabat", "Hai Cangs", hashtag `#SahabatRencang` |
| **Metafora visual** | Lanskap ilustrasi ceria: pelangi, matahari, gelombang biru, burung, rumput, rumah. Foto kegiatan dibingkai bingkai ilustrasi (*frame*) |
| **Maskot / logo** | Anjing Siberian Husky di lingkaran putih |
| **Bahasa** | Konten utama Bahasa Indonesia; label navigasi dan beberapa tagline Bahasa Inggris ("What We Do?", "Spread The Light Make A Change") |
| **Tagline** | "To help with love and care towards all of our surrounding in simplicity and humility" (Gen XIII), "Light The Way for Tomorrow" (CARITAS) |

---

## 2. Warna

### 2.1 Palet inti (dipakai lintas halaman)

| Usulan token | Hex | Peran yang diamati | Dipakai di |
|---|---|---|---|
| `--rc-cream` | `#FFF3E1` | **Background halaman** (`body`), teks di atas warna gelap | navbar.css, footer, tombol |
| `--rc-yellow` | `#F7DF6D` | Navbar, kartu kategori, dropdown mobile, kartu kamus | navbar.css, WhatWeDo, WhoWeAre |
| `--rc-teal` | `#388177` | **Warna primer gelap**: footer, judul kartu, hover dropdown | footer, navbar, WhatWeDo, Keakraban |
| `--rc-teal-alt` | `#3A8278` | Varian teal (selisih tipis, sebaiknya disatukan ke `--rc-teal`) | event.css |
| `--rc-green` | `#2E9976` | Aksen hijau: highlight teks, tombol "enter", kartu hover | WhoWeAre, WhatWeDo |
| `--rc-coral` | `#EC5D56` | **Aksen / CTA**: judul seksi, tombol Daftar, angka countdown | home, WhoWeAre, event |
| `--rc-orange` | `#F18D34` | Sapaan hero, teks "COMING SOON" | home, soon |
| `--rc-orange-alt` | `#F28C32` | Varian oranye (sebaiknya disatukan) | whoweare.css |
| `--rc-gray-700` | `#5B5B5B` | **Teks body** dan link navbar, warna bayangan tombol | home, navbar |
| `--rc-mint` | `#BDF3EA` | Background seksi bawah beranda (rumah) | home |
| `--rc-aqua` | `#9ADCDA` | Overlay foto (opacity 0.6) | WhatWeDo |
| `--rc-ivory` | `#FFFAEE` | Background lingkaran logo event | event |
| `--rc-gray-300` | `#BCBCBC` | Bayangan lembut | event |

### 2.2 Palet tema per program

Setiap halaman program punya palet sendiri yang diambil dari identitas visual event-nya. Ini disengaja dan sebaiknya dipertahankan sebagai **tema**, bukan dilebur ke palet inti.

| Program | Warna kunci | Kesan |
|---|---|---|
| **GEDURASI** (literasi) | `#FFD249` kuning, `#B9B46F` olive (glow shadow) | Buku, hangat |
| **SENTERA** (kanker anak) | `#FF6B75` pink-merah, `#5181A1` biru, `#7E79A4` ungu, `#FFDEAE` peach, `#FFD249` | Harapan, lembut |
| **SCH** (donor darah) | `rgb(231,205,175)` krem tua, `rgb(136,84,34)` coklat, `rgb(255,209,0)` kuning | Darah/hangat, ilustrasi tetes darah |
| **RCT** (bencana) | Bayangan hitam pekat (`0 0 30px black`) | Serius |
| **Keakraban** | Pastel per kartu: `#FFF0DE`, `#CFEAE1`, `#FFF8DB`, `#FEF0E7`, `#E9F7FE`, `#FEE9CC` | Ceria, akrab |

### 2.3 Masalah warna

- Ada **dua teal** (`#388177` vs `#3A8278`) dan **tiga oranye** (`#F18D34`, `#F28C32`, `#F6A801`) yang selisihnya hampir tak terlihat. Satukan.
- Teks body di `.card-text` memakai `black` murni, sedangkan halaman lain memakai `#5B5B5B`. Pilih satu.
- `.pengertian` di event memakai keyword `grey` (`#808080`).
- Semua warna ditulis langsung (*hardcode*) di ±100 tempat, tanpa variabel.

---

## 3. Tipografi

### 3.1 Keluarga font

| Font | File di `public/fonts` | Nama di CSS | Peran |
|---|---|---|---|
| **Baloo Paaji 2** | Regular, Medium, SemiBold, Bold, ExtraBold (.ttf, OFL) | `Baloo_pajja` | **Font body/UI default** di hampir semua halaman |
| **Merriweather Black** | Hanya bobot Black yang dipakai, walau 8 varian tersedia (.ttf, OFL) | `merriweather` | **Display/heading**: judul seksi, sapaan, tagline, "COMING SOON" |
| **MADE TOMMY** | 16 varian .otf, nama file "PERSONAL USE" | `made_tommy` | Heading/body khusus halaman SENTERA |
| **Sketcha** | .ttf | `sketcha` | Judul hero dekoratif di SCH dan RCT |
| Times New Roman | (sistem) | – | Judul header di halaman Event (kemungkinan tidak disengaja) |
| Default Bootstrap | (sistem) | – | Navbar dan footer, karena keduanya tidak menyetel `font-family` |

### 3.2 Inkonsistensi yang perlu diketahui

- **Nama font sama, file beda.** `Baloo_pajja` dipetakan ke `BalooPaaji2-Regular.ttf` di home/event/whoweare, tapi ke `BalooPaaji2-Bold.ttf` di gedurasi/sch/rct/sentera, dan ke `-Medium` di Keakraban. Jadi "font body" tampil dengan ketebalan berbeda antar halaman.
- `@font-face` dideklarasikan ulang di 10 file CSS, tanpa `font-weight`, `font-display`, atau format `woff2`.
- Nama di CSS beda huruf besar/kecil (`Baloo_pajja` vs `baloo_pajja`). Nama font CSS tidak peka huruf, jadi tidak rusak, tapi membingungkan.

### 3.3 ⚠️ Lisensi

- **MADE TOMMY** berasal dari file berlabel `_PERSONAL USE`, dan ada `License READ ME FIRST.txt` di folder yang sama. Lisensi personal umumnya **tidak mencakup** website publik organisasi. Baca file lisensinya, lalu beli lisensi atau ganti ke font OFL yang mirip (mis. *Poppins* atau *Nunito*).
- **Sketcha**: tidak ada file lisensi di repo. Perlu dicek.
- Baloo Paaji 2 dan Merriweather berlisensi **SIL OFL** (ada `OFL.txt`), jadi aman.

### 3.4 Skala tipografi (diamati)

Ukuran ditulis dalam `em`, `vw`, dan `pt` tanpa skala baku. Nilai yang paling sering muncul:

| Peran | Nilai di kode | Usulan token |
|---|---|---|
| Hero / judul seksi besar | `3em` (Merriweather, coral/oranye) | `--rc-text-display: clamp(2rem, 4vw, 3rem)` |
| Angka countdown | `4.2em` → `3em` di mobile | `--rc-text-numeral: clamp(2.5rem, 6vw, 4.2rem)` |
| Judul header event | `50pt` Times | ganti dengan `--rc-text-display` + Merriweather |
| Judul kartu | `1.8em` bold teal | `--rc-text-h3: 1.75rem` |
| Sub-judul | `1.8em` → `1.4em` mobile | `--rc-text-h4: 1.5rem` |
| Body besar | `1.2em`–`1.3em` | `--rc-text-lg: 1.25rem` |
| Body | `1.1em` | `--rc-text-base: 1.0625rem` |
| Body kecil / kartu | `0.9em` → `0.8em` mobile | `--rc-text-sm: 0.875rem` |
| Label countdown | `1.1em` → `0.7em` | `--rc-text-xs: 0.75rem` |
| Kartu kamus | `2vw` / `3vw` | **Hindari `vw` murni**: teks jadi terlalu kecil di mobile |

---

## 4. Layout, grid, dan spasi

### 4.1 Grid

- **Bootstrap 4.5 grid** (`container`, `container-fluid`, `row`, `col-lg-3 col-sm-6`, dst.) dipakai di navbar, footer, What We Do, dan Who We Are.
- Halaman program (home, gedurasi, sentera, sch, rct, event) memakai **flexbox kustom** dengan lebar persen (`width: 50%/42%/60%`) dan padding besar (`100px`, `200px`).
- Pola utama: **dua kolom gambar + teks** (`.image` + `.information`) yang ditumpuk vertikal di ≤ 768/992 px.

### 4.2 Breakpoint

Bootstrap memakai 576 / 768 / 992 / 1200. CSS kustom memakai **25 nilai berbeda**:

```
320 · 340 · 350 · 360 · 375 · 400 · 420 · 440 · 475 · 480 · 550 · 576 · 578
768 · 769 · 787 · 826 · 990 · 991 · 992 · 1010 · 1080 · 1170 · 1200 · 1268 · 1280
```

**Usulan:** pakai breakpoint Bootstrap saja, ditambah satu untuk ponsel kecil.

| Token | Nilai | Target |
|---|---|---|
| `xs` | < 576 px | Ponsel |
| `sm` | ≥ 576 px | Ponsel besar |
| `md` | ≥ 768 px | Tablet |
| `lg` | ≥ 992 px | Laptop. Navbar berubah dari hamburger ke menu penuh di sini |
| `xl` | ≥ 1200 px | Desktop |

`578px` dan `990px` hampir pasti dimaksudkan `576px` dan `992px`.

### 4.3 Spasi

Tidak ada skala. Nilai bebas seperti `10px`, `15px`, `30px`, `50px`, `100px`, `130px`, `200px`, `250px`, `10em`. `WhatWeDo.css` bahkan **menimpa utilitas Bootstrap** `.pt-5` menjadi `60px !important`.

**Usulan:** skala 4/8 px → `--rc-space-1: 4px`, `-2: 8px`, `-3: 12px`, `-4: 16px`, `-6: 24px`, `-8: 32px`, `-12: 48px`, `-16: 64px`, `-24: 96px`. Jangan menimpa utilitas Bootstrap.

### 4.4 Layering

Ilustrasi dekoratif diposisikan `absolute` di belakang konten. `WhatWeDo.css` mendefinisikan `.absolute-layer` (z 0), `.top-layer` (z 1), `.top2-layer` (z 2), dan navbar memakai z 1000. Pola ini bagus untuk dijadikan token:

| Token | z-index | Isi |
|---|---|---|
| `--rc-z-decor` | 0 | Gelombang, burung, pola |
| `--rc-z-content` | 1 | Konten |
| `--rc-z-overlay` | 2 | Bingkai foto, burung di atas foto |
| `--rc-z-nav` | 1000 | Navbar |

---

## 5. Bentuk, bayangan, dan gerak

### 5.1 Radius

| Nilai diamati | Dipakai untuk | Usulan token |
|---|---|---|
| `7px` | Kotak input kartu kamus | `--rc-radius-sm: 8px` |
| `10px` | Tombol CTA, gambar program | `--rc-radius-md: 10px` |
| `15px`, `20px` | Kartu kamus, kartu Keakraban, kotak gambar | `--rc-radius-lg: 20px` |
| `25px` | Kartu kategori What We Do | `--rc-radius-xl: 25px` |
| `50px`–`100px` | Bentuk kapsul/blob di Sentera, Gedurasi | `--rc-radius-pill: 999px` |
| `50%` | Logo bulat (event, navbar) | `--rc-radius-full: 50%` |

### 5.2 Bayangan

| Gaya | Nilai | Dipakai | Usulan token |
|---|---|---|---|
| Tombol | `0 5px 10px 0 #5B5B5B` | CTA home | `--rc-shadow-button` |
| Lembut | `0 5px 10px 0 #BCBCBC` | Logo event | `--rc-shadow-sm` |
| Kartu | `0 6px 7px rgba(0,0,0,.35)` | Kartu Keakraban | `--rc-shadow-md` |
| Bootstrap | `.shadow`, `.shadow-lg` | Kartu What We Do, navbar | (pakai bawaan) |
| *Glow* tema | `0 0 40px 10px #B9B46F`, `0 0 100px 50px #B9B46F` | Gedurasi, Sentera | Khusus tema |
| Dramatis | `0 0 30px 0 black` | Foto SCH, RCT | Khusus tema |

### 5.3 Gerak

- Interaksi utama: **hover `transform: scale(1.1)`** pada tombol, kartu kategori, dan logo event.
- Durasi yang dimaksud ±0,2 s, tapi deklarasi `transition: duration .2s` di `home3.css` **tidak valid** (properti `duration` tidak ada), sehingga tombol beranda membesar tanpa animasi. Yang benar: `transition: transform .2s ease`.
- Efek ketik (Typed.js), kursor berkedip, `fadeIn` terjemahan, carousel Bootstrap.
- Tidak ada dukungan `prefers-reduced-motion`.

**Usulan:** `--rc-duration-fast: 150ms`, `--rc-duration-base: 200ms`, `--rc-ease: cubic-bezier(.2,.8,.2,1)`; skala hover diturunkan ke `1.05` supaya tidak menabrak elemen sebelah di grid; matikan animasi di `@media (prefers-reduced-motion: reduce)`.

---

## 6. Ilustrasi, ikon, dan foto

| Jenis | Aset | Pola penggunaan |
|---|---|---|
| **Pola latar** | `public/images/public/{left,right-top,right-bottom}-pattern.png` | Ditempel di sudut seksi, disembunyikan di mobile |
| **Burung** | `left-bird.png`, `right-bird.png`, `Homepage/buwong-2.png` | Aksen di sekitar foto header |
| **Gelombang** | `Gelombang-Biru_*` (home), `gelombang-*-cream` (Keakraban), `gelombang-biru_*` (event) | Sudut kiri/kanan, disembunyikan ≤ 1080 px |
| **Lanskap** | `pelangi-atas`, `matahariBatas`, `Gelombang bawah_burung_awan`, `Rumput-dibawah`, `Rumah` | Beranda, membingkai seluruh halaman dari atas ke bawah |
| **Bingkai foto** | `Homepage/Home.png`, `what-we-do/frame*.png`, `who-we-are/header.png`, `Frame-Kecil_oren.png`, `event/Asset/kotakevent.png` | Foto diletakkan `absolute` di bawah PNG bingkai berlubang |
| **Ikon kategori** | `what-we-do/{tahunan,unggulan,keakraban,insidental}.png` | Di atas latar `bg-card-img.png` |
| **Logo event** | `event/Asset/*/Logo *.png` | Lingkaran ivory dengan bayangan |
| **Ikon sosmed** | `public/icon-*.png` (6 buah) | Footer. PNG raster, bukan SVG |

Semua ilustrasi berupa **PNG raster**. Rekomendasi: ekspor ulang ilustrasi garis/bentuk datar ke **SVG**, ikon sosmed ke SVG (mis. Simple Icons), dan foto ke **WebP ≤ 300 KB** (lihat ARCHITECTURE §7.2).

---

## 7. Komponen

### 7.1 Navbar
- **Anatomi:** kiri (Home, What We Do?) · tengah (logo bulat putih 68 px) · kanan (Who We Are? ▾, Articles). Background `--rc-yellow`, teks `--rc-gray-700` bold.
- **Responsif:** < 992 px berubah ke hamburger, logo dipindah ke kiri (`.mobileOnly`), dan dropdown jadi kuning.
- **State:** dropdown muncul saat hover (jQuery manual); item dropdown hover → background teal, teks cream. Status aktif via class `.active`, tapi Home tidak pernah aktif (lihat ARCHITECTURE §6.1).
- **Masalah:** toggle dropdown berupa `<div type="button">` tanpa `href`, sehingga tidak bisa dijangkau keyboard; `aria-expanded` tidak pernah diperbarui.

### 7.2 Footer
- Background `--rc-teal`, teks `--rc-cream`. Dua baris: link navigasi + alamat, lalu hak cipta + 6 ikon sosmed.
- **Masalah:** ikon sosmed berupa `<img onclick>`, bukan `<a href>`, jadi tidak bisa di-tab, tidak bisa "buka di tab baru", dan tidak terbaca crawler. Teks "@ 2020" seharusnya "© {tahun}". Link "Articles" mengarah ke `#`.

### 7.3 Tombol CTA (*primary*)
```
background --rc-coral · text --rc-cream · weight 500
padding 10px 30px · radius 10px · shadow --rc-shadow-button
hover: scale(1.1), cursor pointer
```
- Varian: "Selengkapnya" (padding 7px 50px), versi mobile hijau `--rc-teal` untuk tombol pertama.
- **Masalah:** `<a><button>` bersarang (HTML tidak valid); `outline: none` menghapus fokus keyboard.

### 7.4 Tombol "View More >>" (sekunder)
Teks dengan chevron `>>` di panel event, navigasi via JS `window.location`, bukan `<a>`.

### 7.5 Banner Event + Countdown
- **Anatomi:** logo event (40%) | nama event spasi-lebar ("C A R I T A S", Merriweather coral) → 4 sel countdown (angka besar + label DAYS/HOURS/MINUTES/SECONDS) → judul "OPEN REGISTRATION" → deskripsi → tombol Daftar.
- **Responsif:** ≤ 992 px kolom ditumpuk, konten rata tengah.
- **Masalah:** data di-*hardcode*; tidak ada state "pendaftaran ditutup"; nama dengan spasi manual dibaca screen reader huruf per huruf.

### 7.6 Kartu kategori (What We Do)
- Ikon dalam latar lingkaran ilustrasi (diposisikan absolut di atas) → kartu kuning radius 25 px, `.shadow` → judul teal 1.8em → deskripsi 0.9em rata tengah.
- Hover: kartu `scale(1.1)`. Varian `-hover` (hijau, teks cream) didefinisikan di CSS tapi tidak dipakai.

### 7.7 Kartu periode
Gambar generasi di kiri + kartu putih `shadow-lg` berisi judul periode. Seluruh kartu bisa diklik (JS), tanpa indikasi visual bahwa ini tautan.

### 7.8 Tab logo event (Event hub)
6 lingkaran ivory (`border-radius: 50%`, bayangan lembut) dalam satu baris; klik untuk menampilkan panel event terkait. Tidak ada state "terpilih", tidak ada `role="tab"`/`aria-selected`.

### 7.9 Panel event
Foto dalam bingkai `kotakevent.png` + judul (Merriweather) + deskripsi + tombol View More. Satu panel tampil pada satu waktu.

### 7.10 Blok gambar + teks (halaman program)
Komponen yang paling sering dipakai (Gedurasi, Sentera, SCH, RCT, Keakraban):
```
[ gambar/ilustrasi ]  [ judul (Merriweather/tema) ]
                      [ deskripsi                  ]
```
Bergantian kiri-kanan di Keakraban; ditumpuk di mobile. Header-nya "Program Unggulan/Rutin/Insidental + tanggal".

### 7.11 Galeri dokumentasi
- Desktop: grid 2 baris × 3 atau 4 foto. Mobile: Bootstrap carousel dengan foto yang sama.
- **Masalah:** markup ditulis dua kali; semua `alt="bukti"`; tidak ada lightbox; foto berukuran asli (MB).

### 7.12 Kartu kamus "Arti Kata" (Who We Are)
Kartu kuning radius 15 px: ilustrasi kamus + judul "Arti Kata *Rencang*" → input semu "Rencang |" (kursor berkedip) + tombol enter hijau → kotak terjemahan "Sahabat /sa.ha.bat/ n …" yang muncul saat diklik. Seluruh gaya ditulis *inline*. Ini komponen paling khas; layak dipertahankan, tapi pindahkan gayanya ke CSS.

### 7.13 Header foto berbingkai
Foto + PNG bingkai ilustrasi + teks judul di tengah (Event, Keakraban, What We Do, Who We Are). Tiap halaman punya implementasi CSS berbeda untuk efek yang sama.

### 7.14 Halaman "Coming Soon"
Teks Merriweather oranye di tengah viewport penuh. Tanpa ilustrasi, tanpa tautan kembali.

---

## 8. Template halaman

| Template | Urutan seksi | Dipakai oleh |
|---|---|---|
| **Landing** | Hero ilustrasi → Banner Event → Intro + CTA → Ilustrasi penutup | Home |
| **Profil** | Header foto berbingkai → seksi naratif dua kolom berselang-seling + pola latar | Who We Are |
| **Indeks** | Header foto → grid kartu → daftar periode | What We Do |
| **Hub** | Header → tagline → tab logo → panel | Event |
| **Detail program** | Hero (judul + tagline) → label program + tanggal → 2× Blok gambar+teks → Galeri | Gedurasi, Sentera, SCH, RCT |
| **Detail multi-sub** | Header → N× Blok gambar+teks (bergantian) + gelombang dekoratif | Keakraban |

Template **Detail program** sudah konsisten secara struktur di 4 halaman, tapi tiap halaman punya CSS sendiri (4,8–8,6 KB). Ini kandidat terbaik untuk dijadikan satu Blade component (`<x-program-page :program="$p" />`) dengan tema warna sebagai parameter (lihat PRD R-01).

---

## 9. Aksesibilitas

### 9.1 Kontras warna (perhitungan rasio WCAG)

| Pasangan | Rasio | Teks normal (≥ 4.5) | Teks besar (≥ 3.0) | Dipakai untuk |
|---|---|---|---|---|
| `#5B5B5B` di `#FFF3E1` | ≈ 6.2 : 1 | ✅ | ✅ | Body text |
| `#5B5B5B` di `#F7DF6D` | ≈ 5.1 : 1 | ✅ | ✅ | Link navbar |
| `#FFF3E1` di `#388177` | ≈ 4.2 : 1 | ❌ | ✅ | **Teks footer** (normal, light) |
| `#EC5D56` di `#FFF3E1` | ≈ 3.1 : 1 | ❌ | ✅ (pas-pasan) | Judul besar coral |
| `#FFF3E1` di `#EC5D56` | ≈ 3.1 : 1 | ❌ | ✅ | **Teks tombol CTA** (ukuran normal) |
| `#2E9976` di `#FFF3E1` | ≈ 3.2 : 1 | ❌ | ✅ | Highlight teks di paragraf Who We Are |
| `#F18D34` di `#FFF3E1` | ≈ 2.2 : 1 | ❌ | ❌ | **Sapaan hero "Halo, Sahabat"**, "COMING SOON" |

Perbaikan dengan perubahan visual minimal:
- Tombol CTA: gelapkan coral ke ±`#C9403A` (≈ 4.6 : 1 dengan cream), atau besarkan dan tebalkan teks tombol.
- Sapaan oranye: gelapkan ke ±`#B85C0A`, atau beri outline teks; karena ini teks hero, target minimal 3 : 1.
- Footer: gelapkan teal ke ±`#2F6E65`, atau naikkan teks ke bobot normal/bold.

> Angka di atas dihitung manual dengan rumus luminans relatif WCAG. Verifikasi ulang dengan alat seperti WebAIM Contrast Checker sebelum mengganti warna.

### 9.2 Temuan lain

| Masalah | Lokasi | Perbaikan |
|---|---|---|
| Elemen klik non-semantik (`<img onclick>`, `<div onclick>`, `<button>` + JS redirect) | Footer, event, WhatWeDo, WhoWeAre | Pakai `<a href>` untuk navigasi, `<button>` untuk aksi |
| `outline: none` pada tombol | home3.css | Hapus, atau beri `:focus-visible` |
| Teks alternatif tidak bermakna (`alt="bukti"`, `alt="logo"` berulang) atau kosong | Galeri, panel event | Deskripsikan isi foto; ilustrasi dekoratif pakai `alt=""` |
| `<html lang="en">` padahal konten berbahasa Indonesia | Layout | `lang="id"` |
| Heading tidak berurutan; banyak judul memakai `<p>` | Home, Gedurasi, Sentera | Satu `<h1>` per halaman, lalu `<h2>`/`<h3>` |
| Ukuran font `vw` murni | Kartu kamus | `clamp()` dengan batas bawah |
| Animasi tanpa `prefers-reduced-motion` | Typed.js, kursor, carousel, hover | Tambah media query |
| Carousel auto-play tanpa tombol pause | Galeri mobile | `data-interval="false"` atau tombol pause |
| Tidak ada meta description / Open Graph | Layout `template/app.blade.php` (judul halaman sudah unik per controller) | Tambah `<meta name="description">` dan tag OG |

---

## 10. Usulan implementasi token

Tambahkan satu file `public/css/tokens.css` yang dimuat di layout **sebelum** CSS halaman, lalu ganti nilai *hardcode* secara bertahap. Langkah ini tidak mengubah tampilan sama sekali.

```css
:root {
  /* Warna inti */
  --rc-cream:    #FFF3E1;
  --rc-ivory:    #FFFAEE;
  --rc-yellow:   #F7DF6D;
  --rc-teal:     #388177;
  --rc-green:    #2E9976;
  --rc-coral:    #EC5D56;
  --rc-orange:   #F18D34;
  --rc-mint:     #BDF3EA;
  --rc-aqua:     #9ADCDA;
  --rc-gray-700: #5B5B5B;
  --rc-gray-300: #BCBCBC;

  /* Peran */
  --rc-bg:            var(--rc-cream);
  --rc-text:          var(--rc-gray-700);
  --rc-heading:       var(--rc-coral);
  --rc-primary:       var(--rc-teal);
  --rc-accent:        var(--rc-coral);
  --rc-on-primary:    var(--rc-cream);

  /* Tipografi */
  --rc-font-body:    "Baloo Paaji 2", system-ui, sans-serif;
  --rc-font-display: "Merriweather", Georgia, serif;
  --rc-text-xs:      0.75rem;
  --rc-text-sm:      0.875rem;
  --rc-text-base:    1.0625rem;
  --rc-text-lg:      1.25rem;
  --rc-text-h4:      1.5rem;
  --rc-text-h3:      1.75rem;
  --rc-text-display: clamp(2rem, 4vw, 3rem);

  /* Bentuk & bayangan */
  --rc-radius-sm: 8px;
  --rc-radius-md: 10px;
  --rc-radius-lg: 20px;
  --rc-radius-xl: 25px;
  --rc-shadow-sm:     0 5px 10px 0 var(--rc-gray-300);
  --rc-shadow-md:     0 6px 7px rgba(0, 0, 0, .35);
  --rc-shadow-button: 0 5px 10px 0 var(--rc-gray-700);

  /* Gerak */
  --rc-duration: 200ms;
  --rc-ease: cubic-bezier(.2, .8, .2, 1);
}

/* Satu deklarasi font, dipakai semua halaman */
@font-face { font-family: "Baloo Paaji 2"; font-weight: 400; font-display: swap;
             src: url("../fonts/Baloo_Paaji_2/BalooPaaji2-Regular.ttf") format("truetype"); }
@font-face { font-family: "Baloo Paaji 2"; font-weight: 500; font-display: swap;
             src: url("../fonts/Baloo_Paaji_2/BalooPaaji2-Medium.ttf") format("truetype"); }
@font-face { font-family: "Baloo Paaji 2"; font-weight: 700; font-display: swap;
             src: url("../fonts/Baloo_Paaji_2/BalooPaaji2-Bold.ttf") format("truetype"); }
@font-face { font-family: "Merriweather"; font-weight: 900; font-display: swap;
             src: url("../fonts/Merriweather/Merriweather-Black.ttf") format("truetype"); }

@media (prefers-reduced-motion: reduce) {
  *, *::before, *::after { animation: none !important; transition: none !important; }
}
```

Tema program cukup menimpa variabel peran di wrapper halamannya, misalnya `.theme-sentera { --rc-heading: #FF6B75; --rc-font-body: "MADE Tommy", …; }`.

### Urutan penerapan yang aman

1. Tambah `tokens.css` dan muat di layout. Tidak ada perubahan visual.
2. Hapus `@font-face` duplikat di 10 file CSS. Periksa halaman yang dulu memetakan `Baloo_pajja` ke Bold, lalu set `font-weight: 700` di sana supaya tampilannya tetap sama.
3. Cari-ganti hex inti → `var(--rc-…)`.
4. Satukan varian warna kembar (`#3A8278` → teal, `#F28C32` → orange).
5. Rapikan breakpoint ke set Bootstrap.
6. Perbaiki kontras dan aksesibilitas (§9), karena langkah inilah yang mengubah tampilan.

> Langkah 1–5 bisa dilakukan setelah upgrade PHP selesai dan tidak wajib untuk syarat IT. Prioritas sekarang tetap ARCHITECTURE §8.
