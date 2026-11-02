@extends('layouts.app', ['title' => 'Halaman tidak ditemukan - Rencang'])

@section('custom-css')
    <link rel="stylesheet" href="{{ asset('css/errors/errors.css') }}">
@endsection

@section('content')
    <main class="error-page">
        <p class="error-code">404</p>
        <h1>Halaman tidak ditemukan</h1>
        <p>Maaf, halaman yang kamu cari tidak ada atau sudah dipindahkan. Coba mulai lagi dari beranda atau lihat kegiatan Rencang.</p>
        <div class="error-actions">
            <a href="{{ route('home') }}">Kembali ke Beranda</a>
            <a class="secondary" href="{{ route('event') }}">Lihat Kegiatan</a>
        </div>
    </main>
@endsection
