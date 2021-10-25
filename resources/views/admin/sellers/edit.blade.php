@extends('admin/master-admin')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Sellers</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('admin/users/sellers')}}">Data Sellers</a></li>
                        <li class="breadcrumb-item active">Edit Sellers</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            {{-- Notif Jika Sellers Berhasil Diedit --}}
            @if ($status = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <b>{{$status}}</b>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            <div class="card">
                <div class="card-header">
                    Edit Data Sellers
                    <a href="{{url('admin/users/sellers/datasensitive/'.$id_penjual)}}" style="float: right" class="btn btn-info btn-sm"><i class="fas fa-key"></i> Lihat Data Sensitive</a>
                </div>

                @foreach($sellers as $s)
                <form action="{{url('admin/users/sellers/edithandler')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id_penjual" value="{{$s->id_penjual}}">
                    <div class="card-body">
                        <div class="mb-3 row">
                            <label for="nis" class="col-sm-2 col-form-label">No Toko</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="no_toko" placeholder="Nomor Toko" value="{{$s->no_toko}}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="nis" class="col-sm-2 col-form-label">Nama Sellers</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control bg-white" name="nama_user" placeholder="Nama Sellers" readonly value="{{$s->nama_user}}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="nis" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control bg-white" name="email" placeholder="Email Sellers" readonly value="{{$s->email}}">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="nis" class="col-sm-2 col-form-label">Nama Toko</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nama_toko" placeholder="Nama Toko" value="{{$s->nama_toko}}" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="nis" class="col-sm-2 col-form-label">Kategori Toko</label>
                            <div class="col-sm-10">
                                <select class="custom-select" required name="id_kategoritoko" required>
                                    <option selected value="">Pilih Kategori Toko</option>
                                    @foreach ($kategoritoko as $p)
                                        @if($s->id_kategoritoko == $p->id_kategoritoko)
                                            <option selected value="{{$p->id_kategoritoko}}">{{$p->nama_kategoritoko}}</option>
                                        @else
                                            <option value="{{$p->id_kategoritoko}}">{{$p->nama_kategoritoko}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="nis" class="col-sm-2 col-form-label">Lokasi Pasar</label>
                            <div class="col-sm-10">
                                <select class="custom-select" required name="id_pasar" required>
                                    <option selected value="">Pilih Lokasi Pasar</option>
                                    @foreach ($pasar as $p)
                                        @if($s->id_pasar == $p->id_pasar)
                                            <option selected value="{{$p->id_pasar}}">{{$p->nama_pasar}}</option>
                                        @else
                                            <option value="{{$p->id_pasar}}">{{$p->nama_pasar}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="nama_alumni" class="col-sm-2 col-form-label">Status Akun</label>
                            <div class="col-sm-10">
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input role" type="radio" required name="status" id="flexRadioDefault33" value="on" @if($s->status == 'on') checked @endif>
                                    <label class="custom-control-label" for="flexRadioDefault33" style="font-weight: normal;">
                                        Aktif
                                    </label>
                                    </div>
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input role" type="radio" required name="status" id="flexRadioDefault44" value="off" @if($s->status == 'off') checked @endif>
                                    <label class="custom-control-label" for="flexRadioDefault44" style="font-weight: normal;">
                                        Tidak Aktif
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="nis" class="col-sm-2 col-form-label">Deskripsi Toko</label>
                            <div class="col-sm-10">
                                <textarea name="deskripsi_toko" class="form-control" cols="6" rows="4" required placeholder="Deskripsi Toko">{{$s->deskripsi_toko}}</textarea>
                                @if ($errors->has('deskripsi_toko'))
                                <div class="text-danger text-small text-muted">
                                    @foreach ($errors->get('deskripsi_toko') as $err)
                                        <span class="text-danger">{{ $err }}</span>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="nis" class="col-sm-2 col-form-label">Alamat Toko</label>
                            <div class="col-sm-10">
                                <textarea name="alamat_toko" class="form-control" cols="6" rows="4" placeholder="Alamat Toko" required>{{$s->alamat_toko}}</textarea>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="nis" class="col-sm-2 col-form-label">Lokasi Toko</label>
                            <div class="col-sm-10">
                                <textarea name="embbed_maps_toko" class="form-control" cols="6" rows="4" required placeholder="Embedded Maps">{{$s->embbed_maps_toko}}</textarea>
                                <small><a target="__BLANK" href="https://google-map-generator.com/">Info Lebih lanjut mengenai Embedded maps</a></small> 
                                @if($s->embbed_maps_toko != null)
                                    <br>
                                    <iframe src="{{$s->embbed_maps_toko}}" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="nis" class="col-sm-2 col-form-label">Logo Toko</label>
                            <div class="col-sm-10">
                                <input type="file" name="logo_toko" class="form-control" accept=".png,.jpg">
                                @if ($errors->has('logo_toko'))
                                <span class="text-danger text-small text-muted">
                                    @foreach ($errors->get('logo_toko') as $err)
                                        <span class="text-danger">{{ $err }}</span>
                                    @endforeach
                                </span>
                                @else
                                <span class="text-black text-small">
                                    <small><i>Jika gak perlu diubah, dikosongin aja</i></small><br>
                                    @if($s->logo_toko != null)
                                        <small><i>Logo Terpasang <a target="_blank" href="{{url('assets/admin/logo_toko/'.$s->logo_toko)}}">{{$s->logo_toko}}</a></i></small>
                                    @endif
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row control-group">
                            <label for="nis" class="col-sm-2 col-form-label">Foto Toko</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <input type="file" name="foto_toko[]" class="form-control filefoto" accept=".png,.jpg">
                                    <div class="input-group-prepend"> 
                                        <button class="btn btn-success addfile" type="button"><i class="fas fa-plus"></i> Add</button>
                                    </div>     
                                </div>
                                @if ($errors->has('fototoko.*'))
                                <div class="text-danger text-small text-muted">
                                    @foreach ($errors->get('fototoko.*') as $err)
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
                                    @if($s->foto_toko != null)
                                        <li class="list-group-item text-bold">Foto Toko</li>
                                        @php
                                            $arr_fototoko = explode(',', $s->foto_toko);
                                        @endphp
                                        @for($i=0; $i<count($arr_fototoko); $i++)
                                            <li class="list-group-item">
                                                <a title="Hapus" class="hapusfototoko" data-id="{{$s->id_penjual}}" data-index="{{$i}}" data-foto_toko="{{$s->foto_toko}}" data-toggle="tooltip" href="#" style="color: red"><i class="fas fa-trash"></i></a>
                                                &nbsp;&nbsp;
                                                <a href="{{url('assets/admin/foto_toko/'.$arr_fototoko[$i])}}" data-toggle="lightbox" data-title="{{$s->nama_toko}}" data-gallery="gallery">
                                                    {{$arr_fototoko[$i]}}
                                                </a>
                                            </li>
                                        @endfor
                                    @endif

                                </ul>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary btn-sm" style="float: right">Update Data</button>
                    </div>
                </form>
                @endforeach
            </div>
        </div>
    </section>
</div>
<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
        $('.addfile').click(function(){
            var html = '';
            html += '<div class="mb-3 row control-group" id="removefile">';
            html += '<label for="nis" class="col-sm-2 col-form-label"></label>';
            html += '<div class="col-sm-10 input-group">';
            html += '<input type="file" name="foto_toko[]" accept=".png,.jpg" class="form-control filefoto">';
            html += '<div class="input-group-prepend">';
            html += '<button class="btn btn-danger deletefile" type="button"><i class="fas fa-times"></i> Remove</button>';
            html += '</div></div></div>';

            $('.fileadd').append(html);
        });

        $("body").on("click",".deletefile",function(){ 
            $(this).closest('#removefile').remove();
        });

        //hapus fototoko
        $('.hapusfototoko').click(function(e){

            e.preventDefault();

            var confirmed = confirm('Hapus foto Toko ini ?');

            if(confirmed) {

                $.ajax({
                    data: {'id_penjual': $(this).data('id'), '_token': "{{csrf_token()}}", 'foto_toko':$(this).data('foto_toko'), 'index':$(this).data('index')},
                    type: 'POST',
                    url:"{{url('admin/users/sellers/deletefototoko')}}",
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

        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox({
                alwaysShowClose: true
            });
        });

    });
</script>
@endsection