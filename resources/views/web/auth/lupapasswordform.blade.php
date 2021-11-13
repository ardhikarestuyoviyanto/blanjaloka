{{-- semua view yang dibuat didalam folder web harus di extend kan dengan file master --}}
@extends('web/master')
@section('content')

    <!-- background & form SECTION-->
    <section class="border border-danger"></section>
    <div class="container-fluid">
        <div class="row overflow-hidden">
            <div class="col-lg-7 visible-lg background-pasar nopadding d-none d-xl-block">
                <div class="text-center mt-4">
                    <img src="{{ asset('assets/blanjaloka/img/forgetpassword.jpg') }}" alt="" width="50%">   
                </div>
            </div>
            <div class="col-12 col-lg-5 mt-4 mt-xl-5 mb-4 ms-lg-auto" id="login-section">

                <form action="{{url('resetpassword_handler')}}" method="POST" class="bg-white p-3 p-xl-5 forgetpassword" id="form-section">
                    @csrf
                    <div class="text-center">
                        <img class="mb-3" src="{{ asset('assets/blanjaloka/img/blanjaloka.png') }}" alt="">
                        <h5 class="fw-light mb-2 text-kecil2">Masukkan password baru untuk akun anda, minimal panjang password 6 karakter, 1 huruf besar dan 1 simbol unik.</h5>
                    </div>
                    <div class="mb-3">
                        <input placeholder="Password Baru" type="password" class="form-control py-3 border-r-sip mt-2" name="password_new" required>
                        @if($errors->has('password_new'))
                            <div class="text-danger text-small">
                                @foreach($errors->get('password_new') as $err)
                                    {{$err}}
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <input placeholder="Konfirmasi Password" type="password" class="form-control py-3 border-r-sip mt-2" name="password_confirmation" required>
                    </div>
                    <button type="submit" class="btn cai-color text-white fs-5 fw-bold p-2 w-100 mb-3 border-r-sip btn-submit">Submit</button>
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
