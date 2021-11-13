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

                <form class="bg-white p-3 p-xl-5 forgetpassword" id="form-section">
                    @csrf
                    <div class="text-center">
                        <img class="mb-3" src="{{ asset('assets/blanjaloka/img/blanjaloka.png') }}" alt="">
                        <h5 class="fw-light mb-2 text-kecil2">Masukkan email aktif yang telah terdaftar di Blanjaloka</h5>
                        <a href="{{ url('login') }}" class="link-text mb-3">Kembali Login</a>
                    </div>
                    <div class="mb-3">
                        <input placeholder="Contoh: email@blanjaloka.com" type="email" class="form-control py-3 border-r-sip mt-2" name="email" required id="exampleInputEmail1" aria-describedby="emailHelp">
                        <small><div class="text-muted mt-2" id="timerdiv"></div></small>
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
    <script>
        $(document).ready(function(){
            $('.forgetpassword').submit(function(e){
                e.preventDefault();

                $.ajax({
                    url: "{{ url('forgetpassword_handler') }}",
                    type: "POST",
                    data: $(this).serialize(),
                    beforeSend: function() {
                        $('.btn-submit').attr('disabled', true);  
                    },
                    complete: function(){
                        $('.btn-submit').attr('disabled', false);
                    },
                    success: function(data) {

                        if(data.disabled == true){

                            swal({
                                title: "Sukses",
                                text: data.pesan,
                                icon: "success",
                                button: "Oke",
                            })
                            .then((result) => {

                                $('.btn-submit').attr('disabled', true);  

                                var timeLeft = 40;
                                var elem = document.getElementById('timerdiv');
                                
                                var timerId = setInterval(countdown, 1000);
                                
                                function countdown() {
                                    if (timeLeft == -1) {
                                        clearTimeout(timerId);
                                        location.reload();
                                    } else {
                                        elem.innerHTML = ' Tunggu '+timeLeft+' detik lagi untuk kirim link reset password kembali';
                                        timeLeft--;
                                    }
                                }


                            });

                        }else{

                            swal({
                                title: "Error",
                                text: data.pesan,
                                icon: "error",
                                button: "Oke",
                            })
                            .then((result) => {
                                

                            });

                        }

                    },
                    error: function(err) {
                        alert(err);
                    }
                })
            });
        });
    </script>
@endsection
