@extends('sellers/master-sellers')
@section('content')
<link rel="stylesheet" href="{{asset('template/admin/css/product.css')}}">
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Produk</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('sellers/produk')}}">Produk Saya</a></li>
                    <li class="breadcrumb-item active">Edit Produk</li>
                </ol>
            </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            @foreach($produk as $p)
            <form id="updateprodukform">

                <div class="card">
                    <div class="card-header">
                        Informasi Produk
                    </div>
                    @csrf
                    <div class="card-body">
                        
                        <div class="mb-3 row">
                            <label for="nis" class="col-sm-2 col-form-label">Kategori Produk</label>
                            <div class="col-sm-10">
                                <select class="custom-select" required name="id_kategoriproduk" id="id_kategoriproduk">
                                    <option selected value="">- PILIH KATEGORI PRODUK -</option>
                                    @foreach($kategori as $k)
                                        @if($p->id_kategoriproduk == $k->id_kategori)
                                            <option selected value="{{$k->id_kategori}}">- {{$k->nama_kategori}}</option>
                                        @else
                                            <option value="{{$k->id_kategori}}">- {{$k->nama_kategori}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="id_produk" id="id_produk" value="{{$p->id_produk}}">
                        <div class="mb-3 row">
                            <label for="nama_produk" class="col-sm-2 col-form-label">Nama Produk</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nama_produk" placeholder="Nama produk" required value="{{$p->nama_produk}}">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="nama_produk" class="col-sm-2 col-form-label">Total Produk</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <input type="number" class="form-control" name="jumlah_produk" placeholder="Total Produk" required value="{{$p->jumlah_produk}}">
                                    <div class="input-group-append">
                                        <select name="id_satuanproduk" id="" required class="form-control input-group-text bg-white">
                                            @foreach($satuanproduk as $s)
                                                @if($p->id_satuanproduk == $s->id_satuanproduk)
                                                    <option selected value="{{$s->id_satuanproduk}}">{{$s->nama_satuan}}</option>
                                                @else
                                                    <option value="{{$s->id_satuanproduk}}">{{$s->nama_satuan}}</option>
                                                @endif  
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="nis" class="col-sm-2 col-form-label">Deskripsi</label>
                            <div class="col-sm-10">
                                <textarea name="deskripsi" class="form-control" cols="8" rows="8" required placeholder="Tuliskan Deskripsi Produk">{{$p->deskripsi}}</textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="nama_alumni" class="col-sm-2 col-form-label">Status Produk</label>
                            <div class="col-sm-10">
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input role" type="radio" name="status_produk" id="flexRadioDefault99" required value="on" @if($p->status_produk == 'on') checked @endif>
                                    <label class="custom-control-label" for="flexRadioDefault99" style="font-weight: normal;">
                                        Tampilkan
                                    </label>
                                    </div>
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input role" type="radio" name="status_produk" id="flexRadioDefault88" required value="off" @if($p->status_produk == 'off') checked @endif>
                                    <label class="custom-control-label" for="flexRadioDefault88" style="font-weight: normal;">
                                        Arsipkan
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="nama_produk" class="col-sm-2 col-form-label">Berat Produk</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="berat_produk" id="berat_produk" placeholder="Berat Produk" required value="{{$p->berat_produk}}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">.gram</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>  
                </div>

                <div class="card">
                    <div class="card-header">
                        Informasi Harga Produk
                    </div>
                    <div class="card-body">
                        <div class="mb-3 row">
                            <label for="nama_produk" class="col-sm-2 col-form-label">Harga Produk</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input type="text" class="form-control" name="harga" id="harga" placeholder="Harga Produk" required value="{{$p->harga}}">
                                </div>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="nama_produk" class="col-sm-2 col-form-label">Diskon</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input type="text" class="form-control" name="potongan_harga" id="diskon" placeholder="Diskon Harga Produk" required value="{{$p->potongan_harga}}">
                                </div>
                                <small class="form-text text-muted italic text-red text-bold" id="persendiskon"></small>
                                <small class="form-text text-muted italic text-bold">Salah satu strategi pemasaran yang terbukti efektif meningkatkan penjualan.</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        Informasi Foto Produk
                    </div>
                    <div class="card-body">
                        <div class="mb-3 row">
                            <label for="nama_produk" class="col-sm-2 col-form-label">Foto Produk</label>
                            <div class="col-sm-10">
                                <div class="row">
                                    <input type="hidden" id="filefoto" value="{{$p->foto_produk}}">
                                    <div class="col-sm-1">
                                        <div class="image-upload">
                                            <label for="file-input">
                                                   <div class="upload-icon">
                                                        <img class="icon" src="https://image.flaticon.com/icons/png/128/61/61112.png">
                                                        <img class="prev" src="https://image.flaticon.com/icons/png/128/61/61112.png">
                                                    </div>
                                            </label>
                                            <input id="file-input" name="foto_produk[]" type="file" data-id="1"/>
                                        </div>
                                    </div>
                                    <div class="col-sm-1">
                                        <div class="image-upload">
                                            <label for="file-input5">
                                                   <div class="upload-icon">
                                                        <img class="icon" src="https://image.flaticon.com/icons/png/128/61/61112.png">
                                                        <img class="prev" src="https://image.flaticon.com/icons/png/128/61/61112.png">
                                                        <div class="text-center mt-2">
                                                            <a href="#" id="btn-dlt-5" class="hidden" data-toggle="tooltip" data-placement="right" title="hapus"><i class="fas fa-trash text-danger"></i></a>
                                                            <a href="#" id="btn-dlt-server-5" class="hidden dlt-img" data-toggle="tooltip" data-placement="right" title="hapus"><i class="fas fa-trash text-danger"></i></a>
                                                        </div>
                                                    </div>
                                                  </label>
                                            <input id="file-input5" name="foto_produk[]" type="file" data-id="5"/>
                                          </div>
                                    </div>
                                    <div class="col-sm-1">
                                        <div class="image-upload">
                                            <label for="file-input2">
                                                   <div class="upload-icon">
                                                        <img class="icon" src="https://image.flaticon.com/icons/png/128/61/61112.png">
                                                        <img class="prev" src="https://image.flaticon.com/icons/png/128/61/61112.png">
                                                        <div class="text-center mt-2">
                                                            <a href="" id="btn-dlt-2" class="hidden btn-dlt" data-toggle="tooltip" data-placement="right" title="hapus"><i class="fas fa-trash text-danger"></i></a>
                                                            <a href="#" id="btn-dlt-server-2" class="hidden dlt-img" data-toggle="tooltip" data-placement="right" title="hapus"><i class="fas fa-trash text-danger"></i></a>
                                                        </div>
                                                    </div>
                                                  </label>
                                            <input id="file-input2" name="foto_produk[]" type="file" data-id="2"/>
                                          </div>
                                    </div>
                                    <div class="col-sm-1">
                                        <div class="image-upload">
                                            <label for="file-input3">
                                                   <div class="upload-icon">
                                                        <img class="icon" src="https://image.flaticon.com/icons/png/128/61/61112.png">
                                                        <img class="prev" src="https://image.flaticon.com/icons/png/128/61/61112.png">
                                                        <div class="text-center mt-2">
                                                            <a href="" id="btn-dlt-3" class="hidden btn-dlt" data-toggle="tooltip" data-placement="right" title="hapus"><i class="fas fa-trash text-danger"></i></a>
                                                            <a href="#" id="btn-dlt-server-3" class="hidden dlt-img" data-toggle="tooltip" data-placement="right" title="hapus"><i class="fas fa-trash text-danger"></i></a>
                                                        </div>
                                                    </div>
                                                  </label>
                                            <input id="file-input3" name="foto_produk[]" type="file" data-id="3"/>
                                          </div>
                                    </div>
                                    <div class="col-sm-1">
                                        <div class="image-upload">
                                            <label for="file-input4">
                                                   <div class="upload-icon">
                                                        <img class="icon" src="https://image.flaticon.com/icons/png/128/61/61112.png">
                                                        <img class="prev" src="https://image.flaticon.com/icons/png/128/61/61112.png">
                                                        <div class="text-center mt-2">
                                                            <a href="" id="btn-dlt-4" class="hidden btn-dlt" data-toggle="tooltip" data-placement="right" title="hapus"><i class="fas fa-trash text-danger"></i></a>
                                                            <a href="#" id="btn-dlt-server-4" class="hidden dlt-img" data-toggle="tooltip" data-placement="right" title="hapus"><i class="fas fa-trash text-danger"></i></a>
                                                        </div>
                                                    </div>
                                                  </label>
                                            <input id="file-input4" name="foto_produk[]" type="file" data-id="4"/>
                                          </div>
                                    </div>
 
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary mb-3">Update Produk</button>

                </div>
            </form>
            @endforeach
        </div>
    </section>
</div>
<script>
    $('body').tooltip({selector: '[data-toggle="tooltip"]'});
    
    //--------------------------------------------------------------------------
    
    $('#updateprodukform').submit(function(e){
        e.preventDefault();
        $.ajax({
            url: "{{ url('sellers/produk/update') }}",
            type: "POST",
            data: new FormData(this),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $.LoadingOverlay("show");
            },
            complete: function() {
                $.LoadingOverlay("hide");
            },
            success: function(data) {
                swal({
                    title: "Produk Berhasil Diupdate",
                    text: "Apakah anda mau update produk ini lagi ?",
                    icon: "success",
                    buttons: {
                        cancel: "Tidak",
                        defeat: "Ya",
                    },
                })
                .then((value) => {
                    console.log(value);
                    switch (value) {
     
                    case null:
                        window.location.href = "{{ url('sellers/produk')}}";
                    break;
    
                    default:
                        location.reload();
                    }
                });
            },
            error: function(err) {
                alert(err);
            }
        });
    });
    
    //----------------------------------------------------------------------------------------------
    
    $('#harga').on('keyup', function(e){
        var n = parseInt($(this).val().replace(/\D/g,''),10);
        $(this).val(n.toLocaleString());
    });
    
    //--------------------------------------------------------------------------------------
    
    $('#diskon').on('keyup', function(e){
    
        var n = parseInt($(this).val().replace(/\D/g,''),10);
        $(this).val(n.toLocaleString());
    
        var harga = parseInt($('#harga').val().split(",").join(""));
        var diskon = parseInt($(this).val().split(",").join(""));
    
        if(diskon > harga){
            swal("Peringatan", "Harga Diskon Tidak Boleh Lebih Besar dari Harga Produk", "warning");
            $(this).val('');
            $('#persendiskon').text('');
        }
    
        var persendiskon = (diskon / harga) * 100;
    
        $('#persendiskon').text('Diskon '+persendiskon.toFixed(0)+' %');
    
    });
    
    //-----------------------------------------------------------------------------------
    
    $('#berat_produk').on('keyup', function(e){
        var n = parseInt($(this).val().replace(/\D/g,''),10);
        $(this).val(n.toLocaleString());
    });
    
    //-----------------------------------------------------------------------------------------
    
    function readURL(input) {
      var id = $(input).attr("id");
      var upld = input.files[0].type;
      console.log(input.files[0]);
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
    
    //--------------------------------------------------------------------
    $('input[type=file]').on('change', function(e){
        var myFile = $(this).val();
        var upld = myFile.split('.').pop().toLowerCase();
        if (upld == 'png' || upld == 'jpg' || upld == 'jpeg') {
            if($(this).data('id') == 1){
                $('#btn-dlt-1').show();
            }else if($(this).data('id') == 2){
                $('#btn-dlt-2').show();
            }else if($(this).data('id') == 3){
                $('#btn-dlt-3').show();
            }else if($(this).data('id') == 4){
                $('#btn-dlt-4').show();
            }else if($(this).data('id') == 5){
                $('#btn-dlt-5').show();
            }
    
        }else{
            swal("Peringatan", "Foto Produk Harus Berektensi .png atau .jpg", "warning");
            $(this).val('');
            $('.prev').css('display', 'none');
    
        }
    });
    //----------------------------------------------------------------------------
    $('#btn-dlt-5').click(function(e){
        e.preventDefault();
        $('#file-input5').val('');
        $('label[for="file-input5"] .upload-icon').css({"border": "2px solid #5642BE", "border-style":"dotted"});
        $('label[for="file-input5"] .icon').show();
        $('label[for="file-input5"] .prev').hide();
        $('#btn-dlt-5').hide();
    });
    
    $('#btn-dlt-4').click(function(e){
        e.preventDefault();
        $('#file-input4').val('');
        $('label[for="file-input4"] .upload-icon').css({"border": "2px solid #5642BE", "border-style":"dotted"});
        $('label[for="file-input4"] .icon').show();
        $('label[for="file-input4"] .prev').hide();
        $('#btn-dlt-4').hide();
    });
    
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

    //----------------------------------------------------------------------------------------------

    $('.dlt-img').click(function(e){
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
                    data:{'id_produk':$(this).data('id_produk'), 'index':$(this).data('index'), '_token': "{{csrf_token()}}"},
                    url: "{{ url('sellers/produk/delete/foto') }}",
                    type: "POST",
                    success: function(e){
                        location.reload();
                    }
                });
            }
        });
    });
    
    //-------------------------------------------------------------------------------------------------
    
    $(function(){
        var fileget = $('#filefoto').val();
        var file = fileget.split(',');

        for (let i=0; i<file.length; i++){

            fetch("{{asset('assets/admin/foto_produk/')}}"+'/'+file[i])
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
                        $('label[for=file-input5] .upload-icon').css("border", "none");
                        $('label[for=file-input5] .icon').hide();
                        $('label[for=file-input5] .prev').attr('src',  file).show();  
                        $('#btn-dlt-server-5').attr({
                            "data-index": 1,
                            "data-id_produk": $('#id_produk').val()
                        });
                        $('#btn-dlt-server-5').show();
                    }else{

                        $('label[for=file-input' + i + '] .upload-icon').css("border", "none");
                        $('label[for=file-input' + i + '] .icon').hide();
                        $('label[for=file-input' + i + '] .prev').attr('src',  file).show();
                        $('#btn-dlt-server-'+i).attr({
                            "data-index": i,
                            "data-id_produk": $('#id_produk').val()
                        });
                        $('#btn-dlt-server-'+i).show();
                    }         

                }

                reader.readAsDataURL(blob);

            });
        }   

    });

    </script>
@endsection