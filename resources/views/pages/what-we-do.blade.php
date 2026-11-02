@extends('layouts.app')

@section('custom-css')
    <link rel="stylesheet" href="{{ asset('css/what-we-do/WhatWeDo.css') }}">
@endsection

@section('content')
    <!-- Header Photo -->
    <div class="container-fluid flex-container align-center">
        <div class="col-sm-10">
            <img class="top-layer img-fluid" src="{{ asset('images/what-we-do/frame.png') }}" alt="Frame" style="height: 110%;">
            <div class="col-sm-12 flex-container align-center">
                <div class="col-sm-10">
                    <img class="img-fluid" src="{{ asset('images/what-we-do/picture.JPG') }}" alt="Picture">
                </div>
                <div class="col-sm-10 color-overlay"></div>
            </div>
            <!-- Right Bird -->
            <div class="col-sm-12 top2-layer text-right">
                <img src="{{ asset('images/public/right-bird.png') }}" alt="Right Bird">      
            </div>
        </div>
    </div>


    <!-- Informasi Event -->
    <div class="container-fluid flex-container align-center mt-5 pt-5">
        <!-- Left Bird -->
        <div class="col-sm-10 absolute-layer pl-0">
            <img src="{{ asset('images/public/left-bird.png') }}" alt="Left Bird">      
        </div>

        <!-- Right Top Pattern -->
        <div class="col-sm-12 absolute-layer text-right pt-5 pr-2">
            <img src="{{ asset('images/public/right-top-pattern.png') }}" alt="Right Top Pattern" style="transform: scale(1.2);">      
        </div>
        
        <div class="container row b">

        <!-- Card Tahunan -->
        <div class="col-lg-3 col-sm-6 card-event">
            <div class="card-img-top flex-container align-center top-layer pr-4">
                <div class="bg-img-event p-5">
                    <img class="img-fluid" src="{{ asset('images/what-we-do/tahunan.png') }}" alt="Tahunan Logo">
                </div>
            </div>
            <div class="bg-card shadow">
                <div class="card-title text-center pt-5 mt-3 mb-2">
                    Tahunan
                </div>
                <div class="card-body pt-0">
                    <p class="card-text text-center">Kegiatan rutin yang menyesuaikan keperluan setiap tahunnya, seperti kegiatan donor darah atau kegiatan open recruitment bagi <b>#SahabatRencang</b> yang ingin bergabung menjadi anggota Rencang</p>
                </div>
            </div>
        </div>

        <!-- Card Unggulan -->
        <div class="col-lg-3 col-sm-6 card-event">
            <div class="card-img-top flex-container align-center top-layer pr-4">
                <div class="bg-img-event p-5">
                    <img class="img-fluid" src="{{ asset('images/what-we-do/unggulan.png') }}" alt="Unggulan Logo">
                </div>
            </div>
            <div class="bg-card shadow">
                <div class="card-title text-center pt-5 mt-3 mb-2">
                    Unggulan
                </div>
                <div class="card-body pt-0">
                    <p class="card-text text-center">Kegiatan yang dirancang mengenai isu sosial yang sedang terjadi di masyarakat. Rencang terus memperbarui kegiatan unggulan agar tetap efektif untuk membantu masyarakat di lingkungan sekitar</p>
                </div>
            </div>
        </div>

        <!-- Card Keakraban -->
        <div class="col-lg-3 col-sm-6 card-event a">
            <div class="card-img-top flex-container align-center top-layer pr-4">
                <div class="bg-img-event p-5 mt-2">
                    <img class="img-fluid" src="{{ asset('images/what-we-do/keakraban.png') }}" alt="Keakraban Logo">
                </div>
            </div>
            <div class="bg-card shadow">
                <div class="card-title text-center pt-5 mt-3 mb-2">
                    Keakraban
                </div>
                <div class="card-body pt-0">
                    <p class="card-text text-center">Kegiatan untuk mempererat kekeluargaan sesama anggota Rencang, seperti olahraga bersama atau malam keakraban. Para alumni Rencang dapat mengikuti kegiatan ini agar dapat saling mengenal satu sama lain</p>
                </div>
            </div>
        </div>

        <!-- Card Insidental -->
        <div class="col-lg-3 col-sm-6 card-event a">
            <div class="card-img-top flex-container align-center top-layer pr-4">
                <div class="bg-img-event" style="padding: 2.5rem;">
                    <img class="img-fluid" src="{{ asset('images/what-we-do/insidental.png') }}" alt="Insidental Logo">
                </div>
            </div>
            <div class="bg-card shadow">
                <div class="card-title text-center pt-5 mt-3 mb-2">
                    Insidental
                </div>
                <div class="card-body pt-0">
                    <p class="card-text text-center">Kegiatan yang dilakukan berdasarkan saran dari anggota Rencang untuk memenuhi kebutuhan yang terjadi secara mendadak, seperti bantuan bencana alam, bantuan pemulihan orang yang sakit, dan lain sebagainya</p>
                </div>
            </div>
        </div>

        </div>
    </div>

    <div class="container-fluid">
        <!-- Left Pattern -->
        <div class="col-sm-12 text-center header-text mt-5 pt-5">
            Periode Event
        </div>
    </div>
    

    <!-- Periode Event -->
    <div class="container-fluid test align-center">
        <!-- Right Bottom Pattern -->

        <!-- Card Periode Event -->
        <div class="container row c">

            <div id="14" class="col-lg-12 col-sm-12 card-periode">
                <div class="bg-img-periode top-layer">
                    <img class="img-fluid" src="{{ asset('images/what-we-do/gen-13.png') }}" style="transform: scale(1.2);">
                </div>
                <div class="col-sm-10 card bg-card-periode shadow-lg">
                    <div class="card-title card-title-periode">
                        Spread The Light Make A Change 
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-js')
    <script>
        $('#14').click(function() {
            window.location = "{{ route('event') }}";
        });
    </script>
@endsection