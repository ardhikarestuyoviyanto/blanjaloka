@extends('sellers/master-sellers')
@section('content')
<link rel="stylesheet" href="{{asset('template/admin/css/product.css')}}">
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Tambah Produk Baru</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Tambah Produk Baru</li>
                </ol>
            </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <form id="insertprodukform" method="POST">

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
                                        <option value="{{$k->id_kategori}}">- {{$k->nama_kategori}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="nama_produk" class="col-sm-2 col-form-label">Nama Produk</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nama_produk" placeholder="Nama produk" required>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="nama_produk" class="col-sm-2 col-form-label">Total Produk</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <input type="number" class="form-control" name="jumlah_produk" placeholder="Total Produk" required>
                                    <div class="input-group-append">
                                        <select name="id_satuanproduk" id="" required class="form-control input-group-text bg-white">
                                            @foreach($satuanproduk as $s)
                                                <option value="{{$s->id_satuanproduk}}">{{$s->nama_satuan}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="nis" class="col-sm-2 col-form-label">Deskripsi</label>
                            <div class="col-sm-10">
                                <textarea name="deskripsi" class="form-control" cols="8" rows="8" required placeholder="Tuliskan Deskripsi Produk"></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="nama_alumni" class="col-sm-2 col-form-label">Status Produk</label>
                            <div class="col-sm-10">
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input role" type="radio" name="status_produk" id="flexRadioDefault99" required value="on">
                                    <label class="custom-control-label" for="flexRadioDefault99" style="font-weight: normal;">
                                        Tampilkan
                                    </label>
                                    </div>
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input role" type="radio" name="status_produk" id="flexRadioDefault88" required value="off">
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
                                    <input type="text" class="form-control" name="berat_produk" id="berat_produk" placeholder="Berat Produk" required>
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
                                    <input type="text" class="form-control" name="harga" id="harga" placeholder="Harga Produk" required>
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
                                    <input type="text" class="form-control" name="potongan_harga" id="diskon" placeholder="Diskon Harga Produk" required value="0">
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
                                    <div class="col-sm-1">
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
                                            <input id="file-input" name="foto_produk[]" type="file" data-id="1" required/>
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
                                                        </div>
                                                    </div>
                                                  </label>
                                            <input id="file-input4" name="foto_produk[]" type="file" data-id="4"/>
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
                                                        </div>
                                                    </div>
                                                  </label>
                                            <input id="file-input5" name="foto_produk[]" type="file" data-id="5"/>
                                          </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary mb-3">Simpan Produk</button>

                </div>

            </form>

        </div>
    </section>
</div>


<script>
$('body').tooltip({selector: '[data-toggle="tooltip"]'});

//--------------------------------------------------------------------------

$('#insertprodukform').submit(function(e){
    e.preventDefault();
    $.ajax({
        url: "{{ url('sellers/produk/insert') }}",
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
                title: "Produk Berhasil Tersimpan",
                text: "Apakah anda mau input produk lagi ?",
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
                    $('#insertprodukform').trigger("reset");
                    $('#persendiskon').text('');
                    $('#btn-dlt-5').trigger("click");
                    $('#btn-dlt-4').trigger("click");
                    $('#btn-dlt-3').trigger("click");
                    $('#btn-dlt-2').trigger("click");
                    $('#btn-dlt-1').trigger("click");
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

//-------------------------------------------------------------------------------------------------

</script>
@endsection