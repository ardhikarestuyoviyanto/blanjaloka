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
                @foreach($customers as $c)
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="container">
                            <div class="text-center">
                                <img src="{{url('assets/admin/foto_customers/'.$c->fotoprofil)}}" alt="" class="img-fluid" width="120" height="120">
                                <br>
                                <a href="#" class="btn btn btn-light mt-3 mb-3" data-bs-toggle="modal" data-bs-target="#modalupdatefoto" type="button" style="background-color:white; border: 2px solid #d9d9d9">Pilih Gambar</a>
                                <br>
                                <small class="text-muted mt-5">
                                    Ukuran gambar: maks. 1 MB <br>
                                    Format gambar: .JPEG, .PNG
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                <div class="list-group mb-3">
                    <a href="{{url('setting/profil')}}" class="list-group-item list-group-item-action active" aria-current="true">Profil Saya</a>
                    <a href="{{url('setting/alamat')}}" class="list-group-item list-group-item-action">Alamat Pengiriman</a>
                    <a href="{{url('setting/ubahpassword')}}" class="list-group-item list-group-item-action">Ubah Password</a>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header bg-light">
                        <b>Profil Saya</b> <br>
                        <small>Kelola informasi profil Anda untuk mengontrol, melindungi dan mengamankan akun</small>
                    </div>
                    @foreach($customers as $c)
                    <form action="{{url('setting/profil/update')}}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" placeholder="Nama Lengkap" name="nama_user" required value="{{$c->nama_user}}">
                                <label for="floatingInput">Nama Lengkap</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="floatingInput" placeholder="Email" required name="email" required value="{{$c->email}}">
                                <label for="floatingInput">Email</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" id="floatingInput" placeholder="No Telpon" required name="no_telp" value="{{$c->no_telp}}">
                                <label for="floatingInput">No Telpon</label>
                                @if ($errors->has('no_telp'))
                                    <div class="text-danger text-small">
                                        @foreach ($errors->get('no_telp') as $err)
                                            {{ $err }}
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                            <div class="form-floating mb-3">
                                <select class="form-select" id="floatingSelect" aria-label="Jenis Kelamin" name="jeniskelamin" required>
                                    <option value="" selected> Jenis Kelamin </option>
                                    <option value="Laki - Laki" @if($c->jeniskelamin == 'Laki - Laki') selected @endif>Laki - Laki</option>
                                    <option value="Perempuan" @if($c->jeniskelamin == 'Perempuan') selected @endif>Perempuan</option>
                                </select>
                                <label for="floatingSelect">Jenis Kelamin</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="date" class="form-control" id="floatingInput" required name="tgl_lahir" value="{{$c->tgl_lahir}}">
                                <label for="floatingInput">Tanggal Lahir</label>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalupdatefoto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Update Foto Profil</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="updatefotoform">
                @csrf
                <div class="modal-body">
                    <div id="upload-image"></div>
                    <div class="mt-3">
                        <input class="form-control" type="file" id="images" name="fotoprofil" required accept=".png,.jpg">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary cropped_image">Crop and Save</button>
                </div>
            </form>
          </div>
        </div>
    </div>

</section>

{{-- Notif Jika Akun Berhasil Diiupdate --}}
@if ($status = Session::get('success'))
<script>
    swal("{{$status}}")
</script>
@endif

<script>
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
			url: "{{url('setting/profil/updatefoto')}}",
			type: "POST",
			data: {'fotoprofil':response, '_token': "{{csrf_token()}}"},
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