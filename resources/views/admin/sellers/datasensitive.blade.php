@extends('admin/master-admin')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Sensitive</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('admin/users/sellers')}}">Data Sellers</a></li>
                            <li class="breadcrumb-item"><a href="{{url('admin/users/sellers/edit/'.$id_penjual)}}">Edit Sellers</a></li>
                            <li class="breadcrumb-item active">Data Sensitive Sellers</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        Data Sensitive Sellers
                    </div>
                    
                    <div class="card-header bg-gray-light">
                        @foreach($sellers as $s)
                        <table width="100%">
                            <tbody>
                                <tr class="text-bold">
                                    <td width="150px">No Toko</td>
                                    <td width="10px">:</td>
                                    <td>{{$s->no_toko}}</td>
                                </tr>
                                <tr class="text-bold">
                                    <td width="150px">Nama Toko</td>
                                    <td width="10px">:</td>
                                    <td>{{$s->nama_toko}}</td>
                                </tr>
                                <tr class="text-bold">
                                    <td width="150px">Nama Sellers</td>
                                    <td width="10px">:</td>
                                    <td>{{$s->nama_user}}</td>
                                </tr>
                                <tr class="text-bold">
                                    <td width="150px">Lokasi Pasar</td>
                                    <td width="10px">:</td>
                                    <td>{{$s->nama_pasar}}</td>
                                </tr>
                            </tbody>
                        </table>
                        @endforeach
                    </div>

                        
                        @foreach($sellers as $s)
                        <form action="#" method="POST">
                            @csrf
                            <input type="hidden" name="id_penjual" value="{{$s->id_penjual}}">
                            <div class="card-body">
                                <div class="mb-3 row">
                                    <label for="nis" class="col-sm-2 col-form-label">No KTP</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" name="no_ktp" value="{{$s->no_ktp}}">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="nis" class="col-sm-2 col-form-label">No Rekening</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control bg-white" name="no_rekening" readonly value="{{$s->no_rekening}}">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="nis" class="col-sm-2 col-form-label">Nama Bank</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control bg-white" name="nama_bank" readonly value="{{$s->nama_bank}}">
                                    </div>
                                </div>
        
                                <div class="mb-3 row">
                                    <label for="nis" class="col-sm-2 col-form-label">Foto KTP</label>
                                    <div class="col-sm-10">
                                        <a href="{{url('assets/admin/foto_ktp/'.$s->foto_ktp)}}" data-toggle="lightbox" data-title="Foto KTP" data-gallery="gallery">
                                            {{$s->foto_ktp}}
                                        </a>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="nis" class="col-sm-2 col-form-label">Foto Penjual dan KTP</label>
                                    <div class="col-sm-10">
                                       <a href="{{url('assets/admin/foto_penjual_ktp/'.$s->foto_penjual_ktp)}}" data-toggle="lightbox" data-title="Foto Penjual dengan KTP" data-gallery="gallery">
                                            {{$s->foto_penjual_ktp}}                                        
                                        </a>  
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer">
                                <a href="{{url('admin/users/sellers/edit/'.$id_penjual)}}" type="button" class="btn btn-default"><i class="fas fa-undo-alt"></i> Kembali</a>
                            </div>
                        </form>
                        @endforeach

                </div>

            </div>
        </section>
    </div>

    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();

            //save form
            $('#saveform').submit(function(e){
                e.preventDefault();
                $.ajax({
                    data: $(this).serialize(),
                    type: 'POST',
                    url:"{{url('admin/pasar/jam/insert')}}",
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
