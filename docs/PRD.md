# PRD: Website Resmi UKM Sosial Rencang

> **Jenis dokumen:** PRD *reverse-engineered* dari produk yang sudah berjalan (as-built), ditambah kebutuhan baru akibat imbauan upgrade PHP dari IT Infrastructure UMN (27 Okt 2026).
> **Status:** Draf v1 · 2 November 2026
> Dokumen terkait: [ARCHITECTURE.md](ARCHITECTURE.md) · [DESIGN_SYSTEM.md](DESIGN_SYSTEM.md)

---

## 1. Latar belakang

**Rencang** adalah komunitas/UKM sosial di bawah Universitas Multimedia Nusantara (UMN), didirikan 23 September 2007 oleh empat mahasiswa angkatan 2007–2008. Rencang berawal dari Sosial Otomotif Multimedia (SOM). Namanya berasal dari bahasa Jawa yang berarti *sahabat*, dan logonya anjing Siberian Husky sebagai simbol kesetiaan.

Kegiatan Rencang terbagi dalam empat kategori:

| Kategori | Contoh dari website & arsip pengurus |
|---|---|
| **Tahunan** | Donor darah (*Sharing, Caring, Helping* / HoB) bersama PMI; open recruitment (Rencang Night) |
| **Unggulan** | Program isu sosial: GEDURASI (literasi, Desa Serdang Wetan), SENTERA (dukungan pejuang kanker anak bersama YKAI), pengabdian desa binaan (mis. MCU & seminar di Desa Ciakar) |
| **Keakraban** | Malam Keakraban, Anniversary, I Care For You, Curhat Bareng, Piknik Bareng |
| **Insidental** | Rencang Cepat Tanggap (RCT): penggalangan donasi bencana di 6 wilayah selama Gen XIII |

Website `rencang.umn.ac.id` dibangun pada Februari 2022 oleh Generasi XIII/XIV. Pada 27 Oktober 2026, IT Infrastructure UMN menaikkan versi PHP server ke 8.2+ karena celah keamanan (CVE). Website ditutup dari akses publik sampai kodenya disesuaikan, dengan ancaman *suspend* jika tidak ada respons dalam satu minggu.

## 2. Masalah yang diselesaikan

1. **(Mendesak)** Website tidak bisa diakses karena tidak kompatibel dengan PHP 8.2+.
2. Calon anggota, mitra, dan masyarakat butuh satu sumber resmi untuk tahu *siapa Rencang* dan *apa yang sudah dilakukan*.
3. Event butuh kanal untuk mengumumkan pendaftaran (contoh: CARITAS 2022 dengan countdown dan tombol Daftar).
4. Rencang butuh portofolio kegiatan sebagai bukti kredibilitas untuk mitra, sponsor, dan pihak kampus.

## 3. Tujuan dan non-tujuan

### Tujuan
| ID | Tujuan | Ukuran keberhasilan |
|---|---|---|
| G1 | Website kembali online dan lolos syarat IT UMN | Akses publik dibuka kembali oleh IT; tidak di-*suspend* |
| G2 | Fondasi teknis yang didukung vendor | Framework dan PHP masih menerima security update minimal 12 bulan ke depan |
| G3 | Konten mencerminkan Rencang saat ini | Tidak ada event kedaluwarsa di beranda; footer dan generasi terbaru |
| G4 | Mudah dirawat pengurus berikutnya | Pengurus non-programmer bisa menambah event tanpa menyentuh logika (target fase 2) |

### Non-tujuan (fase ini)
- Sistem login, keanggotaan, atau dashboard admin penuh.
- Form pendaftaran internal (tetap memakai Google Form/bit.ly).
- Redesign visual total. Identitas visual saat ini dipertahankan.
- Fitur Articles dan Our Family (tetap "Coming Soon" sampai ada konten).

## 4. Stakeholder dan pengguna

| Stakeholder | Kepentingan |
|---|---|
| **BPH / Pengurus Rencang** | Pemilik produk; butuh website hidup dan mudah diperbarui |
| **IT Infrastructure UMN** | Pemilik server; butuh aplikasi aman dan kompatibel PHP terbaru |
| **Kemahasiswaan / DKBM UMN** | Pembina UKM; website sebagai representasi UKM |
| **Pengembang (anggota Rencang)** | Mengerjakan upgrade dan perawatan |

### Persona pengguna

| Persona | Kebutuhan | Halaman utama |
|---|---|---|
| **Maba / mahasiswa UMN calon anggota** | Kenal Rencang, lihat kegiatan, tahu kapan oprec | Home → Who We Are → What We Do → Event |
| **Peserta event** (mahasiswa/umum) | Info event berjalan dan tautan daftar | Home (banner event) |
| **Mitra / donatur / desa binaan / sponsor** | Bukti rekam jejak dan dokumentasi | Event → halaman detail program |
| **Alumni Rencang** | Nostalgia, ikut acara keakraban | Keakraban, Event |

