@extends('admin/master-admin')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tambah Data Driver</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('admin/driver')}}">Data Driver</a></li>
                            <li class="breadcrumb-item active">Tambah Data Driver</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">

                <div class="card">
                    <div class="card-header">
                        Tambah Data Driver
                    </div>

                        <form action="{{ url('admin/users/driver/insert') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="mb-3 row">
                                    <label for="nis" class="col-sm-2 col-form-label">Nama Driver</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="nama_driver" placeholder="Nama Driver" required>
                                    </div>
                                </div>
                
                                <div class="mb-3 row">
                                    <label for="nis" class="col-sm-2 col-form-label">No. Telp</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="no_telp" placeholder="No. Telp" required>
                                    </div>
                                </div>
                                
                                <div class="mb-3 row">
                                    <label for="nis" class="col-sm-2 col-form-label">Alamat Driver</label>
                                    <div class="col-sm-10">
                                        <textarea name="alamat" class="form-control" cols="6" rows="4" placeholder="Alamat Lengkap Driver" required>{{old('alamat')}}</textarea>
                                    </div>
                                </div>
            
                                <div class="mb-3 row">
                                    <label for="nis" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" name="tgl_lahir" placeholder="No. Telp" required>
                                    </div>
                                </div>
            
                                <div class="mb-3 row">
                                    <label for="nis" class="col-sm-2 col-form-label">Nama Kendaraan</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="kendaraan" placeholder="Nama Kendaraan" required>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="nis" class="col-sm-2 col-form-label">No. KTP</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="no_ktp" placeholder="Nomor KTP" required>
                                    </div>
                                </div>

                                <div class="mb-3 row control-group">
                                    <label for="nis" class="col-sm-2 col-form-label">Foto STNK</label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <input type="file" name="foto_stnk[]" class="form-control filefoto" required accept=".png,.jpg">
                                            <div class="input-group-prepend"> 
                                              <button class="btn btn-success addfile" type="button"><i class="fas fa-plus"></i> Add</button>
                                            </div>     
  
                                        </div>
                                        @if ($errors->has('foto_stnk.*'))
                                        <div class="text-danger text-small text-muted">
                                            @foreach ($errors->get('foto_stnk.*') as $err)
                                                <span class="text-danger">@php print_r($err[0]) @endphp</span>
                                            @endforeach
                                        </div>
                                        @endif  
                                    </div>
                                </div>

                                <div class="fileadd"></div>


                            </div>

                        <div class="card-footer">
                            <button class="btn btn-primary" style="float: right">Simpan</button>
                        </div>
                    </form>
                </div>

            </div>
        </section>
    </div>

{{-- Notif Jika Data Pasar Berhasil Dibuat --}}
@if ($status = Session::get('success'))
<script>
    swal("{{$status}}")
</script>
@endif

<script>
    $(document).ready(function(){
        $('.addfile').click(function(){
            var html = '';
            html += '<div class="mb-3 row control-group" id="removefile">';
            html += '<label for="nis" class="col-sm-2 col-form-label"></label>';
            html += '<div class="col-sm-10 input-group">';
            html += '<input type="file" name="fotopasar[]" accept=".png,.jpg" class="form-control filefoto" required>';
            html += '<div class="input-group-prepend">';
            html += '<button class="btn btn-danger deletefile" type="button"><i class="fas fa-times"></i> Remove</button>';
            html += '</div></div></div>';

            $('.fileadd').append(html);
        });

        $("body").on("click",".deletefile",function(){ 
            $(this).closest('#removefile').remove();
        });

    });
</script>

@endsection
