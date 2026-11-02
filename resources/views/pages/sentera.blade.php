@extends('layouts.app')

@section('custom-css')
    <link rel="stylesheet" href="{{ asset('css/sentera/Sentera.css') }}">
@endsection

@section('content')
    <div class="content">
        <div class="container-full">
            <div class="section-one">
                <img src="{{ asset('images/sentera/title1fix.png') }}" alt="buku">
            </div>
            <div class="section-two">
                <div class="program">
                    <p>Program Unggulan</p>
                    <p>10/04/2021</p>
                </div>
                <div class="row content-section-two bagian1">
                    <div class="col-12 title">
                        <h1>SenyumMu Lentera HarapanKu</h1>
                    </div>
                    <div class="image">
                        <img src="{{ asset('images/sentera/logo.png') }}" alt="logo">
                    </div>
                    <div class="information">
                        <p class="tujuan">Tujuan Sentera</p>
                        <p class="desc">Support adalah faktor terpenting untuk membangun semangat mereka dalam proses penyembuhan. 
                            Acara Setetes Harapan ini mengajak anggota Rencang untuk menunjukkan dukungan mereka terhadap pejuang 
                            kanker. Meskipun pandemi covid-19 membuat bentuk support tidak dapat dilakukan secara tatap muka, 
                            tetapi perkembangan teknologi akan membantu acara ini tetap berjalan dengan sebaik mungkin.</p>
                    </div>
                </div>
            </div>
            <div class="content-three">
                <div class="content-section-two bagian2"> 
                    <div class="image">
                        <img src="{{ asset('images/sentera/img_content_3.png') }}" alt="bukti">
                    </div>
                    <div class="information">
                        <p class="tujuan">Sentera</p>
                        <p class="desc">Maka dari itu, tema yang diangkat pada acara Setetes Harapan ini adalah “Sentera” 
                            kepanjangan dari “Senyummu Lentera Harapanku”. Dalam acara ini, UKM Sosial Rencang bekerja sama 
                            dengan Yayasan Kanker Anak Indonesia. Acara ini berupa dinamika kelompok yang dilaksanakan pada 
                            Minggu, 10 April 2021 melalui aplikasi ZOOM untuk mendukung terlaksananya secara daring. Anggota 
                            Rencang berinteraksi secara aktif bersama anak-anak dari Yayasan Kasih Anak Kanker.</p>
                    </div>
                </div>
            </div>
            <div class="content-four">
                <p class="dokumentasi">Dokumentasi</p>
                <div class="gallery">
                    <div class="row">
                        <img src="{{ asset('images/sentera/1.png') }}" alt="bukti">
                        <img src="{{ asset('images/sentera/2.png') }}" alt="bukti">
                        <img src="{{ asset('images/sentera/3.png') }}" alt="bukti">
                    </div>
                    <div class="row">
                        <img src="{{ asset('images/sentera/4.png') }}" alt="bukti">
                        <img src="{{ asset('images/sentera/5.png') }}" alt="bukti">
                        <img src="{{ asset('images/sentera/6.png') }}" alt="bukti">
                    </div>
                </div>
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                        <img class="d-block w-100" src="{{ asset('images/sentera/5.png') }}" alt="First slide">
                        </div>
                        <div class="carousel-item">
                        <img class="d-block w-100" src="{{ asset('images/sentera/6.png') }}" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                        <img class="d-block w-100" src="{{ asset('images/sentera/4.png') }}" alt="Third slide">
                        </div>
                        <div class="carousel-item">
                        <img class="d-block w-100" src="{{ asset('images/sentera/1.png') }}" alt="Fourth slide">
                        </div>
                        <div class="carousel-item">
                        <img class="d-block w-100" src="{{ asset('images/sentera/2.png') }}" alt="Fifth slide">
                        </div>
                        <div class="carousel-item">
                        <img class="d-block w-100" src="{{ asset('images/sentera/3.png') }}" alt="sixth slide">
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