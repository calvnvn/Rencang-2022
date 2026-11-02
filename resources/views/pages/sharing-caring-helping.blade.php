@extends('layouts.app')

@section('custom-css')
    <link rel="stylesheet" href="{{ asset('css/sch/sch.css') }}">
@endsection

@section('content')
    <div class="section">
        <div class="section-1">
            <img src="{{ asset('images/SCH/head.png') }}" alt="cover_foto">
            <h1 class="name">Sharing, Caring, Helping X</h1>
            <p class="tagline">(Blood Donation)</p>
            <img class="burung_kiri" src="{{ asset('images/SCH/burung_kiri.png') }}" alt="">
            <img class="burung_kanan" src="{{ asset('images/SCH/burung_kanan.png') }}" alt="">
            <img class="blood_kanan" src="{{ asset('images/SCH/blood_kanan.png') }}" alt="">
        </div>
        <h1 class="program">Program Rutin</h1>
        <div class="section-2 konten-1">
            <div class="image">
                <img src="{{ asset('images/SCH/body_1.png') }}" alt="logo">
            </div>
            <div class="information">
                <h1 class="tujuan">Tujuan SCH</h1>
                <p class="desc">UKM Sosial Rencang mengadakan kegiatan campaign online donor darah 
                    Sharing, Caring, Helping X. Kegiatan ini bertujuan untuk memberikan awareness masyarakat 
                    khususnya milenial dan gen Z pentingnya donor darah. Melalui kegiatan Sharing, Caring, Helping X 
                    diharapkan masyarakat kalangan milenial dan gen Z dapat menumbuhkan semangat berbagi, lebih peduli 
                    dan peka terhadap sesama, dan membangkitkan jiwa kemanusiaan.</p>
            </div>
        </div>
        <div class="section-2 margin konten-2">
            <div class="image">
                <img class="blood_kiri" src="{{ asset('images/SCH/blood_kiri.png') }}" alt="">
                <img class="img" src="{{ asset('images/SCH/body_2.png') }}" alt="logo">
            </div>
            <div class="information">
                <h1 class="tujuan">Donor Darah</h1>
                <p class="desc">Kekurangan darah dalam tubuh akan sangat mempengaruhi kondisi tubuh seseorang. 
                    Jika tubuh seseorang tidak memiliki pasokan darah yang cukup seseorang mungkin saja 
                    menyebabkan penyakit seperti anemia, hipotensi, dan gangguan organ jantung yang bahkan 
                    dapat menyebabkan kematian. </p>
            </div>
        </div>
        <div class="content-four">
            <p class="dokumentasi">Dokumentasi</p>
            <div class="gallery">
                <div class="row fotoatas">
                    <img src="{{ asset('images/SCH/1.jpg') }}" alt="bukti">
                    <img src="{{ asset('images/SCH/2.jpg') }}" alt="bukti">
                    <img src="{{ asset('images/SCH/3.jpg') }}" alt="bukti">
                    <img style="margin-right: 0px" src="{{ asset('images/SCH/4.jpg') }}" alt="bukti">
                </div>
                <div class="row fotobawah">
                    <img src="{{ asset('images/SCH/5.jpg') }}" alt="bukti">
                    <img src="{{ asset('images/SCH/6.jpg') }}" alt="bukti">
                    <img src="{{ asset('images/SCH/7.jpg') }}" alt="bukti">
                    <img style="margin-right: 0px" src="{{ asset('images/SCH/8.jpg') }}" alt="bukti">
                </div>
            </div>
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                        <img class="d-block w-100" src="{{ asset('images/SCH/1.jpg') }}" alt="First slide">
                        </div>
                        <div class="carousel-item">
                        <img class="d-block w-100" src="{{ asset('images/SCH/2.jpg') }}" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                        <img class="d-block w-100" src="{{ asset('images/SCH/3.jpg') }}" alt="Third slide">
                        </div>
                        <div class="carousel-item">
                        <img class="d-block w-100" src="{{ asset('images/SCH/4.jpg') }}" alt="Fourth slide">
                        </div>
                        <div class="carousel-item">
                        <img class="d-block w-100" src="{{ asset('images/SCH/5.jpg') }}" alt="Fifth slide">
                        </div>
                        <div class="carousel-item">
                        <img class="d-block w-100" src="{{ asset('images/SCH/6.jpg') }}" alt="sixth slide">
                        </div>
                        <div class="carousel-item">
                        <img class="d-block w-100" src="{{ asset('images/SCH/7.jpg') }}" alt="seventh slide">
                        </div>
                        <div class="carousel-item">
                        <img class="d-block w-100" src="{{ asset('images/SCH/8.jpg') }}" alt="eighth slide">
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