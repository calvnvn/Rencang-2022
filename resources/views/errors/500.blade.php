@extends('errors.rencang')

@section('title', 'Terjadi kesalahan')

@section('body')
    <p class="error-code">500</p>
    <h1>Terjadi kesalahan di server</h1>
    <p>Maaf, ada masalah di pihak kami. Silakan coba lagi beberapa saat lagi. Bila masalah berlanjut, kabari kami di {{ config('rencang.email') }}.</p>
    <div class="error-actions">
        <a href="{{ url('/') }}">Kembali ke Beranda</a>
    </div>
@endsection
