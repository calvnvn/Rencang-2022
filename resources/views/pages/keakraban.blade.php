@extends('layouts.app')

@section('custom-css')
    <link rel="stylesheet" href="{{ asset('css/Keakraban/Keakraban.css') }}">
@endsection

@section('content')
<div class="content">
    <div class="Container">
        <div class="container alignItemsCenter col-sm-10 imageHeader">
            <img src="{{ asset('images/what-we-do/frame-atas.png') }}" alt="Header" class="headerArt">
            <p class="judul">Event Keakraban<br>Generasi 13&14</p>
        </div>
        <div class="content-two col d-flex justify-content-center pt-5">
            <div class="content-section-two row justify-content-md-center">
                <div class="image align-self-center">
                    <img src="{{ asset('images/Keakraban/MalamKeakraban.png') }}" alt="Malam" class="headerMalam">
                </div>
                <div class="information align-self-center">
                    <p class="name">Malam Keakraban <br>(One Night With Rencang)</p>
                    <p class="desc">Malam Keakraban adalah program keakraban
                        Rencang yang bertujuan untuk mendekatkan
                        anggota Rencang satu sama lain. Dalam kegiatan
                        ini, seluruh anggota Rencang akan mengikuti
                        berbagai kegiatan yang telah dipersiapkan oleh
                        BPH inti secara online, seperti dinamika
                        kelompok, dinamika gen, sharing, api unggun, dan
                        berbagai kegiatan menarik lainnya.</p>
                </div>
            </div>
        </div>

        <div class="content-three col d-flex justify-content-center">
            <div class="content-section-three row justify-content-md-center">
                <div class="image align-self-center">
                    <img src="{{ asset('images/Keakraban/Anniv.png') }}" alt="Anniv" class="headerAnniv">
                </div>
                <div class="information align-self-center">
                    <p class="name">Rencang's 14th Anniversary</p>
                    <p class="desc">Merayakan ulang tahun Rencang yang ke-14
                        dengan mengadakan acara bersama anggota
                        Rencang dan alumni Rencang secara online.
                        Kegiatan ini juga mengundang anggota Rencang
                        gen-gen sebelumnya. Kegiatan ini terdapat
                        kegiatan seperti bermain games,sharing,makan
                        bersama tukar kado, dan lain-lain.</p>
                </div>
            </div>
        </div>
        <div class="content-four col d-flex justify-content-center">
            <div class="content-section-four row justify-content-md-center">
                <div class="image align-self-center">
                    <img src="{{ asset('images/Keakraban/Care.png') }}" alt="Care" class="headerCare">
                </div>
                <div class="information align-self-center">
                    <p class="name">I Care For You</p>
                    <p class="desc">I Care For You merupakan program Keakraban
                        Rencang yang dilakukan dengan menulis kesan
                        dan pesan maupun evaluasi dan apresiasi kepada
                        anggota Rencang (Bisa berbentuk curhat).
                        Kegiatan ini berguna untuk mempererat tali
                        hubungan kebersamaan bersama anggota
                        Rencang secara personal.</p>
                </div>
            </div>
        </div>
        <div class="content-five col d-flex justify-content-center">
            <div class="content-section-five row justify-content-md-center">
                <div class="image align-self-center">
                    <img src="{{ asset('images/Keakraban/Curhat.png') }}" alt="Curhat" class="headerCurhat">
                </div>
                <div class="information align-self-center">
                    <p class="name">Curhat Bareng Rencang</p>
                    <p class="desc">Curhat Bareng Rencang merupakan Program
                        keakraban yang bertujuan untuk mempererat
                        hubungan antar sesama anggota. Dalam
                        kegiatan ini, seluruh anggota Rencang akan
                        dibagi menjadi kelompok kecil untuk saling
                        bergantian menceritakan keadaan/situasi yang
                        sedang mereka alami. Harapannya adalah
                        anggota Rencang bisa saling mengerti,
                        menolong, dan mengenal satu sama lain.</p>
                </div>
            </div>
        </div>
        <div class="content-six col d-flex justify-content-center pb-5" >
            <div class="content-section-six row justify-content-md-center" style="z-index:99;">
                <div class="image align-self-center">
                    <img src="{{ asset('images/Keakraban/Piknik.png') }}" alt="Piknik" class="headerPiknik">
                </div>
                <div class="information align-self-center">
                    <p class="name">Piknik Bareng Rencang</p>
                    <p class="desc">Piknik Bareng Rencang adalah program keakraban
                        Rencang yang bertujuan untuk menjalin hubungan
                        yang lebih erat sesama anggota Rencang. Dalam
                        kegiatan ini, masing-masing anggota Rencang akan
                        saling mengirimkan makanan menggunakan aplikasi
                        ojek online kepada anggota Rencang lainnya.</p>
                </div>
            </div>
            <div class= "container-full" style="z-index:0;">
                <img class="gelombangkiri d-flex justify-content-start" src="{{ asset('images/Keakraban/gelombang-kiri-cream.png') }}" alt="gelombangkiri">
                <img class="kananbawah" src="{{ asset('images/Keakraban/gelombang-kanan-bawah-cream.png') }}" alt="kananatas">
                <img class="kananatas" src="{{ asset('images/Keakraban/gelombang-kanan-atas-cream.png') }}" alt="kananatas">
            </div>
        </div>
    </div>
</div>
@endsection