## 5. Ruang lingkup produk (as-built)

### 5.1 Sitemap

```
/                          Home
├── /what-we-do            What We Do? (4 kategori + periode event)
│   └── /event             Event Generasi 13 & 14 (hub)
│       ├── /gedurasi                  GEDURASI (Unggulan)
│       ├── /sentera                   SENTERA (Unggulan)
│       ├── /sharing-caring-helping    SCH X (Tahunan, donor darah)
│       ├── /keakraban                 Program Keakraban
│       ├── /rencang-cepat-tanggap     RCT (Insidental)
│       └── (Rencang Night)            → popup "Coming Soon"
├── /who-we-are            Profile
├── /soon                  Our Family, Articles → "Coming Soon"
└── /*                     URL lain → redirect ke /
```

### 5.2 Kebutuhan fungsional (as-built)

| ID | Kebutuhan | Halaman | Status |
|---|---|---|---|
| F-01 | Navbar global: Home, What We Do?, logo tengah, Who We Are? (dropdown Profile/Our Family), Articles | Semua | ✅ Ada; Home tidak ditandai aktif |
| F-02 | Navbar *collapse* (hamburger) di layar < 992px | Semua | ✅ |
| F-03 | Footer: alamat UMN, tautan navigasi, 6 ikon sosmed (LINE, FB, Email, IG, X, YouTube) | Semua | ✅ Teks hak cipta masih "2020" |
| F-04 | Hero sapaan dengan teks berganti "Kawan/Teman/Sahabat" | Home | ✅ |
| F-05 | Banner event aktif: logo, nama, countdown, deskripsi, tombol **Daftar** ke form eksternal | Home | ⚠️ Hardcode CARITAS 2022; countdown sudah 00 |
| F-06 | Ringkasan "Apa itu Rencang?" + tombol Selengkapnya → Profile | Home | ✅ |
| F-07 | Profil, arti kata (kartu kamus interaktif), logo, tujuan, visi-misi, esensi | Who We Are | ✅ |
| F-08 | 4 kartu kategori kegiatan | What We Do | ✅ |
| F-09 | Daftar periode kepengurusan, klik → halaman event periode | What We Do | ⚠️ Hanya Gen 13 & 14 |
| F-10 | Hub event: tagline generasi, tab logo per event, deskripsi + View More | Event | ✅ |
| F-11 | Detail program: judul, tagline, kategori, tanggal, tujuan, deskripsi, dokumentasi foto (grid desktop / carousel mobile) | Gedurasi, Sentera, SCH, RCT | ✅ |
| F-12 | Detail keakraban: 5 sub-program | Keakraban | ✅ |
| F-13 | Halaman placeholder "Coming Soon" | Soon | ✅ |
| F-14 | URL tidak dikenal diarahkan ke beranda | Global | ✅ (lihat NFR-07) |

## 6. Kebutuhan fase upgrade (scope rilis berikutnya)

### 6.1 Wajib (P0): syarat dibuka kembali oleh IT

| ID | Kebutuhan | Kriteria penerimaan |
|---|---|---|
| U-01 | Aplikasi berjalan di versi PHP server UMN (≥ 8.2) | `composer install --no-dev` sukses di versi PHP server; semua 10 route membalas HTTP 200 tanpa error/deprecation di log |
| U-02 | Framework versi yang masih didukung keamanan | Versi Laravel ada di dalam jendela *security fixes* resmi saat rilis |
| U-03 | Paritas fungsional | Semua F-01 s.d. F-14 berperilaku sama seperti sebelum upgrade (cek manual per halaman, desktop dan mobile) |
| U-04 | Paritas visual | Tidak ada perbedaan tampilan yang terlihat dibanding versi lama pada lebar 375, 768, 1280 px |
| U-05 | Konfigurasi produksi aman | `APP_ENV=production`, `APP_DEBUG=false`, `APP_KEY` baru, `storage/` dan `bootstrap/cache/` writable |
| U-06 | Tidak membutuhkan database | Aplikasi jalan tanpa koneksi DB (session `file`/`array`) |
| U-07 | Dilaporkan ke IT | Email balasan ke IT Infrastructure dengan ringkasan perubahan dan versi PHP/Laravel |

### 6.2 Sebaiknya (P1): sekalian dikerjakan karena murah

| ID | Kebutuhan | Alasan |
|---|---|---|
| U-08 | Hapus jQuery UI (tidak dipakai, ada CVE) | Keamanan |
| U-09 | Hapus paket tak terpakai: Sanctum, Guzzle, laravel-cors | Keamanan dan ukuran |
| U-10 | Hapus route duplikat `/gedurasi`, file mati (`welcome`, `page/template`, `navbar.js`) | Kebersihan |
| U-11 | Perbaiki path gambar tanpa `asset()` di SCH | Ketahanan deploy |
| U-12 | Favicon valid (sekarang 0 byte), perbaiki `rel="shorcut icon"` | Branding |
| U-13 | Ganti banner CARITAS 2022 dengan banner event terkini **atau** sembunyikan otomatis bila tanggal lewat | Konten basi di halaman paling penting |
| U-14 | Footer: tahun hak cipta dinamis | Konten basi |

