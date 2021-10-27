@extends('admin/master-admin')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Data Driver</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('admin/users/driver')}}">Data Driver</a></li>
                            <li class="breadcrumb-item active">Edit Data Driver</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">

                <div class="card">
                    <div class="card-header">
                        Edit Data Driver
                    </div>
                        @foreach ($driver as $d)
                            <form action="{{ url('admin/users/driver/update') }}" enctype="multipart/form-data" method="POST">
                                @csrf
                                <input type="hidden" name="id_driver" value="{{$d->id_driver}}">
                                <div class="card-body">
                                    <div class="mb-3 row">
                                        <label for="nis" class="col-sm-2 col-form-label">Nama Driver</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" value="{{ $d->nama_driver }}" name="nama_driver" placeholder="Nama Driver" required>
                                        </div>
                                    </div>
                    
                                    <div class="mb-3 row">
                                        <label for="nis" class="col-sm-2 col-form-label">No. Telp</label>
                                        <div class="col-sm-10">
                                            <input type="text" value="{{ $d->no_telp }}" class="form-control" name="no_telp" placeholder="No. Telp" required>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3 row">
                                        <label for="nis" class="col-sm-2 col-form-label">Alamat Driver</label>
                                        <div class="col-sm-10">
                                            <textarea name="alamat" class="form-control" cols="6" rows="4" placeholder="Alamat Lengkap Driver" required>{{ $d->alamat }}</textarea>
                                        </div>
                                    </div>
                
                                    <div class="mb-3 row">
                                        <label for="nis" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                                        <div class="col-sm-10">
                                            <input type="date" value="{{ $d->tgl_lahir }}" class="form-control" name="tgl_lahir" placeholder="No. Telp" required>
                                        </div>
                                    </div>
                
                                    <div class="mb-3 row">
                                        <label for="nis" class="col-sm-2 col-form-label">Nama Kendaraan</label>
                                        <div class="col-sm-10">
                                            <input type="text" value="{{ $d->kendaraan }}" class="form-control" name="kendaraan" placeholder="Nama Kendaraan" required>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label for="nis" class="col-sm-2 col-form-label">No. KTP</label>
                                        <div class="col-sm-10">
                                            <input type="text" value="{{ $d->no_ktp }}" class="form-control" name="no_ktp" placeholder="Nomor KTP" required>
                                        </div>
                                    </div>

                                    <div class="mb-3 row control-group">
                                        <label for="nis" class="col-sm-2 col-form-label">Foto STNK</label>
                                        <div class="col-sm-10">
                                            <input type="file" name="foto_stnk" class="form-control" accept=".png,.jpg"> 
                                            <small id="emailHelp" class="form-text text-muted">
                                                <a href="{{url('assets/admin/foto_stnk/'.$d->foto_stnk)}}" data-toggle="lightbox" data-title="Foto STNK" data-gallery="gallery">
                                                    <i>Foto Terpsang : {{$d->foto_stnk}}</i>                                        
                                                </a>  
                                            </small>  
                                            @if ($errors->has('foto_stnk'))
                                                <div class="text-danger text-small text-muted">
                                                    @foreach ($errors->get('foto_stnk') as $err)
                                                        <span class="text-danger">{{ $err }}</span>
                                                    @endforeach
                                                </div>
                                            @endif  
                                        </div>
                                    </div>


                                </div>

                                <div class="card-footer">
                                    <button class="btn btn-primary" style="float: right">Simpan</button>
                                </div>
                            </form>
                        @endforeach
                </div>

            </div>
        </section>
    </div>

{{-- Notif Jika Data Driver Berhasil Diedit --}}
@if ($status = Session::get('success'))
<script>
    swal("{{$status}}")
</script>
@endif
<script>
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox({
            alwaysShowClose: true
        });
    });
</script>
@endsection
