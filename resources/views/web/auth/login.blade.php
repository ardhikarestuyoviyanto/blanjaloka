{{-- semua view yang dibuat didalam folder web harus di extend kan dengan file master --}}
@extends('web/master')
@section('content')

    <!-- background & form SECTION-->
    <section class="border border-danger"></section>
    <div class="container-fluid">
        <div class="row overflow-hidden">
            <div class="col-lg-7 visible-lg background-pasar nopadding d-none d-xl-block">
                <img src="{{ asset('assets/blanjaloka/img/aktivitas-pasar-2.png') }}" alt="" width="104%">
            </div>
            <div class="col-12 col-lg-5 mt-4 mt-xl-5 mb-4 ms-lg-auto" id="login-section">

                {{-- Notif Jika Akun Berhasil diverifikasi --}}
                @if ($status = Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ $status }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- Notif Jika Gagal Login --}}
                @if($status = Session::get('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{$status}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <form action="{{url('userslogin')}}" class="bg-white p-3 p-xl-5 " id="form-section" method="POST">
                    @csrf
                    <div class="text-center">
                        <img class="mb-3" src="{{ asset('assets/blanjaloka/img/blanjaloka.png') }}" alt="">
                        <h5 class="fw-light mb-0 text-kecil2">Belum punya akun Blanjaloka?</h5>
                        <a href="{{ url('register') }}" class="link-text">Daftar</a>
                    </div>
                    <div class="mb-3">
                        <input placeholder="Contoh: email@blanjaloka.com" value="{{old('email')}}" type="text" class="form-control py-3 border-r-sip mt-2" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
                        @if($errors->has('email'))
                            <div class="text-danger text-small">
                                @foreach($errors->get('email') as $err)
                                    {{$err}}
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <input placeholder="Kata Sandi" type="password" class="form-control py-3 border-r-sip" name="password" id="exampleInputPassword1">
                        @if($errors->has('password'))
                            <div class="text-danger text-small">
                                @foreach($errors->get('password') as $err)
                                    {{$err}}
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <button type="submit"
                        class="btn cai-color text-white fs-5 fw-bold p-2 w-100 mb-3 border-r-sip">Login</button>
                    <div class="mb-4 d-flex align-items-center justify-content-center ">
                        <span class="line-masuk-dengan"></span>
                        <span class="text-center text-wrap mx-3 text-secondary text-kecil">atau login dengan</span>
                        <span class="line-masuk-dengan"></span>
                    </div>
                    <div class="d-xl-flex d-block justify-content-between">
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
