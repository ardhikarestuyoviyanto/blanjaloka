@extends('admin/master-admin')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Data Pasar</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('admin/pasar')}}">Data Pasar</a></li>
                            <li class="breadcrumb-item active">Edit Data Pasar</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">

                <div class="card">
                    <div class="card-header">
                        Edit Data Pasar
                    </div>
                        @foreach ($pasar as $p)                            
                            <form action="{{url('admin/pasar/edithandler')}}" enctype="multipart/form-data" method="POST">
                                @csrf
                                <input type="hidden" name="id_pasar" value="{{$p->id_pasar}}">
                                <div class="card-body">
                                    <div class="mb-3 row">
                                        <label for="nis" class="col-sm-2 col-form-label">Nama Pasar</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="nama_pasar" placeholder="Nama Pasar" required value="{{$p->nama_pasar}}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="nis" class="col-sm-2 col-form-label">Alamat Pasar</label>
                                        <div class="col-sm-10">
                                            <textarea name="alamat" class="form-control" cols="6" rows="4" placeholder="Alamat Lengkap Pasar" required>{{$p->alamat}}</textarea>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="nis" class="col-sm-2 col-form-label">Deskripsi Pasar</label>
                                        <div class="col-sm-10">
                                            <textarea name="deskripsi" class="form-control" cols="6" rows="4" placeholder="Deskripsi Pasar" required>{{$p->deskripsi}}</textarea>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="nis" class="col-sm-2 col-form-label">Lokasi Pasar</label>
                                        <div class="col-sm-10">
                                            <textarea name="embbed_maps" class="form-control" cols="6" rows="4" placeholder="Embedded Maps" required placeholder="Embedded Maps">{{$p->embbed_maps}}</textarea>
                                            <small><a target="__BLANK" href="https://google-map-generator.com/">Info Lebih lanjut mengenai Embedded maps</a></small> <br>
                                            <iframe src="{{$p->embbed_maps}}" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                                        </div>
                                    </div>
                                    <div class="mb-3 row control-group">
                                        <label for="nis" class="col-sm-2 col-form-label">Foto Pasar</label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <input type="file" name="fotopasar[]" class="form-control filefoto" accept=".png,.jpg">
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
                                    <div class="mb-3 row">
                                        <label for="nis" class="col-sm-2 col-form-label"></label>
                                        <div class="col-sm-10">
                                            <ul class="list-group list-group-flush mt-2">
                                                @if($p->foto_pasar != null)
                                                    <li class="list-group-item text-bold">Foto Pasar</li>
                                                    @php
                                                        $arr_fotopasar = explode(',', $p->foto_pasar);
                                                    @endphp
                                                    @for($i=0; $i<count($arr_fotopasar); $i++)
                                                        <li class="list-group-item"><a title="Hapus" class="hapusfotopasar" data-id="{{$p->id_pasar}}" data-index="{{$i}}" data-foto_pasar="{{$p->foto_pasar}}" data-toggle="tooltip" href="#" style="color: red"><i class="fas fa-trash"></i></a>&nbsp;&nbsp;<a target="_blank" href="{{url('assets/admin/foto_pasar/'.$arr_fotopasar[$i])}}">{{$arr_fotopasar[$i]}}</a></li>
                                                    @endfor
                                                @endif

                                            </ul>
                                        </div>
                                    </div>

                                </div>

                            <div class="card-footer">
                                <button class="btn btn-primary" style="float: right">Update</button>
                            </div>
                        </form>
                    @endforeach
                </div>

            </div>
        </section>
    </div>

{{-- Notif Jika Data Pasar Berhasil Diedit --}}
@if ($status = Session::get('success'))
<script>
    swal("{{$status}}")
</script>
@endif

<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
        $('.addfile').click(function(){
            var html = '';
            html += '<div class="mb-3 row control-group" id="removefile">';
            html += '<label for="nis" class="col-sm-2 col-form-label"></label>';
            html += '<div class="col-sm-10 input-group">';
            html += '<input type="file" name="fotopasar[]" accept=".png,.jpg" class="form-control filefoto">';
            html += '<div class="input-group-prepend">';
            html += '<button class="btn btn-danger deletefile" type="button"><i class="fas fa-times"></i> Remove</button>';
            html += '</div></div></div>';

            $('.fileadd').append(html);
        });

        $("body").on("click",".deletefile",function(){ 
            $(this).closest('#removefile').remove();
        });

        //hapus fotopasar
        $('.hapusfotopasar').click(function(e){

            e.preventDefault();

            var confirmed = confirm('Hapus foto pasar ini ?');

            if(confirmed) {

                $.ajax({
                    data: {'id_pasar': $(this).data('id'), '_token': "{{csrf_token()}}", 'foto_pasar':$(this).data('foto_pasar'), 'index':$(this).data('index')},
                    type: 'POST',
                    url:"{{url('admin/pasar/hapusfoto')}}",
                    success : function(data){
                        swal(data.pesan)
                        .then((result) => {
                            location.reload();
                        });
                    },
                    error : function(err){
                        alert(err);
                        console.log(err);
                    }
                });

            }

        });

    });
</script>

@endsection
