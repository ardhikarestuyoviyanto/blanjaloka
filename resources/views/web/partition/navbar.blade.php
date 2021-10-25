<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{url('/')}}">
        <img 
        src="{{asset('assets/blanjaloka/img/blanjaloka.png')}}" 
        alt="" 
        width="200">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse text-center" id="navbarSupportedContent">
        <form class="d-inline-flex flex-fill ms-2 my-auto">
            <input class="search-box form-control" placeholder="Cari Kebutuhan Kamu Disini" aria-label="Search">
            <div class="search ms-1">
            <a class="btn border cai-color-text" type="submit"><i class="bi bi-search"></i></a>
            </div>
        </form>
        
        @if(!session('isUsers'))
        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
            <a class="btn cai-color-text fs-3 m-1 ms-3" id="keranjang"><i class="bi bi-cart3"></i></a>
            <a class="garisBatas fs-3 text-secondary align-middle me-3">|</a>
            <a class="btn cai-color-text border m-1" id="buttonMasuk" aria-current="page" href="{{url('login')}}">Masuk</a>
            <a class="btn cai-color text-white m-1" id="buttonDaftar" href="{{url('register')}}">Daftar</a>
            </li>
        </ul>
        @else

        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
            <a class="btn cai-color-text fs-3 m-1 ms-3" id="keranjang"><i class="bi bi-cart3"></i></a>
            <a class="garisBatas fs-3 text-secondary align-middle me-3">|</a>
            <a class="btn bi bi-bell-fill cai-color-text m-1 fs-5" id="buttonMasuk" aria-current="page" href="notifikasi.html"><span class="ms-2 fs-6 align-middle">Notifikasi</span></a>
            
            <div class="dropdown d-inline">
                <button class="btn bi bi-person-circle cai-color-text fs-4" type="button" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                  <p class="fs-6 align-middle d-inline">{{session()->get('nama_user')}}</p>
                </button>
                <ul class="dropdown-menu p-3 mt-0 mt-xl-4" aria-labelledby="dropdownUser">
                    <li><span class="dropdown-item-text fw-bold">Halo, {{session()->get('nama_user')}}</span></li>
                    <li><a class="dropdown-item" target="_blank" href="{{url('sellers/daftar')}}">Toko Saya</a></li>
                  <li><a class="dropdown-item" href="#">Favorit</a></li>
                  <li><a class="dropdown-item" href="#">Daftar Belanja</a></li>
                  <li><a class="dropdown-item" href="#">Pesanan Saya</a></li>
                  <li><a class="dropdown-item" href="#">Pengaturan</a></li>
                  <li><a class="dropdown-item" href="{{url('logout')}}">Keluar</a></li>
                </ul>
              </div>
            </li>
        </ul>
        @endif

        </div>
    </div>
</nav>
<!-- END OF NAVBAR -->

<script>
//ketika dijalankan di mobile, 
if ($(document).width() <= 988){
    //pindahkan elemen cart ke kiri search-box
    $("#keranjang").insertAfter($(".navbar-brand"));

    //Hapus Garis Pemisah antara Cart dengan loginButton
    $(".garisBatas").remove();
}
</script>