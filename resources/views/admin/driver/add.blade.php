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
                            <li class="breadcrumb-item"><a href="{{url('admin/users/driver')}}">Data Driver</a></li>
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
                                        <input type="text" class="form-control" name="nama_driver" placeholder="Nama Driver" required value="{{old('nama_driver')}}">
                                    </div>
                                </div>
                
                                <div class="mb-3 row">
                                    <label for="nis" class="col-sm-2 col-form-label">No. Telp</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" name="no_telp" placeholder="No. Telp" required value="{{old('no_telp')}}">
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
                                        <input type="date" class="form-control" name="tgl_lahir" placeholder="No. Telp" required value="{{old('tgl_lahir')}}">
                                    </div>
                                </div>
            
                                <div class="mb-3 row">
                                    <label for="nis" class="col-sm-2 col-form-label">Nama Kendaraan</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="kendaraan" placeholder="Nama Kendaraan" required value="{{old('kendaraan')}}">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="nis" class="col-sm-2 col-form-label">No. KTP</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="no_ktp" placeholder="Nomor KTP" required value="{{old('no_ktp')}}">
                                    </div>
                                </div>

                                <div class="mb-3 row control-group">
                                    <label for="nis" class="col-sm-2 col-form-label">Foto STNK</label>
                                    <div class="col-sm-10">
                                        <input type="file" name="foto_stnk" class="form-control" required accept=".png,.jpg">   
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
                </div>

            </div>
        </section>
    </div>

{{-- Notif Jika Data Driver Berhasil Dibuat --}}
@if ($status = Session::get('success'))
<script>
    swal("{{$status}}")
</script>
@endif

@endsection
