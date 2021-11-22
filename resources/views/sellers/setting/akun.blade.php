@extends('sellers/master-sellers')
@section('content')
<div class="content-wrapper">
    <br>
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-sm">
                    <div class="card">
                        <div class="card-header">
                            <h3>Akun Saya</h3>
                            <p class="text-muted">
                                Konfigurasi Pengaturan Akun Anda
                            </p>
                        </div>
                        <div class="card-body">
                            @foreach ($penjual as $p)
                                <form action="{{ url('sellers/setting/akun/update') }}" enctype="multipart/form-data" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label>Nama Penjual</label>
                                        <input type="text" class="form-control bg-white" name="nama_user" placeholder="Nama Sellers" value="{{ $p->nama_user }}" readonly>
                                        <small class="form-text text-muted"><a href="{{ url('setting/profil') }}" target="_blank">Klik Disini</a> Untuk Update Nama Penjual</small>
                                    </div>                                  
        
                                    <div class="mb-3">
                                        <label>No KTP</label>
                                        <input type="text" class="form-control" name="no_ktp" value="{{ $p->no_ktp }}" placeholder="Nomor KTP">
                                        @if ($errors->has('no_ktp'))
                                            <div class="text-danger text-small">
                                                @foreach ($errors->get('no_ktp') as $err)
                                                    {{ $err }}
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
        
                                    <div class="mb-3">
                                        <label>Dokumen Pribadi</label><br>
                                        <a href="#" class="btn btn btn-light w-25" data-toggle="modal" data-target="#modalupdatefotoktp" type="button" style="background-color:white; border: 2px solid #d9d9d9">Upload Foto Ktp</a>
                                        <br><i class="text-success"><i class="far fa-check-circle"></i> Terverifikasi Oleh Tim Blanjaloka</i>
                                    </div>
        
                                    <div class="mb-3">
                                        <a href="#" class="btn btn btn-light w-25" data-toggle="modal" data-target="#modalupdatefotoktporang" type="button" style="background-color:white; border: 2px solid #d9d9d9">Upload Foto Anda Dengan Ktp</a>
                                        <br> <i class="text-success"><i class="far fa-check-circle"></i> Terverifikasi Oleh Tim Blanjaloka</i>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </form>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-header">
                            <h3>Update PIN Penjual</h3>
                            <p class="text-muted">
                            Ganti PIN Penjual Secara Berkala Untuk Mengamankan Akun Anda
                            </p>
                        </div>
                        <form action="{{url('sellers/setting/akun/update/pin')}}" method="post">
                            @csrf
                            <div class="card-body">
                                <input type="password" class="form-control mb-2" placeholder="PIN LAMA" name="pin_lama" required>
                                <input type="password" class="form-control mb-2" placeholder="PIN BARU" name="pin_baru" required>
                                @if ($errors->has('pin_baru'))
                                    <div class="text-danger text-small text-sm">
                                        @foreach ($errors->get('pin_baru') as $err)
                                            {{ $err }}
                                        @endforeach
                                    </div>
                                @endif
                                <button type="submit" class="btn btn-primary mt-3">Simpan</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </section>
</div>

<div class="modal fade" id="modalupdatefotoktp" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Foto KTP Anda</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form id="updatefotoktpform">
            @csrf
            <div class="modal-body">
                <div class="upload-image-ktp"></div>
                <div class="mt-3">
                    <input class="form-control images-ktp" type="file" name="fotoktp" required accept=".png,.jpg">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary cropped-ktp">Crop and Save</button>
            </div>
        </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalupdatefotoktporang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Foto Anda Memegang KTP</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form id="updatefotoktporangform">
            @csrf
            <div class="modal-body">
                <div class="upload-image-ktp-orang"></div>
                <div class="mt-3">
                    <input class="form-control images-ktp-orang" type="file" name="foto_penjual_ktp" required accept=".png,.jpg">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary cropped-ktp-orang">Crop and Save</button>
            </div>
        </form>
        </div>
    </div>
</div>

@if ($status = Session::get('success'))
<script>swal("{{$status}}")</script>
@endif

<script>
    //====================================================================================
    $image_crop = $('.upload-image-ktp').croppie({
        enableExif: true,
        viewport: {
            width: 500,
            height: 400,
            type: 'rectangle'
        },
        boundary: {
            width: 600,
            height: 500
        }
    });
    $('.images-ktp').on('change', function (e) { 
        var reader = new FileReader();
        var myFile = $(this).val();
        var upld = myFile.split('.').pop();

        if(upld == 'jpg' || upld == 'png' || upld == 'jpeg'){

            reader.onload = function (e) {
                $image_crop.croppie('bind', {
                    url: e.target.result
                }).then(function(){
                   
                });			
            }
            reader.readAsDataURL(this.files[0]);

        }else{

            swal("Peringatan", "Foto Ktp Harus Berektensi .png atau .jpg", "warning");
            $('.images-ktp').val('');

        }


    });
    
    $('.cropped-ktp').on('click', function (ev) {
        $image_crop.croppie('result', {
            type: 'canvas',
            size: 'viewport'
        }).then(function (response) {
            $.ajax({
                url: "{{url('sellers/setting/akun/update/fotoktp')}}",
                type: "POST",
                data: {'foto_ktp':response, '_token': "{{csrf_token()}}"},
                beforeSend: function() {
                    $.LoadingOverlay("show");
                },
                complete: function() {
                    $.LoadingOverlay("hide");
                },
                success: function (data) {
                    swal(data.pesan)
                    .then((result) => {
                        location.reload();
                    });
                }
            });
        });
    });	
    //==============================================================================================================
    $image_crops = $('.upload-image-ktp-orang').croppie({
        enableExif: true,
        viewport: {
            width: 500,
            height: 400,
            type: 'rectangle'
        },
        boundary: {
            width: 600,
            height: 500
        }
    });
    $('.images-ktp-orang').on('change', function (e) { 
        var reader = new FileReader();
        var myFile = $(this).val();
        var upld = myFile.split('.').pop();

        if(upld == 'jpg' || upld == 'png' || upld == 'jpeg'){

            reader.onload = function (e) {
                $image_crops.croppie('bind', {
                    url: e.target.result
                }).then(function(){
                });			
            }
            reader.readAsDataURL(this.files[0]);

        }else{

            swal("Peringatan", "Foto Ktp Harus Berektensi .png atau .jpg", "warning");
            $('.images-ktp-orang').val('');

        }


    });
    
    $('.cropped-ktp-orang').on('click', function (ev) {
        $image_crops.croppie('result', {
            type: 'canvas',
            size: 'viewport'
        }).then(function (response) {
            $.ajax({
                url: "{{url('sellers/setting/akun/update/fotopenjualktp')}}",
                type: "POST",
                data: {'foto_penjual_ktp':response, '_token': "{{csrf_token()}}"},
                beforeSend: function() {
                    $.LoadingOverlay("show");
                },
                complete: function() {
                    $.LoadingOverlay("hide");
                },
                success: function (data) {
                    swal(data.pesan)
                    .then((result) => {
                        location.reload();
                    });
                }
            });
        });
    });	

    
</script>
@endsection
