@extends('layouts.app')

@php
    $banner = config('rencang.event_banner');
    $showBanner = \App\Support\EventBanner::isActive($banner['ends_at'] ?? null);
@endphp

@section('custom-css')
    <link rel="stylesheet" href="{{ asset('css/home/home3.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
@endsection

@section('content')
    <div class="content">
        <div class="content-1">
            <img class="pelangi" src="{{ asset('images/Homepage/pelangi-atas.png') }}" alt="pelangi">
            <div class="image-top">
                <img src="{{ asset('images/Homepage/imageHome.png') }}" class="image" alt="home">
                <img src="{{ asset('images/Homepage/Home.png') }}" class="frame" alt="frame">
            </div>
            <div class="information-right">
                <p>Halo,<br> <span id="typed">Sahabat</span></p>
                <p>Selamat datang di website <br> resmi komunitas sosial Rencang</p>
            </div>
        </div>    
        <div class="sun-image">
            <img src="{{ asset('images/Homepage/matahariBatas.png') }}" alt="sun">
            <img src="{{ asset('images/Homepage/buwong-2.png') }}" alt="bird">
        </div>
        <div class="information">
            <img class="gelombang1"  src="{{ asset('images/Homepage/Gelombang-Biru_Kanan_atas.png') }}" alt="gelombang1">
            <img class="gelombang2" src="{{ asset('images/Homepage/Gelombang-Biru_Kanan_bawah.png') }}" alt="gelombang2">
            <img class="gelombang3" src="{{ asset('images/Homepage/Gelombang-Biru_Kiri.png') }}" alt="gelombang3">
            @if ($showBanner)
            <div class="event">
                <div class="logo">
                    <div class="image">
                        <img class="logoPutih" src="{{ asset('images/caritas/Logo.png') }}" alt="Logo {{ $banner['name'] }}">
                    </div>
                </div>
                <div class="event-information">
                    <p>C A R I T A S</p>
                    <div class="time">
                        <div class="detail">
                            <p id="day"></p>
                            <p>DAYS</p>
                        </div>
                        <div class="detail">
                            <p id="hour"></p>
                            <p>HOURS</p>
                        </div>
                        <div class="detail">
                            <p id="minute"></p>
                            <p>MINUTES</p>
                        </div>
                        <div class="detail">
                            <p id="second"></p>
                            <p>SECONDS</p>
                        </div>
                    </div>
                    <p class="pendaftaran-topic">OPEN REGISTRATION</p>
                    <p class="desc">Hai Cangs, saat ini Rencang sedang membuka pendaftaran untuk webinar dan campaign Caritas loh!<br><br>
                        Caritas adalah singkatan dari Cahaya Solidaritas. Dengan adanya Caritas kami berharap seseorang dapat menjadi seorang senior 
                        yang bertanggung jawab dan peduli terhadap seniornya. Adapun rangkaian CARITAS terdiri dari webinar yang akan dilaksanakan 
                        pada tanggal 26 Februari 2022 kemudian akan dilanjutkan dengan pelaksanaan campaign mulai 27 Februari sampai 1 Maret 2022. 
                        Semoga webinar dan campaign yang dilakukan ini dapat berdampak luas bagi masyarakat!<br><br>
                        
						Semangat dan stay safe, Cangs!<br>
                        <b>- Light The Way for Tomorrow -</b>
                    </p>
                    <div class="button">
                        <a id="register-btn" class="btn-cta" href="{{ $banner['registration_url'] }}" target="_blank" rel="noopener noreferrer">Daftar</a>
                    </div>
                </div>
                <div>

                </div>
            </div>
            @endif
            <div class="event{{ $showBanner ? ' bot' : '' }}">
                <div class="logo">
                    <img class="logoTrans" src="{{ asset('images/logo.png') }}" alt="logo">
                </div>
                <div class="event-information introduce">
                    <div class="topic-intro">
                        <div class="apa">
                            <p>Apa itu <br>Rencang?</p>
                        </div>
                        <div class="image">
                            <img src="{{ asset('images/Homepage/renbow.png') }}" alt="ranbow">
                        </div>
                    </div>
                    <p class="desc-intro">Rencang merupakan sebuah komunitas sosial yang berdiri di bawah naungan Universitas Multimedia Nusantara 
                        (UMN). Komunitas ini pertama kali didirikan pada tanggal 23 September 2007 oleh 4 mahasiswa UMN angkatan 
                        2007 dan 2008 yaitu: Raden Bagus Yosep Raharjo Sumanto, Ciptoning Hestomo, Beno Sanjaya, dan Samuel Adhi
                        Rinadi.</p>  
                    <div class="btn-1"><button id="move-to-profile">Selengkapnya</button></div>                 
                </div>
            </div>
        </div>   
        <div class="content_bottom">
            <div class="gelombang_bawah">
                <img src="{{ asset('images/Homepage/Gelombang bawah_burung_awan.png') }}" alt="gelombang_bawah">
            </div>
            <div class="rumah">
                <img class="rumput" src="{{ asset('images/Homepage/Rumput-dibawah.png') }}" alt="rumput">
                <img src="{{ asset('images/Homepage/Rumah.png') }}" alt="rumah">
            </div>
        </div>
    </div>
@endsection

@section('custom-js')
<script>
    $('#move-to-profile').click(function() {
        if(this.id == "move-to-profile"){
            window.location = "{{ route('who-we-are') }}";
        }
    });
</script>
<script>
    @if ($showBanner)
        function CountDownTimer(){
            var date = @json($banner['ends_at']);
			var endDate = date.toString().replace(" " , "T");
            var end = new Date(endDate);
            var _second = 1000;
            var _minute = _second * 60;
            var _hour = _minute * 60;
            var _day = _hour * 24;
            var timer;
            function showRemaning(){
                var now = new Date();
                var distance = end - now;
                if(distance < 0){
                    clearInterval(timer);
                    document.getElementById('day').innerHTML = "00";
                    document.getElementById('hour').innerHTML = "00";
                    document.getElementById('minute').innerHTML = "00";
                    document.getElementById('second').innerHTML = "00";
                    return;
                }
                var days = Math.floor(distance / _day);
                var hours = Math.floor((distance % _day) / _hour);
                var minutes = Math.floor((distance % _hour) / _minute);
                var seconds = Math.floor((distance % _minute) / _second);

                if(days < 10){
                    document.getElementById('day').innerHTML = "0" + days;
                }else{
                    document.getElementById('day').innerHTML = days;
                }
                
                if(hours < 10){
                    document.getElementById('hour').innerHTML = "0" + hours;
                }else{
                    document.getElementById('hour').innerHTML = hours;
                }
                
                if(minutes < 10){
                    document.getElementById('minute').innerHTML = "0" + minutes;
                }else{
                    document.getElementById('minute').innerHTML = minutes;
                }
                
                if(seconds < 10){
                    document.getElementById('second').innerHTML = "0" + seconds;
                }else{
                    document.getElementById('second').innerHTML = seconds;
                }
            }
            timer = setInterval(showRemaning, 1000);
        }

        CountDownTimer();
    @endif

        var typed = new Typed("#typed", {
            strings : [" ","Kawan","Teman","Sahabat"],
            typeSpeed : 100,
            backDelay : 1500,
            loop: true
        });
    </script>
@endsection