<?php

/*
|--------------------------------------------------------------------------
| Konfigurasi Konten Rencang
|--------------------------------------------------------------------------
|
| Data organisasi yang dipakai di beberapa halaman. Ubah nilai di sini,
| bukan di file Blade, supaya cukup diganti di satu tempat.
|
*/

return [

    'name' => 'Rencang',

    'founded_year' => 2007,

    'email' => 'rencang@umn.ac.id',

    /*
    | Banner event di beranda. Banner hanya tampil sampai "ends_at"
    | dengan format "YYYY-MM-DD HH:MM:SS" (waktu Asia/Jakarta).
    | Setelah lewat, banner dan countdown otomatis disembunyikan.
    | Format yang salah membuat banner tidak tampil sama sekali.
    | Isi teks banner masih ada di resources/views/pages/home.blade.php.
    */
    'event_banner' => [
        'name' => 'CARITAS',
        'ends_at' => '2022-02-24 18:00:00',
        'registration_url' => 'https://bit.ly/PendaftaranSeminarCaritas',
    ],

];
