@extends('layouts.app')

@section('custom-css')
<link rel="stylesheet" href="{{ asset('css/event/event.css') }}">
@endsection

@section('content')
<div>
    <div class="foto-container">
        <div class="foto-atas d-flex justify-content-center">
            <img src="{{ asset('images/event/Asset/Event Keakraban Gen 13_14/foto_atas.png') }}" alt="foto_atas">
            <img src="{{ asset('images/what-we-do/frame-atas.png') }}" alt="frame">
            <div class="centered">Event Generasi<br> 13 & 14</div>
        </div>
    </div>
    <div class="wrapper-bottom">
        <img class="ImageAbsolute a" src="{{ asset('images/event/Asset/Event Keakraban Gen 13_14/gelombang-biru_kanan_atas.png') }}" alt="atas-kanan">
        <img class="ImageAbsolute b" src="{{ asset('images/event/Asset/Event Keakraban Gen 13_14/gelombang-biru_kiri.png') }}" alt="kiri">
        <img class="ImageAbsolute c" src="{{ asset('images/event/Asset/Event Keakraban Gen 13_14/gelombang-biru_kanan_bawah.png') }}" alt="bawah-kanan">
        <div class="tagline-container">
            <p class="tagline">"To help with love and care towards all of our surrounding in simplicity and humility"</p>
        </div>
        <div class="pengertian-container">
            <p class="pengertian">To Help With Love And Care Towards All Of Our Surroundings In Simplicity And Humility adalah tagline dari Rencang di bawah kepemimpinan Gen XIII. Tagline ini bertujuan agar Rencang dapat menolong semua masyarakat tanpa terkecuali dan tidak memandang ras,agama,budaya,suku dan etnis tertentu. Rencang akan menolong dengan penuh kasih dalam kesederhanaan dan kemanusiaan. Berikut adalah event yang telah dilakukan oleh Rencang Generasi 13 dan 14</p>
        </div>
        <div class="logo-container">
            <div class="logo-item">
                <div class="image-box" onclick="gedurasi()">
                    <a>
                        <img src="{{ asset('images/event/Asset/GEDURASI/Logo GEDURASI.png') }}" alt="logo-gedurasi" />
                    </a>
                </div>
                <div class="image-box" onclick="sentera()">
                    <a>
                        <img src="{{ asset('images/event/Asset/SENTERA/Logo SENTERA.png') }}" alt="logo-sentera" />
                    </a>
                </div>
                <div class="image-box" onclick="sch()">
                    <a>
                        <img src="{{ asset('images/event/Asset/SCH X/Logo SCH.png') }}" alt="logo-sch" />
                    </a>
                </div>
                <div class="image-box" onclick="makrab()">
                    <a>
                        <img src="{{ asset('images/event/Asset/Program Keakraban/Logo Program Keakraban.png') }}" alt="logo-makrab" />
                    </a>
                </div>
                <div class="image-box" onclick="rct()">
                    <a>
                        <img src="{{ asset('images/event/Asset/RCT/Logo RCT.png') }}" alt="logo-rct" />
                    </a>
                </div>
                <div class="image-box" onclick="rn()">
                    <a>
                        <img src="{{ asset('images/event/Asset/Logo Rencang Night.png') }}" alt="logo-rn" />
                    </a>
                </div>
            </div>
        </div>
        <div class="container-isi">
            <section id="gedurasi">
                <div class="box">
                    <div class="gambar-event">
                        <div>
                            <img src="{{ asset('images/event/Asset/kotakevent.png') }}" alt="">
                            <img src="{{ asset('images/event/Asset/GEDURASI/Foto GEDURASI.jpg') }}" alt="foto-gedurasi" />
                        </div>
                    </div>
                    <div class="information">
                        <p class="judul-event">GEDURASI</p>
                        <p class="isi-event">Dengan tema Gerakan Peduli Literasi (GEDURASI) UKM Sosial Rencang mengadakan acara Baca Buku Bareng Rencang (BaBe Rencang) yang mencakup mengenai pentingnya literasi dan kurangnya tingkat literasi pada masyarakat Indonesia, terkhususnya anak-anak melalui seminar terbuka dan penyaluran buku-buku layak pakai sebagai sumber literasi bagi masyarakat</p>
                        <div class="button">
                            <button id="gedurasi-btn">View More >></button>
                        </div>
                    </div>
                </div>
            </section>
            <section id="sentera">
                <div class="box">
                    <div class="gambar-event">
                        <div>
                            <img src="{{ asset('images/event/Asset/kotakevent.png') }}" alt="">
                            <img src="{{ asset('images/event/Asset/SENTERA/Foto SENTERA.JPG') }}" alt="foto-sentera" />
                        </div>
                    </div>
                    <div class="information">
                        <p class="judul-event">SENTERA</p>
                        <p class="isi-event">Dengan tema "Sentera" kepanjangan dari "Senyummu Lentera Harapanku" UKM Sosial Rencang bekerja sama dengan Yayasan Kanker Anak Indonesia mengadakan acara Setetes Harapan dengan melakukan kegiatan yang dilakukan secara daring sebagai wujud support untuk membangun semangat dalam proses penyembuhan kanker.</p>
                        <div class="button">
                            <button id="sentera-btn">View More >></button>
                        </div>
                    </div>
                </div>
            </section>
            <section id="sch">
                <div class="box">
                    <div class="gambar-event">
                        <div>
                            <img src="{{ asset('images/event/Asset/kotakevent.png') }}" alt="">
                            <img src="{{ asset('images/event/Asset/SCH X/Foto SCH X.JPG') }}" alt="foto-sch" />
                        </div>
                    </div>
                    <div class="information">
                        <p class="judul-event">SCH X</p>
                        <p class="isi-event">Pada masa pandemi, PMI dan pihak rumah sakit mengalami kekurangan persediaan pasokan darah. Maka dari itu, UKM Sosial Rencang mengadakan campaign secara online guna menyebarkan pentingnya donor darah bagi masyarakat yang membutuhkan. Sharing, Caring, Helping X berfokus untuk memberikan awareness kepada masyarakat khususnya generasi milenial dan Z.</p>
                        <div class="button">
                            <button id="sch-btn">View More >></button>
                        </div>
                    </div>
                </div>
            </section>
            <section id="makrab">
                <div class="box">
                    <div class="gambar-event">
                        <div>
                            <img src="{{ asset('images/event/Asset/kotakevent.png') }}" alt="">
                            <img src="{{ asset('images/event/Asset/Program Keakraban/Foto Program Keakraban.jpeg') }}" alt="foto-makrab" />
                        </div>
                    </div>
                    <div class="information">
                        <p class="judul-event">KEAKRABAN</p>
                        <p class="isi-event">Merupakan kegiatan yang dirancang guna mempererat kekeluargaan sesama anggota Rencang, dengan olahraga bersama maupun malam keakraban. Para alumni Rencang dapat mengikuti kegiatan ini agar dapat saling mengenal satu sama lain.</p>
                        <div class="button">
                            <button id="keakraban-btn">View More >></button>
                        </div>
                    </div>
                </div>
            </section>
            <section id="rct">
                <div class="box">
                    <div class="gambar-event">
                        <div>
                            <img src="{{ asset('images/event/Asset/kotakevent.png') }}" alt="">
                            <img src="{{ asset('images/event/Asset/RCT/Foto RCT.jpg') }}" alt="foto-rct" />
                        </div>
                    </div>
                    <div class="information">
                        <p class="judul-event">Rencang Cepat Tanggap</p>
                        <p class="isi-event">Rencang Cepat Tanggap adalah program yang bertujuan untuk memberikan bantuan pada hal-hal yang memiliki urgensi dalam bentuk apapun yang bersifat situasional, baik materi, uang, tenanga, dan lain-lain, kepada korban bencana. Pemberian bantuan didasarkan pada pertimbangan apa yang benar-benar dibutuhkan korban.</p>
                        <div class="button">
                            <button id="rct-btn">View More >></button>
                        </div>
                    </div>
                </div>
            </section>
            <section id="rn">
                <div class="box">
                    <div class="gambar-event">
                        <div>
                            <img src="{{ asset('images/event/Asset/kotakevent.png') }}" alt="">
                            <img src="{{ asset('images/event/Asset/bg-rencang.png') }}" alt="foto-rn" />
                        </div>
                    </div>
                    <div class="information">
                        <p class="judul-event">RENCANG NIGHT</p>
                        <p class="isi-event">Rencang Night adalah program kerja tahunan untuk membuka pendaftaran bagi calon anggota Rencang dan diadakan untuk menyambut generasi baru anggota Rencang. Rencang Night terdiri dari proses pendaftaran, seleksi, penerimaan anggota hingga puncak acara yaitu Rencang Night.</p>
                        <div class="button">
                            <button id="rn-btn">View More >></button>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>


