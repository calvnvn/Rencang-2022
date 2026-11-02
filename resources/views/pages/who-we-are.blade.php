@extends('layouts.app')

@section('custom-css')
    <link rel="stylesheet" href="{{ asset('css/whoweare/whoweare.css') }}">
@endsection

@section('content')
    <section>
        <div class="banner">
            <div class="wrapper-banner">
                <img class="absolute-image" src="{{ asset('images/who-we-are/profile-img.jpg') }}" alt="profile">
                <!-- <div class="black"></div> -->
                <img class="img" src="{{ asset('images/who-we-are/header.png') }}" alt="whoweare">
            </div>
        </div>
        <div class="pattern-wrapper">
        <img src="{{ asset('images/public/left-pattern.png') }}" class="pattern-absolute hide left" >
        <img src="{{ asset('images/public/right-bottom-pattern.png') }}" class="pattern-absolute hide bottom" >
        <img src="{{ asset('images/public/right-top-pattern.png') }}" class="pattern-absolute hide top" >
        
        <div class="section-profile">
            <div class="wrapper-profile">
                <div class="profile-left col-full">
                    <h1 class="red">Profile Rencang</h1>
                    <p>Rencang merupakan sebuah komunitas sosial yang berdiri di bawah naungan <span class="green">Universitas Multimedia Nusantara (UMN).</span>
                    Komunitas ini pertama kali didirikan pada tanggal 23 September 2007 oleh 4 mahasiswa UMN angkatan 2007 dan 2008 
                    yaitu: <span class="orange">Raden Bagus Yosep Raharjo Sumanto, Ciptoning Hestomo, Beno Sanjaya, dan Samuel Adhi Rinadi. </span> Awal berdirinya 
                    komunitas ini bukanlah sebagai sekedar komunitas sosial saja, melainkan diawali oleh komunias sosial yang bergerak 
                    di bidang otomotif bersama Sosial Otomotif Multimedia (SOM). Seiring berjalannya waktu. SOM mengalami perubahan menjadi
                    <span class="green">komunitas yang fokus di bidang sosial yang dinamakan Rencang.</span></p>
                </div>
                <div class="profile-right hide">
                    <img src="{{ asset('images/who-we-are/1-02.png') }}" alt="profile-right">
                </div>
            </div>
        </div>
        <div class="section-profile">
            <div class="wrapper-profile">
                <div class="profile-right row col-full">
                    <div class="col-lg-9 col-sm-10">
	 			        <div class="col-12" style=" background-color: #F7DF6D; border-radius: 15px;padding: 10px;">
                            <div class="row" style="margin: 0px; padding: 0px;">
                                <div class="col-4" style="margin-top:10px; ">
                                    <img src="{{ asset('images/who-we-are/kamus-02.png') }}" class="kamusPintar" width="100%" >
                                </div>
                                
                                <div class="col-8" style="padding: 0px;">
                                    <p class="red fz-big stylemerri m-0" style="font-size: 2vw; font-weight: bold;padding: 0px; ">
                                        Arti Kata
                                    </p>
                                    <p class="green fz-big stylemerri" style="font-weight: bold; font-size:3vw;font-style: italic;justify-content: left;margin-top:0px;padding: 0px;">
                                        Rencang
                                    </p>
                                </div>
                            </div>
                            <strong class="green stylemerri" style="margin-left:15px;">
                                Bahasa Jawa
                            </strong>
                            <div class="row col-11 br7" style="margin-left:15px;  background-color: white;">
                                <div class="col-10" style=" font-weight: bold; padding: 3%;border-radius: 7px;">
                                    Rencang <span id="textBar">|</span>
                                    
                                </div>
                                <div class="col-2 enter" style="padding: 2px 2px 2px 2px; background-color: #2e9976; margin-top: 4px; margin-bottom: 4px; border-radius: 7px;display:flex;justify-content:center;" onclick="translateJawa();">
                                        <img src="{{ asset('images/who-we-are/enter-02.png') }}" style="width: 30%; object-fit: contain">
                                </div>
                            </div>
                            <strong  class="green stylemerri" style=" margin-top: 1%; margin-left:15px;">
                                Bahasa Indonesia
                            </strong>
                            <div class="col-11 br7" style="text-align: left; background-color: white; padding: 4%; margin-left:15px;margin-bottom: 10px;">
                                <div id="translateIndo" style="visibility: hidden">
                                    <strong>Sahabat</strong>
                                    <div style="
                                    /*color: #f6a801*/
                                    ">
                                        /sa.ha.bat
                                    </div>
                                    <div style="
                                    /*color: #00a2ad; */
                                    font-style: italic">
                                        n
                                    </div>
                                    <div>
                                        1. orang yang bersama-sama bekerja
                                        (berbuat, berjalan)
                                    </div>
                                </div>
	                        </div>
           		        </div>
 			        </div>
                </div>
                <div class="profile-left col-full m-mobile">
                    <h1 class="red">Logo Rencang</h1>
                    <p>Logo Rencang merupakan <span class="orange">Anjing Siberian Husky.</span> si sahabat manusia. Pemilihan 
                    logo ini dipilih dengan alasan untuk menunjukan kesetiaan Rencang kepada masyarakat dan juga menggambarkan 
                    kehangatan sebagai keluarga.</p>
                    <div class="wrapper-image-logo">
                        <img src="{{ asset('images/who-we-are/2-02.png') }}" alt="image-logo">
                    </div>
                </div>
            </div>
        </div>
        <div class="section-profile m-50 m-bot-none">
            <div class="wrapper-information">
                <div class="profile-left border-right col-full">
                    <h1 class="red tujuan">Tujuan Rencang</h1>
                    <div class="wrapper-tujuan">
                        <div>
                            <p>Membantu sesama yang membutuhkan dalam bidang materi ataupun non-materi.</p>
                        </div>
                        <div>
                            <img src="{{ asset('images/who-we-are/tujuan2-02.png') }}" alt="tujuan_1">
                        </div>
                    </div>
                    <div class="wrapper-tujuan">
                        <div>
                            <p>Mempererat persatuan dan mempertebal rasa kekeluargaan pada anggotanya.</p>
                        </div>
                        <div>
                            <img src="{{ asset('images/who-we-are/tujuan1-02.png') }}" alt="tujuan_1">
                        </div>
                    </div>
                    <div class="wrapper-tujuan">
                        <div>
                            <p>Memaksimalkan potensi setiap anggota.</p>
                        </div>
                        <div>
                            <img src="{{ asset('images/who-we-are/tujuan3-02.png') }}" alt="tujuan_1">
                        </div>
                    </div>
                </div>
                <div class="information-right col-full m-mobile">
                <h1 class="red tujuan">Visi Misi Rencang</h1>
                    <div class="wrapper-visi">
                        <h5 class="green">Visi</h5>
                        <p>Menjadi Organisasi Sosial Unggul yang berbasis ICT di regional, nasional, dan internasional.</p>
                    </div>
                    <div class="wrapper-visi">
                        <h5 class="green">Misi</h5>
                        <ul>
                            <li>Mensejahterakan masyarakat di lingkungan kampus UMN.</li>
                            <li>Memiliki dan menanamkan rasa solidaritas kepada saudara sebangsa dan setanah air.</li>
                            <li>Ikut berperan aktif dalam menyuarakan isu-isu internasional baik lingkungan maupun kemanusiaan.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="section-profile m-50">
            <div class="wrapper-profile">
                <div class="profile-right col-full">
                    <div class="wrapper-image-bot">
                        <img class="absolute-image bot" src="{{ asset('images/who-we-are/profile-img.jpg') }}" alt="profile">
                        <img class="frame" src="{{ asset('images/who-we-are/Frame-Kecil_oren.png') }}" alt="profile-right">
                    </div>
                </div>
                <div class="profile-left col-full m-mobile">
                    <h1 class="red">Esensi Rencang</h1>
                    <ul class="esensi">
                        <li>Memeluk yang lemah dan terluka</li>
                        <li>Merangkul yang disingkirkan dan terpinggirkan</li>
                        <li>Menjadi sahabat yang dibutuhkan secara psikis dan fisik</li>
                        <li>Siap berbagi tanpa batas waktu dalam kesederhanaan</li>
                    </ul>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection

@section('custom-js')
    <script>
        $(document).ready(function(){
            showTextBar();
        });

        function showTextBar(){
            $('#textBar').show();
            setTimeout(hideTextBar, 600);
        }

        function hideTextBar(){
            $('#textBar').hide();
            setTimeout(showTextBar, 600);
        }

        function translateJawa(){
            $('#translateIndo').hide().css("visibility","visible").fadeIn('fast');
        }
    </script>
@endsection