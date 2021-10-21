@extends('admin/master-admin')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tambah Data Pasar</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('admin/pasar')}}">Data Pasar</a></li>
                            <li class="breadcrumb-item active">Tambah Data Pasar</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">

                <div class="card">
                    <div class="card-header">
                        Tambah Data Pasar
                    </div>

                        <form action="{{url('admin/pasar/addhandler')}}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="mb-3 row">
                                    <label for="nis" class="col-sm-2 col-form-label">No Pasar</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="no_pasar" placeholder="Nomor Pasar" required value="{{old('no_pasar')}}">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="nis" class="col-sm-2 col-form-label">Nama Pasar</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="nama_pasar" placeholder="Nama Pasar" required value="{{old('nama_pasar')}}">
                                    </div>
                                </div>
                                
                                <div class="mb-3 row">
                                    <label for="nis" class="col-sm-2 col-form-label">Pengelola Pasar</label>
                                    <div class="col-sm-10">
                                        <select class="custom-select" required name="id_pengelolapasar" id="id_pengelolapasar">
                                            <option selected value="">- PILIH PENGELOLA PASAR -</option>
                                            @foreach($pengelola as $p)
                                                @if(count(DB::table('pasar')->where('id_pengelolapasar', $p->id_pengelolapasar)->get()) == 0)
                                                    <option value="{{$p->id_pengelolapasar}}">- {{$p->nama}} / {{$p->jabatan}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="nis" class="col-sm-2 col-form-label">Maksimal Lapak</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="max_lapak" placeholder="Maksimal Lapak" required value="{{old('max_lapak')}}">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="nis" class="col-sm-2 col-form-label">Maksimal Pengunjung</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="max_pengunjung" placeholder="Maksimal Pengunjung" required value="{{old('max_pengunjung')}}">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="nis" class="col-sm-2 col-form-label">Alamat Pasar</label>
                                    <div class="col-sm-10">
                                        <textarea name="alamat" class="form-control" cols="6" rows="4" placeholder="Alamat Lengkap Pasar" required>{{old('alamat')}}</textarea>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="nis" class="col-sm-2 col-form-label">Deskripsi Pasar</label>
                                    <div class="col-sm-10">
                                        <textarea name="deskripsi" class="form-control" cols="6" rows="4" placeholder="Deskripsi Pasar" required>{{old('deskripsi')}}</textarea>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="nis" class="col-sm-2 col-form-label">Lokasi Pasar</label>
                                    <div class="col-sm-10">
                                        <textarea name="embbed_maps" class="form-control" cols="6" rows="4" placeholder="Embedded Maps" required placeholder="Embedded Maps">{{old('embbed_maps')}}</textarea>
                                        <small><a target="__BLANK" href="https://google-map-generator.com/">Info Lebih lanjut mengenai Embedded maps</a></small>
                                    </div>
                                </div>
                                <div class="mb-3 row control-group">
                                    <label for="nis" class="col-sm-2 col-form-label">Foto Pasar</label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <input type="file" name="fotopasar[]" class="form-control filefoto" required accept=".png,.jpg">
                                            <div class="input-group-prepend"> 
                                              <button class="btn btn-success addfile" type="button"><i class="fas fa-plus"></i> Add</button>
                                            </div>     
  
                                        </div>
                                        @if ($errors->has('fotopasar.*'))
                                        <div class="text-danger text-small text-muted">
                                            @foreach ($errors->get('fotopasar.*') as $err)
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
