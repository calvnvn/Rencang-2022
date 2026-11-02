<div class="container-fluid px-0">
    <div class="footer py-4 px-5">
        <div class="row">
            <div class="col-lg-9 col-sm-7">
                <div class="row col-sm-12 mb-2 hide">
                    <div class="px-0 mr-4">
                        <a class="footer-link" href="{{ route('home') }}">Home</a>
                    </div>
                    <div class="px-0 mr-4">
                        <a class="footer-link" href="{{ route('what-we-do') }}">What We Do?</a>
                    </div>
                    <div class="px-0 mr-4">
                        <a class="footer-link" href="{{ route('who-we-are') }}">Who We Are?</a>
                    </div>
                    <div class="px-0 mr-4">
                        <a class="footer-link" href="{{ route('coming-soon') }}">Articles</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-5">
                <div class="footer-text">
                    <div class="mr-3 font-weight-bold">
                        Address
                    </div>
                    <div class="font-weight-light">
                        Universitas Multimedia Nusantara
                        <br>
                        Jl. Scientia Boulevard, Gading Serpong
                        <br>
                        Tangerang, Banten 15811 Indonesia
                        <br>
                        Scientia Boulevard, Tangerang
                    </div>
                </div>
            </div>
        </div>
        <hr class="border" style="border: #FFF3E1">
        <div class="row">
            <div class="col-lg-8 col-sm-7 font-weight-light mb-2">
                &copy; {{ now()->year }} Rencang Aye UMN. All Rights Reserved.
            </div>
            <div class="col-lg-4 col-sm-5">
                <div class="row mr-2 full">
                    <div class="col-sm-2 mob-foot">
                        <img class="icon-media" src="{{ asset('images/public/icon-line.png') }}" alt="Icon Line" onclick="location.href='line://ti/p/@blv8312x'">
                    </div>
                    <div class="col-sm-2 mob-foot">
                        <img class="icon-media" src="{{ asset('images/public/icon-facebook.png') }}" alt="Icon Facebook" onclick="location.href='https://www.facebook.com/RencangAyeUmn/'">
                    </div>
                    <div class="col-sm-2 mob-foot">
                        <img class="icon-media" src="{{ asset('images/public/icon-mail.png') }}" alt="Icon Mail" onclick="location.href='https://mail.google.com/mail/?view=cm&fs=1&to=rencang@umn.ac.id'">
                    </div>
                    <div class="col-sm-2 mob-foot">
                        <img class="icon-media" src="{{ asset('images/public/icon-instagram.png') }}" alt="Icon Instagram" onclick="location.href='https://www.instagram.com/rencangaye/'">
                    </div>
                    <div class="col-sm-2 mob-foot">
                        <img class="icon-media" src="{{ asset('images/public/icon-twitter.png') }}" alt="Icon Twitter" onclick="location.href='https://twitter.com/rencangayeumn?lang=en'">
                    </div>
                    <div class="col-sm-2 mob-foot">
                        <img class="icon-media" src="{{ asset('images/public/icon-youtube.png') }}" alt="Icon Youtube" onclick="location.href='https://www.youtube.com/channel/UCHjRV46bWnnrtTDG1ZNU8ZQ'">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>