### 6.3 Nanti (P2): fase perawatan

| ID | Kebutuhan |
|---|---|
| R-01 | Pindahkan konten event (judul, tanggal, deskripsi, foto, tautan daftar) ke file data terstruktur (`config/events.php` atau JSON) supaya menambah event cukup edit data |
| R-02 | Halaman periode untuk generasi setelah XIV (Gen XV … sekarang) |
| R-03 | Isi Our Family (struktur pengurus) dan Articles, atau hapus menunya |
| R-04 | Halaman Rencang Night |
| R-05 | Kompres gambar (target < 300 KB per foto, WebP) dan `loading="lazy"` |
| R-06 | Halaman 404 yang layak, menggantikan redirect diam-diam ke beranda |
| R-07 | Perbaikan aksesibilitas (lihat DESIGN_SYSTEM §9) |
| R-08 | Meta SEO dan Open Graph (judul unik per halaman, deskripsi, gambar share) |

## 7. Kebutuhan non-fungsional

| ID | Kategori | Kebutuhan |
|---|---|---|
| NFR-01 | Kompatibilitas server | PHP ≥ 8.2 sesuai server UMN; Apache + mod_rewrite; document root `public/` |
| NFR-02 | Keamanan | Framework dalam masa dukungan keamanan; tidak ada library frontend dengan CVE yang diketahui; debug mati di produksi |
| NFR-03 | Kinerja | Beranda < 3 MB transfer pada kunjungan pertama (fase P2; sekarang jauh di atas itu karena gambar besar) |
| NFR-04 | Responsif | Layout layak dari 320 px sampai 1440 px+ |
| NFR-05 | Browser | 2 versi terakhir Chrome, Edge, Firefox, Safari, Chrome Android, Safari iOS |
| NFR-06 | Aksesibilitas | Target WCAG 2.1 AA untuk komponen baru; perbaikan bertahap untuk yang lama |
| NFR-07 | Observabilitas | Error tercatat di `storage/logs`; URL rusak semestinya 404, bukan redirect diam-diam (P2) |
| NFR-08 | Maintainability | README berisi cara setup lokal, cara deploy, dan cara menambah event |
| NFR-09 | Lisensi aset | Font dan gambar boleh dipakai untuk situs publik organisasi (lihat catatan MADE TOMMY "PERSONAL USE" di DESIGN_SYSTEM §3.3) |

## 8. Asumsi dan ketergantungan

- Server tetap dikelola IT UMN; tim Rencang hanya mengunggah kode.
- Form pendaftaran tetap di layanan eksternal (Google Form via bit.ly).
- Repo GitHub `FelicianoSurya/Rencang-2022` adalah sumber kebenaran. **Perlu dikonfirmasi** bahwa versi di server tidak berbeda.
- Pemilik repo (FelicianoSurya) memberi akses collaborator, atau tim memakai fork.

## 9. Risiko

| Risiko | Dampak | Mitigasi |
|---|---|---|
| Tenggat IT (±3 Nov 2026) terlewat → situs di-*suspend* | Tinggi | Balas email IT hari ini dengan rencana dan estimasi; minta perpanjangan bila perlu |
| Versi di server ≠ versi di GitHub | Sedang | Minta salinan file server ke IT sebelum deploy, lalu bandingkan |
| Tidak ada akses SSH/composer di server | Sedang | Build `vendor/` di lokal dengan versi PHP yang sama, unggah lengkap |
| Pengetahuan teknis hilang tiap pergantian generasi | Tinggi (jangka panjang) | README + dokumen ini + konten berbasis data (R-01) |
| Font berlisensi personal dipakai publik | Rendah–sedang | Ganti atau beli lisensi (lihat DESIGN_SYSTEM) |

## 10. Rencana rilis

| Fase | Isi | Target |
|---|---|---|
| **0: Darurat** | Balas email IT; konfirmasi versi PHP dan cara deploy | Segera |
| **1: Upgrade (P0 + P1)** | Migrasi ke Laravel yang didukung, bersih-bersih, konten basi minimal, deploy, lapor IT | Secepatnya setelah fase 0 |
| **2: Perawatan (P2)** | Konten berbasis data, generasi terbaru, optimasi gambar, aksesibilitas, SEO | Satu periode kepengurusan |

## 11. Pertanyaan terbuka

1. Event apa yang harus tampil di banner beranda sekarang? Atau banner disembunyikan saja?
2. Generasi keberapa kepengurusan sekarang, dan apakah halaman event Gen 13 & 14 tetap dipertahankan sebagai arsip?
3. Apakah akun sosmed di footer (LINE `@blv8312x`, FB, X/Twitter, YouTube) masih aktif dan dikelola?
4. Siapa PIC website setelah upgrade ini selesai?
