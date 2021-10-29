{{-- semua view yang dibuat didalam folder web harus di extend kan dengan file master --}}
@extends('web/master')
@section('content')

<!-- breadcrumb -->
<section class="pt-xl-5 pt-4">
    <div class="container">
        <nav id="breadcrumb" style="--bs-breadcrumb-divider: '&rarr;'" aria-label="breadcrumb">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-decoration-none cai-color-text" href="{{url('index')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Pengaturan</li>
            </ol>
        </nav>
    </div>
</section>
<!-- END OF BREADCRUMB -->

<section class="mt-3">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <div class="list-group mb-3">
                    <a href="{{url('setting/profil')}}" class="list-group-item list-group-item-action" aria-current="true">Profil Saya</a>
                    <a href="{{url('setting/alamat')}}" class="list-group-item list-group-item-action">Alamat Pengiriman</a>
                    <a href="{{url('setting/ubahpassword')}}" class="list-group-item list-group-item-action active">Ubah Password</a>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header bg-light">
                        <b>Ubah Password</b> <br>
                        <small>Ubah Password akun anda untuk mengontrol, melindungi dan mengamankan akun</small>
                    </div>
                    <form action="{{url('setting/ubahpassword/update')}}" method="post">
                        @csrf
                        <div class="card-body">

                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="floatingInput" placeholder="Password Sekarang" name="password_now" required >
                                <label for="floatingInput">Password Sekarang</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="floatingInput" placeholder="Password Sekarang" name="password_new" required >
                                <label for="floatingInput">Password Baru</label>
                                @if ($errors->has('password_new'))
                                    <div class="text-danger text-small">
                                        @foreach ($errors->get('password_new') as $err)
                                            {{ $err }}
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="floatingInput" placeholder="Password Sekarang" name="password_confirmation" required >
                                <label for="floatingInput">Konfirmasi Password</label>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


</section>

{{-- Notif Jika Password Berhasil Diiupdate --}}
@if ($status = Session::get('success'))
<script>
    swal("{{$status}}")
    .then((result) => {
        location.href = "{{url('logout')}}";
    });
</script>
@endif

{{-- Notif Jika Password Lama Salah--}}
@if ($status = Session::get('error'))
<script>
    swal("{{$status}}")
</script>
@endif

@endsection 