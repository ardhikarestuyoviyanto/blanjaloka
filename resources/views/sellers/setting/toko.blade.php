@extends('sellers/master-sellers')
@section('content')
<link rel="stylesheet" href="{{asset('template/admin/css/product.css')}}">
<div class="content-wrapper">
    <br>
    <section class="content">
        <div class="container-fluid">

            <div class="card">
                <div class="card-header">
                    <h3>Profil Toko</h3>
                    <p class="text-muted">
                        Lihat status toko dan update profil toko Anda
                    </p>
                </div>
                <div class="card-body">
                    @foreach ($toko as $t)
                    <div class="row">
                        <div class="col-sm-4">
                            <ul class="list-group">
                                <li class="list-group-item badge-light">
                                    <div class="text-center">
                                        @if(empty($t->logo_toko))
                                            <img src="{{ asset('assets/blanjaloka/img/system/cart.png') }}" class="img-circle elevation-2" alt="User Image" width="90">
                                        @else
                                            <img src="{{ asset('assets/admin/logo_toko/'.$t->logo_toko) }}" class="img-circle elevation-2" alt="User Image" width="90">
                                        @endif
                                        <br>
                                        <a href="#" data-toggle="modal" data-target="#editmodal" class="btn btn btn-light mt-4" style="background-color:white; border: 2px solid #d9d9d9; padding:5px">
                                            Pilih Gambar
                                        </a>                            
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-desktop"></i> Lihat Toko
                                    <span style="float: right;">
                                        <a href="#" class="text-primary">
                                            Lihat <i class="fas fa-chevron-right"></i>
                                        </a>
                                    </span>
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-gift"></i> Produk
                                    <span style="float: right;">
                                        <a href="{{url('sellers/produk')}}" class="text-primary">
                                            {{$total_produk}} <i class="fas fa-chevron-right"></i>
                                        </a>
                                    </span>
                                </li>
                                <li class="list-group-item">
                                    <i class="far fa-star"></i> Penilaian
                                    <span style="float: right;">
                                        <a href="#" class="text-primary">
                                            5.0 <i class="fas fa-chevron-right"></i>
                                        </a>
                                    </span>
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-building"></i> Pasar Suka Makmur
                                    <span style="float: right;">
                                        <a href="#" class="text-primary">
                                            Lihat <i class="fas fa-chevron-right"></i>
                                        </a>
                                    </span>
                                </li>
                            </ul>
                        </div>
                        <div class="col-sm-8 pl-4">
                            <form action="{{url('sellers/setting/toko/update')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label>No Toko</label>
                                    <input type="text" class="form-control bg-white" name="no_toko" value="{{ $t->no_toko }}" readonly>
                                    <small class="form-text text-muted">
                                        Jika Anda ingin mengganti no toko, silahkan menghubungi customers service Blanjaloka
                                    </small>
                                </div>
    
                                <div class="mb-3">
                                    <label>Nama Toko</label>
                                    <input type="text" class="form-control" name="nama_toko" placeholder="Nama Toko" value="{{ $t->nama_toko }}" required>
                                    @if ($errors->has('nama_toko'))
                                        <div class="text-danger text-small">
                                            @foreach ($errors->get('nama_toko') as $err)
                                                {{ $err }}
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
    
                                <div class="mb-3">
                                    <label>Kategori Toko</label>
                                    <select class="form-control" id="floatingSelect" required aria-label="Kategori Toko Anda" name="id_kategoritoko">
                                        <option selected value="">- Kategori Toko -</option>    
                                        @foreach ($kategoritoko as $k)
                                            <option
                                                {{ $k->id_kategoritoko == $t->id_kategoritoko ? 'selected' : '' }}
                                                value="{{ $k->id_kategoritoko }}">
                                                {{ $k->nama_kategoritoko }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
    
                                <div class="mb-3">
                                    <label>Deskripsi Toko</label>
                                    <textarea name="deskripsi_toko" id="" cols="30" rows="10"class="form-control" required>{{ $t->deskripsi_toko }}</textarea>
                                </div>
    
                                <input type="hidden" name="foto_toko" id="foto_toko" value="{{$t->foto_toko}}">
    
                                <div class="mb-3">
                                    <label>Gambar Toko</label>
                                    <div class="row">
                                        <div class="col-md-1">
                                            <div class="image-upload">
                                                <label for="file-input">
                                                       <div class="upload-icon">
                                                            <img class="icon" src="https://image.flaticon.com/icons/png/128/61/61112.png">
                                                            <img class="prev" src="https://image.flaticon.com/icons/png/128/61/61112.png">
                                                            <div class="text-center mt-2">
                                                                <a href="" id="btn-dlt-1" class="hidden btn-dlt" data-toggle="tooltip" data-placement="right" title="hapus"><i class="fas fa-trash text-danger"></i></a>
                                                            </div>
                                                        </div>
                                                </label>
                                                <input id="file-input" name="foto_toko[]" class="foto_toko" type="file" data-id="1"/>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="image-upload">
                                                <label for="file-input2">
                                                       <div class="upload-icon">
                                                            <img class="icon" src="https://image.flaticon.com/icons/png/128/61/61112.png">
                                                            <img class="prev" src="https://image.flaticon.com/icons/png/128/61/61112.png">
                                                            <div class="text-center mt-2">
                                                                <a href="" id="btn-dlt-2" class="hidden btn-dlt" data-toggle="tooltip" data-placement="right" title="hapus"><i class="fas fa-trash text-danger"></i></a>
                                                                <a href="#" id="btn-dlt-server-2" class="hidden dlt-img-toko" data-toggle="tooltip" data-placement="right" title="hapus"><i class="fas fa-trash text-danger"></i></a>
                                                            </div>
                                                        </div>
                                                      </label>
                                                <input id="file-input2" name="foto_toko[]" class="foto_toko" type="file" data-id="2"/>
                                              </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="image-upload">
                                                <label for="file-input3">
                                                       <div class="upload-icon">
                                                            <img class="icon" src="https://image.flaticon.com/icons/png/128/61/61112.png">
                                                            <img class="prev" src="https://image.flaticon.com/icons/png/128/61/61112.png">
                                                            <div class="text-center mt-2">
                                                                <a href="" id="btn-dlt-3" class="hidden btn-dlt" data-toggle="tooltip" data-placement="right" title="hapus"><i class="fas fa-trash text-danger"></i></a>
                                                                <a href="#" id="btn-dlt-server-3" class="hidden dlt-img-toko" data-toggle="tooltip" data-placement="right" title="hapus"><i class="fas fa-trash text-danger"></i></a>
                                                            </div>
                                                        </div>
                                                      </label>
                                                <input id="file-input3" name="foto_toko[]" class="foto_toko" type="file" data-id="3"/>
                                              </div>
                                        </div>
                                    </div>
                                </div>
    
                                <button type="submit" class="btn btn-primary mt-4">Simpan</button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</div>

{{-- Modal Update Logo --}}
<div class="modal fade" id="editmodal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Logo Toko</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="upload-image"></div>
                <div class="mt-3">
                    <input class="form-control" type="file" id="images" name="logo_toko" required accept=".png,.jpg">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary cropped_image">Crop and Save</button>
            </div>
        </div>
    </div>
</div>


@if ($status = Session::get('success'))
<script>swal("{{$status}}")</script>
@endif

<script>
$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();

    //-------------------------------------

    function readURL(input) {
      var id = $(input).attr("id");
      var upld = input.files[0].type;
      if (upld == 'image/png' || upld == 'image/jpg' || upld == 'image/jpeg') {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('label[for="' + id + '"] .upload-icon').css("border", "none");
                $('label[for="' + id + '"] .icon').hide();
                $('label[for="' + id + '"] .prev').attr('src', e.target.result).show();
            }
            reader.readAsDataURL(input.files[0]);
        }
      }
    }
    
    $("input[id^='file-input']").change(function() {
      readURL(this);
    });

    //------------------------------------------------------------------------------------------------------

    $('.foto_toko').on('change', function(e){
        var myFile = $(this).val();
        var upld = myFile.split('.').pop().toLowerCase();
        if (upld == 'png' || upld == 'jpg' || upld == 'jpeg') {
            if($(this).data('id') == 1){
                $('#btn-dlt-1').show();
            }else if($(this).data('id') == 2){
                $('#btn-dlt-2').show();
            }else if($(this).data('id') == 3){
                $('#btn-dlt-3').show();
            }
    
        }else{
            swal("Peringatan", "Foto Produk Harus Berektensi .png atau .jpg", "warning");
            $(this).val('');
    
        }
    });
    
    //---------------------------------------------------------------------------------------------------------

    $('#btn-dlt-3').click(function(e){
        e.preventDefault();
        $('#file-input3').val('');
        $('label[for="file-input3"] .upload-icon').css({"border": "2px solid #5642BE", "border-style":"dotted"});
        $('label[for="file-input3"] .icon').show();
        $('label[for="file-input3"] .prev').hide();
        $('#btn-dlt-3').hide();
    });
    
    $('#btn-dlt-2').click(function(e){
        e.preventDefault();
        $('#file-input2').val('');
        $('label[for="file-input2"] .upload-icon').css({"border": "2px solid #5642BE", "border-style":"dotted"});
        $('label[for="file-input2"] .icon').show();
        $('label[for="file-input2"] .prev').hide();
        $('#btn-dlt-2').hide();
    });
    
    $('#btn-dlt-1').click(function(e){
        e.preventDefault();
        $('#file-input').val('');
        $('label[for="file-input"] .upload-icon').css({"border": "2px solid #5642BE", "border-style":"dotted"});
        $('label[for="file-input"] .icon').show();
        $('label[for="file-input"] .prev').hide();
        $('#btn-dlt-1').hide();
    });

    //------------------------------------------------------------------------------------------------------

    $(function(){
        var fileget = $('#foto_toko').val();
        var file = fileget.split(',');

        for (let i=0; i<file.length; i++){

            fetch("{{asset('assets/admin/foto_toko/')}}"+'/'+file[i])
            .then(res => res.blob()) 
            .then(blob => {
                var file = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.onload = function(e) {   
                    if(i == 0){
                        $('label[for=file-input] .upload-icon').css("border", "none");
                        $('label[for=file-input] .icon').hide();
                        $('label[for=file-input] .prev').attr('src',  file).show();  
                    
                    }else if(i == 1){
                        $('label[for=file-input3] .upload-icon').css("border", "none");
                        $('label[for=file-input3] .icon').hide();
                        $('label[for=file-input3] .prev').attr('src',  file).show();  
                        $('#btn-dlt-server-3').attr({
                            "data-index": 1,
                        });
                        $('#btn-dlt-server-3').show();
                    }
                    
                    else{

                        $('label[for=file-input' + i + '] .upload-icon').css("border", "none");
                        $('label[for=file-input' + i + '] .icon').hide();
                        $('label[for=file-input' + i + '] .prev').attr('src',  file).show();
                        $('#btn-dlt-server-'+i).attr({
                            "data-index": i,
                        });
                        $('#btn-dlt-server-'+i).show();
                    }         

                }

                reader.readAsDataURL(blob);

            });
        }   

    });

    //----------------------------------------------------------------------------------------------

    $('.dlt-img-toko').click(function(e){
        e.preventDefault();
        swal({
            title: "Hapus Foto Ini",
            text: "Foto ini akan dihapus selamanya dari aplikasi, apakah anda ingin melanjutkan ?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if(willDelete) {
                $.ajax({
                    data:{'index':$(this).data('index'), '_token': "{{csrf_token()}}"},
                    url: "{{ url('sellers/setting/toko/foto/delete') }}",
                    type: "POST",
                    success: function(e){
                        location.reload();
                    }
                });
            }
        });
    });

    //------------------------------------------------------------------------------------------------------

    $image_crop = $('#upload-image').croppie({
        enableExif: true,
        viewport: {
            width: 200,
            height: 200,
            type: 'circle'
        },
        boundary: {
            width: 300,
            height: 300
        }
    });
    $('#images').on('change', function () { 
        var reader = new FileReader();
        reader.onload = function (e) {
            $image_crop.croppie('bind', {
                url: e.target.result
            }).then(function(){
                console.log('File Berhasil Terbaca');
            });			
        }
        reader.readAsDataURL(this.files[0]);
    });

    $('.cropped_image').on('click', function (ev) {
        $image_crop.croppie('result', {
            type: 'canvas',
            size: 'viewport'
        }).then(function (response) {
            $.ajax({
                url: "{{url('sellers/setting/toko/logo')}}",
                type: "POST",
                data: {'logo_toko':response, '_token': "{{csrf_token()}}"},
                success: function (data) {
                    swal(data.pesan)
                    .then((result) => {
                        location.reload();
                    });
                }
            });
        });
    });	
});
</script>
@endsection
