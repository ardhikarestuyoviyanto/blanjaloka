{{-- semua view yang dibuat didalam folder web harus di extend kan dengan file master --}}
@extends('web/master')
@section('content')

<!-- LANDING PAGE -->
<section id="landing-page" class="mt-0 pt-5">
    <div class="shapeTop">
        <div class="container">
            <div class="row justify-content-between pt-5 flex-md-row-reverse">
                <div class="col-buah col-8 col-xxl-5">
                    <img 
                    src="{{asset('assets/blanjaloka/img/buahGede.png')}}" 
                    class="buah-gede img-fluid" 
                    alt="">
                </div>
                <div class="col-xxl-5 text-white">
                    <h1 class="col-12 col-xl-5 slogan">Belanja Pintar Melalui Pasar Digital</h1>
                </div>
            </div>
        </div>
        <svg class="shapeLengkung" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#fff" fill-opacity="1" d="M0,192L60,213.3C120,235,240,277,360,266.7C480,256,600,192,720,160C840,128,960,128,1080,112C1200,96,1320,64,1380,48L1440,32L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"></path></svg>
    </div>
</section>
<!-- END OF LANDING PAGE -->

<!-- Deskripsi Blanjaloka-->
<section id="deskripsi-pasar-asia">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-sm-4 text-center mb-2">
                <img 
                class="img-fluid" 
                src="{{asset('assets/blanjaloka/img/aktivitas-pasar.png')}}" 
                alt="">
            </div>
            <div class="col-sm-5 mt-lg-0 mt-3">
                <h2 class= "cai-color-text">Apa itu Blanjaloka?</h2>
                <p>Blanjaloka adalah perangkat lunak yang digunakan
                    untuk malakukan transaksi jual beli pada pasar tradisional
                    yang berbasis web-based dan mobile store. Tujuan utama
                    dibuatnya Blanjaloka yakni mejadikan pasar tradisional
                    menjadi target digitalisasi dengan waktu penjualan yang
                    menyesuaikan jam operasional pasar tersebut. Blanjaloka mejadikan masyarakat lokal menjadi sebuah target
                    pemasaran karena harga yang akan dipasang adalah harga
                    yang sesuai di pasar.</p>
                <p>Fungsi Utama Blanjaloka yaitu Mengelola Data Toko, Produk, Driver, Customer, Penjualan Produk, Pelacakan Produk, Pengiriman Produk, dan Generate Laporan.</p>
                <a href="{{url('login')}}" type="button" class="btn cai-color text-white">Coba Sekarang</a>
            </div>
        </div>
    </div>
</section>
<!-- End Of Deskripsi BlanjaLOKA-->

<!-- Mengapa Memilih Blanjaloka -->
<section>
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col">
                <h2 class="text-center">Mengapa Memilih
                    <img 
                    class="img-fluid" 
                    src="{{asset('assets/blanjaloka/img/blanjaloka.png')}}" 
                    alt="">
                </h2>
            </div>
        </div>
        <div class="imgs-pilihan row justify-content-center align-items-center">
            <div class="col-sm-3 text-center">
                <img 
                class="col-4 col-sm-6 align-bottom" 
                src="{{asset('assets/blanjaloka/img/persen.png')}}" alt="">
                <h5>Tawaran Harian & Diskon Spesial</h5>
            </div>
            <div class="col-sm-3 text-center">
                <img 
                class="col-4 col-sm-6" 
                src="{{asset('assets/blanjaloka/img/pengiriman.png')}}" alt="">
                <h5>pengiriman dihari yang sama</h5>
            </div>
            <div class="col-sm-3 text-center align-items-center">
                <img 
                class="col-4 col-sm-6" 
                src="{{asset('assets/blanjaloka/img/dollar.png')}}" 
                alt="">
                <h5>Harga di aplikasi sama dengan harga di pasar</h5>
            </div>
        </div>
    </div>
</section>
<!-- END OF Mengapa Memilih Blanjaloka -->


<!-- UNDUH APLIKASI -->
<section id="unduh-aplikasi" class="cai-color mb-5">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-sm-5 p-3">
                <h2 class="text-white">Unduh aplikasi Blanjaloka</h2>
                <p class="text-white">Dan dapatkan  promo menarik lainnya</p>
                <button class="btn btn-success text-white">Unduh Sekarang</button>
            </div>
            <div class="col-sm-3 p-3">
                <img
                src="{{asset('assets/blanjaloka/img/blanjaloka-white.png')}}" 
                alt="">
                <p class="text-white">Pasar Pintar untuk Daerah Pintar</p>
                <div class="">
                    <a href="#">
                        <img 
                        src="{{asset('assets/blanjaloka/img/app-store.png')}}" 
                        alt="">
                    </a>

                    <a href="#">
                        <img 
                        src="{{asset('assets/blanjaloka/img/google-play.png')}}" 
                        alt="">
                    </a>
                </div>
            </div>
            <div class="col-phones col-sm-3 ">
                <img 
                class="phones col-9 img-fluid" 
                src="{{asset('assets/blanjaloka/img/phones.png')}}" 
                alt="">
            </div>
        </div>
    </div>
</section>
<!-- END OF UNDUH APLIKASI -->

<!-- PARTNERSHIP-->
<section>
    <div class="container">
        <div class="row">
            <div class="col mb-3">
                <h2 class="text-center poppins">Partnership</h2>
            </div>
        </div>
        <div class="row align-items-center justify-content-center text-center">
            <div class="col-5 col-sm-1">
                <img  
                src="{{asset('assets/blanjaloka/img/logo-anterin.png')}}" 
                alt="">
            </div>
            <div class="col-5 col-sm-1">
                <img 
                src="{{asset('assets/blanjaloka/img/logo-grab.png')}}" 
                alt="">
            </div>
            <div class="col-5 col-sm-1">
                <img 
                src="{{asset('assets/blanjaloka/img/logo-bonceng.png')}}" 
                alt="">
            </div>
            <div class="col-5 col-sm-1">
                <img 
                src="{{asset('assets/blanjaloka/img/logo-gojek.png')}}" 
                alt="">
            </div>
        </div>
    </div>
</section>
<!-- ENF OF PARTNERSHIP-->

@endsection