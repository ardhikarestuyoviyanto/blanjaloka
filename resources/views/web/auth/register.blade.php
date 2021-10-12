{{-- semua view yang dibuat didalam folder web harus di extend kan dengan file master --}}
@extends('web/master')
@section('content')

    <!-- background & form SECTION-->
    <section class="border border-danger"></section>
    <div class="container-fluid">
        <div class="row overflow-hidden">
            <div class="col-lg-7 visible-lg background-pasar nopadding d-none d-xl-block">
                <img src="{{ asset('assets/blanjaloka/img/aktivitas-pasar-2.png') }}" alt="" width="120%">
            </div>
            <div class="col-12 col-lg-4 mt-4 mt-xl-5 mb-4" id="login-section">

                {{-- Notif, Link Verifikasi Telah Dikirim Ke Email Pendaftar --}}
                @if ($status = Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ $status }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ url('usersregister') }}" class="bg-white p-3 p-xl-5 login-form" id="form-section"
                    method="POST">
                    @csrf
                    <div class="text-center">
                        <h5 class="fw-bold h-daftar fs-4">Daftar Sekarang</h5>
                        <h5 class="fw-light mb-xl-5 mb-3 text-kecil2">Sudah punya akun Blanjaloka?
                            <a href="{{ url('login') }}" class="link-text">Masuk</a>
                        </h5>
                    </div>
                    <div class="mb-2 mb-xl-3">
                        <label for="inputNama" class="form-label fw-bold">Nama</label>
                        <input placeholder="Nama" type="text" class="form-control py-2 border-r-sip" id="nama"
                            name="nama_user" aria-describedby="nama" value="{{ old('nama_user') }}">
                        @if ($errors->has('nama_user'))
                            <div class="text-danger text-small">
                                @foreach ($errors->get('nama_user') as $err)
                                    {{ $err }}
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <div class="mb-2 mb-xl-3">
                        <label for="inputEmailTelp" class="form-label fw-bold">Email</label>
                        <input placeholder="Masukan Email Anda" type="text" class="form-control py-2 border-r-sip"
                            id="inputEmailTelp" name="email" value="{{ old('email') }}">
                        @if ($errors->has('email'))
                            <div class="text-danger text-small">
                                @foreach ($errors->get('email') as $err)
                                    {{ $err }}
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <div class="mb-2 mb-xl-3">
                        <label for="inputPassword" class="form-label fw-bold">Kata Sandi</label>
                        <input placeholder="Kata Sandi" type="password" class="form-control py-2 border-r-sip"
                            id="inputPassword" name="password" value="{{ old('password') }}">
                        @if ($errors->has('password'))
                            <div class="text-danger text-small">
                                @foreach ($errors->get('password') as $err)
                                    {{ $err }}
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                        <label class="form-check-label text-secondary text-kecil2 " for="exampleCheck1">Saya menyetujui
                            syarat dan ketentuan yang ditetapkan oleh Blanjaloka</label>
                    </div>
                    <button type="submit" class="btn cai-color text-white fs-5 py-2 w-100 mb-3 border-r-sip">Daftar</button>
                    <div class="mb-4 d-flex align-items-center justify-content-center ">
                        <span class="line-masuk-dengan"></span>
                        <span class="text-center text-wrap mx-3 text-secondary text-kecil">atau daftar dengan</span>
                        <span class="line-masuk-dengan"></span>
                    </div>
                    <div class="d-xl-flex d-block justify-content-between mb-2">
                        <a href="{{ url('auth/facebook') }}" type="button"
                            class="btn btn-outline-light px-4 border-r-sip border border-secondary w-100 m-1">
                            <img src="{{ asset('assets/blanjaloka/img/Facebook-2.png') }}" width="38" alt="">
                            <span class="text-black" style="color: black;">facebook</span>
                        </a>
                        <a href="{{url('auth/google')}}" type="button" class="btn btn-outline-light px-4 border-r-sip border border-secondary w-100 m-1">
                            <img src="{{ asset('assets/blanjaloka/img/google.png') }}" width="38" alt="">
                            <span class="text-black" style="color: black;">google</span>
                        </a>
                    </div>
                    <p class="text-kecil mx-xxl-5 mx-0 text-center text-secondary">Dengan mendaftar, saya menyetujui
                        <a class="link-text" href="#">Syarat dan Ketentuan</a> serta <a class="link-text"
                            href="#">Kebijakan Privasi</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
    </section>
    <!-- END OF LOGIN FORM SECTION-->

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
                    <img src="{{ asset('assets/blanjaloka/img/logo-anterin.png') }}" alt="">
                </div>
                <div class="col-5 col-sm-1">
                    <img src="{{ asset('assets/blanjaloka/img/logo-grab.png') }}" alt="">
                </div>
                <div class="col-5 col-sm-1">
                    <img src="{{ asset('assets/blanjaloka/img/logo-bonceng.png') }}" alt="">
                </div>
                <div class="col-5 col-sm-1">
                    <img src="{{ asset('assets/blanjaloka/img/logo-gojek.png') }}" alt="">
                </div>
            </div>
        </div>
    </section>
    <!-- ENF OF PARTNERSHIP-->
@endsection
