@extends('admin/master-admin')
@section('content')
@php use Illuminate\Support\Facades\DB; @endphp
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Kategori Toko</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">Kategori Toko</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        Kategori Toko

                        <div class="float-right d-none d-sm-inline-block">
                            <a href="#" data-toggle="modal" data-target="#addmodal" class="btn btn-primary btn-sm">Tambah</a>
                        </div>

                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover" id="pengelolatable">
                            <thead>
                                <tr>
                                    <th style="width:10px;">No</th>
                                    <th>Nama Kategori Toko</th>
                                    <th style="width:120px;">Total Toko</th>
                                    <th style="width:10px;" class='notexport'>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kategoritoko as $no=>$k)
                                        <tr>
                                            <td>{{ $no + 1 }}</td>
                                            <td>{{ $k->nama_kategoritoko }}</td>
                                            <td>{{ count(DB::table('penjual')->where('id_kategoritoko', $k->id_kategoritoko)->get()).' Toko' }}</td>
                                            <td class="text-center">
                                                <a href="#" data-id="<?= $k->id_kategoritoko; ?>" class="edit" data-toggle="tooltip" title="Edit" data-placement="top"><span class="badge badge-success"><i class="fas fa-edit"></i></span></a>
                                                <a href="#" data-id="<?= $k->id_kategoritoko; ?>" class="delete" data-toggle="tooltip" title="Hapus" data-placement="top"><span class="badge badge-danger"><i class="fas fa-trash"></i></span></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </section>
    </div>

    {{-- Modal Tambah Kategori Toko --}}

    <div class="modal fade" id="addmodal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Kategori Toko</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="tambahform">
                @csrf
                <div class="modal-body">
                    <div class="mb-3 row">
                        <label for="nis" class="col-sm-2 col-form-label">Nama Kategori</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nama_kategoritoko" placeholder="Contoh : Toko Elektronik" required>
                        </div>
                    </div>
    
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">  
                        <span class="spinner-border spinner-border-sm spinner" role="status" aria-hidden="true"></span>
                        Tambah
                    </button>
                </div>
            </form>
            </div>
        </div>
    </div>
    
    {{-- Modal Edit Kategori Toko --}}

    <div class="modal fade" id="editmodal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Kategori Toko</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editform">
                @csrf
                <input type="hidden" name="id_kategoritoko" id="id_kategoritoko">
                <div class="modal-body">
                    <div class="mb-3 row">
                        <label for="nis" class="col-sm-2 col-form-label">Nama Kategori</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nama_kategoritoko" id="nama_kategoritoko" placeholder="Contoh : Toko Elektronik" required>
                        </div>
                    </div>
    
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">  
                        <span class="spinner-border spinner-border-sm spinner" role="status" aria-hidden="true"></span>
                        Update
                    </button>
                </div>
            </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.spinner').hide();

            $('[data-toggle="tooltip"]').tooltip();

            $('#pengelolatable').DataTable({
                "responsive":true,
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excel',
                        text: 'Excel',
                        className: 'btn btn-success btn-sm active',
                        exportOptions: {
                            columns: ':not(.notexport)'
                        }

                    },
                    {
                        extend: 'pdf',
                        text: 'PDF',
                        className: 'btn btn-sm btn-success',
                        exportOptions: {
                            columns: ':not(.notexport)'
                        }
                    },
                    {
                        extend: 'print',
                        text: 'Print',
                        className: 'btn btn-success btn-sm active',
                        exportOptions: {
                            columns: ':not(.notexport)'
                        }

                    },

                ],
            });

            //----------------------------

            // insert form
            $('#tambahform').submit(function(e){
                e.preventDefault();

                $.ajax({
                    url : "{{url('admin/toko/kategori/add')}}",
                    type: "POST",
                    data: $(this).serialize(),
                    beforeSend: function(){
                        $('.spinner').show();
                    },
                    complete: function(){
                        $('.spinner').hide();
                    },
                    success: function(data){
                        swal(data.pesan)
                        .then((result) => {
                            location.reload();
                        });
                    },
                    error: function(err){
                        alert(err);
                    }
                })
            });

            //-------------------------------------

            //show modal update form 
            $('.edit').click(function(e){
                e.preventDefault();
                $.ajax({
                    data: {'id_kategoritoko':$(this).data('id'), '_token': "{{csrf_token()}}"},
                    type: 'POST',
                    url : "{{url('admin/toko/kategori/get')}}",
                    success : function(data){
                        $('#id_kategoritoko').val(data[0].id_kategoritoko);
                        $('#nama_kategoritoko').val(data[0].nama_kategoritoko);

                        $('#editmodal').modal('show');
                    },
                    error : function(err){
                        alert(err);
                        console.log(err);
                    }
                });
            });

            //----------------------------------------
            // edit form
            $('#editform').submit(function(e){
                e.preventDefault();

                $.ajax({
                    url : "{{url('admin/toko/kategori/update')}}",
                    type: "POST",
                    data: $(this).serialize(),
                    beforeSend: function(){
                        $('.spinner').show();
                    },
                    complete: function(){
                        $('.spinner').hide();
                    },
                    success: function(data){
                        swal(data.pesan)
                        .then((result) => {
                            location.reload();
                        });
                    },
                    error: function(err){
                        alert(err);
                    }
                })
            });

            //----------------------------------------------
            // hapus form
            $('.delete').click(function(e){
                e.preventDefault();
                var confirmed = confirm('Hapus Kategori Ini ?');

                if(confirmed) {

                    $.ajax({
                        data: {'id_kategoritoko':$(this).data('id'), '_token': "{{csrf_token()}}"},
                        type: 'POST',
                        url : "{{url('admin/toko/kategori/delete')}}",
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
