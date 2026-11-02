@extends('layouts.app')

@section('custom-css')
    <link rel="stylesheet" href="{{ asset('css/gedurasi/gedurasi.css') }}">
@endsection

@section('content')
    <div class="content">
        <div class="container-full">
            <div class="section-one">
                <img src="{{ asset('images/Gedurasi/Buku.png') }}" alt="buku">
                <p class="name">GEDURASI</p>
                <p class="tagline">#Read, Lead, Inspire</p>
            </div>
            <div class="section-two">
                <div class="program">
                    <p class="program-unggulan">Program Unggulan</p>
                    <p>17/02/2021</p>
                </div>
                <div class="content-section-two">
                    <div class="image">
                        <img src="{{ asset('images/Gedurasi/logo.png') }}" alt="logo">
                    </div>
                    <div class="information">
                        <p class="tujuan">Tujuan Gedurasi</p>
                        <p class="desc">Gerakan Peduli Literasi dengan tagline read, lead, inspire yang dilakukan dengan mengadakan 
                            seminar & talkshow yang dibuka secara umum dengan membahas pentingnya meningkatkan literasi pada 
                            generasi saat ini. Selanjutnya, acara ini juga mengadakan kegiatan untuk memperluas akses literasi bagi 
                            masyarakat Desa Serdang Wetan dengan cara menyalurkan buku-buku yang masih layak pakai sehingga 
                            dapat menjadi sumber bacaan bagi masyarakat Desa Serdang Wetan</p>
                    </div>
                </div>
            </div>
            <div class="content-three">
                <div class="content-section-two">
                    <div class="image">
                        <img src="{{ asset('images/Gedurasi/bukti.png') }}" alt="bukti">
                    </div>
                    <div class="information">
                        <p class="tujuan">Serdang Wetan</p>
                        <p class="desc">Acara ini diselenggarakan di aplikasi ZOOM pada tanggal 17 Febuari 2021 yang berupa seminar 
                            & talk show dan pada 27 Febuari 2021 diadakan kunjungan ke Desa Serdang Waten untuk melakukan penyerahan
                            buku yang sudah dikumpulkan. Pemberian buku ini diharapkan dapat meningkatan kesadaran masyarakat mengenai 
                            entingnya membaca buku pada pihak internal maupun pihak eksternal Universitas Multimedia Nusantara.</p>
                    </div>
                </div>
            </div>
            <div class="content-four">
                <p class="dokumentasi">Dokumentasi</p>
                <div class="gallery">
                    <div class="row">
                        <img src="{{ asset('images/Gedurasi/5.jpg') }}" alt="bukti">
                        <img src="{{ asset('images/Gedurasi/6.jpg') }}" alt="bukti">
                        <img src="{{ asset('images/Gedurasi/4.jpg') }}" alt="bukti">
                    </div>
                    <div class="row">
                        <img src="{{ asset('images/Gedurasi/1.jpg') }}" alt="bukti">
                        <img src="{{ asset('images/Gedurasi/2.jpg') }}" alt="bukti">
                        <img src="{{ asset('images/Gedurasi/3.jpg') }}" alt="bukti">
                    </div>
                </div>
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                        <img class="d-block w-100" src="{{ asset('images/Gedurasi/5.jpg') }}" alt="First slide">
                        </div>
                        <div class="carousel-item">
                        <img class="d-block w-100" src="{{ asset('images/Gedurasi/6.jpg') }}" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                        <img class="d-block w-100" src="{{ asset('images/Gedurasi/4.jpg') }}" alt="Third slide">
                        </div>
                        <div class="carousel-item">
                        <img class="d-block w-100" src="{{ asset('images/Gedurasi/1.jpg') }}" alt="Fourth slide">
                        </div>
                        <div class="carousel-item">
                        <img class="d-block w-100" src="{{ asset('images/Gedurasi/2.jpg') }}" alt="Fifth slide">
                        </div>
                        <div class="carousel-item">
                        <img class="d-block w-100" src="{{ asset('images/Gedurasi/3.jpg') }}" alt="sixth slide">
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
    </div>
@endsection

@section('custom-js')
    
@endsection