@extends('layouts.app')

@section('custom-css')
    <link rel="stylesheet" href="{{ asset('css/RCT/rct.css') }}">
@endsection

@section('content')
    <div class="section">
        <div class="section-1">
            <img src="{{ asset('images/RCT/Asset/1.png') }}" alt="cover_foto">
            <h1 class="name">Rencang Cepat Tanggap</h1>
            <p class="tagline">#Peduli</p>
        </div>
        <h1 class="program">Program Insendental</h1>
        <div class="section-2">
            <div class="image">
                <img src="{{ asset('images/RCT/Asset/Logo_RCT.png') }}" alt="logo">
            </div>
            <div class="information">
                <h1 class="tujuan">Tujuan RCT</h1>
                <p class="desc">Rencang Cepat Tanggap adalah program yang bertujuan untuk memberikan bantuan pada hal-hal yang memiliki urgensi dalam bentuk 
                    apapun yang bersifat situasional, baik materi, uang, tenaga, dan lain-lain, kepada korban bencana. Pemberian bantuan 
                    didasarkan pada pertimbangan apa yang benar-benar dibutuhkan korban.</p>
            </div>
        </div>
        <div class="section-2 margin">
            <div class="image">
                <img class="img" src="{{ asset('images/RCT/Asset/2.png') }}" alt="logo">
            </div>
            <div class="information">
                <h1 class="tujuan">Kontribusi Kami</h1>
                <p class="desc">Di bawah kepimpinan Generasi XIII Rencang Cepat Tanggap telah memberikan bantuan ke beberapa daerah 
                    yang tertimpa musibah. Dimulai dari awal kepimpinan Generasi XIII, tercatat bahwa Rencang Cepat Tanggap telah 
                    menggalang dan menyalurkan donasi ke 6 wilayah di Indonesia dengan bekerja sama dengan organisasi lain, baik di 
                    dalam maupun di luar universitas. Wilayah yang dimaksud meliputi  Kalimantan Selatan, Sulawesi Barat, Indramayu, 
                    Bandung, NTT, dan juga NTB.</p>
            </div>
        </div>
        <div class="content-four">
            <p class="dokumentasi">Dokumentasi</p>
            <div class="gallery">
                <div class="row">
                    <img src="{{ asset('images/RCT/Asset/Foto 2/Kiri_Atas_Foto.png') }}" alt="bukti">
                    <img src="{{ asset('images/RCT/Asset/Foto 2/Tengah_Atas_Foto.png') }}" alt="bukti">
                    <img src="{{ asset('images/RCT/Asset/Foto 2/Kanan_Atas_Foto.png') }}" alt="bukti">
                </div>
                <div class="row">
                    <img src="{{ asset('images/RCT/Asset/Foto 2/Kiri_Bawah_Foto.png') }}" alt="bukti">
                    <img src="{{ asset('images/RCT/Asset/Foto 2/Tengah_Bawah_Foto.png') }}" alt="bukti">
                    <img src="{{ asset('images/RCT/Asset/Foto 2/Kanan_Bawah_Foto.png') }}" alt="bukti">
                </div>
            </div>
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                        <img class="d-block w-100" src="{{ asset('images/RCT/Asset/Foto 2/Kiri_Atas_Foto.png') }}" alt="First slide">
                        </div>
                        <div class="carousel-item">
                        <img class="d-block w-100" src="{{ asset('images/RCT/Asset/Foto 2/Tengah_Atas_Foto.png') }}" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                        <img class="d-block w-100" src="{{ asset('images/RCT/Asset/Foto 2/Kanan_Atas_Foto.png') }}" alt="Third slide">
                        </div>
                        <div class="carousel-item">
                        <img class="d-block w-100" src="{{ asset('images/RCT/Asset/Foto 2/Kiri_Bawah_Foto.png') }}" alt="Fourth slide">
                        </div>
                        <div class="carousel-item">
                        <img class="d-block w-100" src="{{ asset('images/RCT/Asset/Foto 2/Tengah_Bawah_Foto.png') }}" alt="Fifth slide">
                        </div>
                        <div class="carousel-item">
                        <img class="d-block w-100" src="{{ asset('images/RCT/Asset/Foto 2/Kanan_Bawah_Foto.png') }}" alt="sixth slide">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
        </div>
    </div>
@endsection

@section('custom-js')
    
@endsection