@endsection

@section('custom-js')
<script>
    $('#gedurasi-btn, #sentera-btn, #sch-btn, #keakraban-btn, #rct-btn, #rn-btn').click(function() {
        if(this.id == "gedurasi-btn"){
            window.location = "{{ route('gedurasi') }}";
        }else if(this.id == "sentera-btn"){
            window.location = "{{ route('sentera') }}";
        }else if(this.id == "sch-btn"){
            window.location = "{{ route('sharing-caring-helping') }}";
        }else if(this.id == "keakraban-btn"){
            window.location = "{{ route('keakraban') }}";
        }else if(this.id == "rct-btn"){
            window.location = "{{ route('rencang-cepat-tanggap') }}";
        }else if(this.id == "rn-btn"){
            Swal.fire({
                icon: 'info',
                title: 'Coming Soon',
                text: "Our Rencang Night 2021 page will be updated soon",
            })
        }
    });
</script>
<script>
    function gedurasi(){
        document.getElementById('gedurasi').style.display = 'block';
        document.getElementById('sentera').style.display = 'none';
        document.getElementById('sch').style.display = 'none';
        document.getElementById('rct').style.display = 'none';
        document.getElementById('makrab').style.display = 'none';
        document.getElementById('rn').style.display = 'none';
    }
    
    function sentera(){
        document.getElementById('gedurasi').style.display = 'none';
        document.getElementById('sentera').style.display = 'block';
        document.getElementById('sch').style.display = 'none';
        document.getElementById('rct').style.display = 'none';
        document.getElementById('makrab').style.display = 'none';
        document.getElementById('rn').style.display = 'none';
    }
    
    function sch(){
        document.getElementById('gedurasi').style.display = 'none';
        document.getElementById('sentera').style.display = 'none';
        document.getElementById('sch').style.display = 'block';
        document.getElementById('rct').style.display = 'none';
        document.getElementById('makrab').style.display = 'none';
        document.getElementById('rn').style.display = 'none';
    }
    
    function makrab(){
        document.getElementById('gedurasi').style.display = 'none';
        document.getElementById('sentera').style.display = 'none';
        document.getElementById('sch').style.display = 'none';
        document.getElementById('rct').style.display = 'none';
        document.getElementById('makrab').style.display = 'block';
        document.getElementById('rn').style.display = 'none';
    }
    
    function rct(){
        document.getElementById('gedurasi').style.display = 'none';
        document.getElementById('sentera').style.display = 'none';
        document.getElementById('sch').style.display = 'none';
        document.getElementById('rct').style.display = 'block';
        document.getElementById('makrab').style.display = 'none';
        document.getElementById('rn').style.display = 'none';
    }
    
    function rn(){
        document.getElementById('gedurasi').style.display = 'none';
        document.getElementById('sentera').style.display = 'none';
        document.getElementById('sch').style.display = 'none';
        document.getElementById('rct').style.display = 'none';
        document.getElementById('makrab').style.display = 'none';
        document.getElementById('rn').style.display = 'block';
    }
</script>
@endsection