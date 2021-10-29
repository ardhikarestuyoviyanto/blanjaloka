@extends('admin/master-admin')
@section('content')
    @php use Illuminate\Support\Facades\DB; @endphp
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Kategori Produk</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">Data Kategori Produk</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        Data Kategori Produk

                        <div class="float-right d-none d-sm-inline-block">
                            <a href="#" data-toggle="modal" data-target="#addmodal"
                                class="btn btn-primary btn-sm">Tambah</a>
                        </div>

                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover" id="kategoritable">
                            <thead>
                                <tr>
                                    <th style="width:10px;">No</th>
                                    <th>Kategori</th>
                                    <th class='notexport'>Icon</th>
                                    <th style="width: 120px">Total Produk</th>
                                    <th style="width:10px;" class='notexport'>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kategori as $no => $k)
                                    <tr>
                                        <td>{{ $no + 1 }}</td>
                                        <td>{{ $k->nama_kategori }}</td>
                                        <td><img src="{{ asset('assets/admin/icon_kategoriproduk/' . $k->icon_kategori) }}" alt="" width="30px"></td>
                                        <td>{{count(DB::table('produk')->where('id_kategoriproduk', $k->id_kategoriproduk)->get()).' Produk'}}</td>
                                        <td class="text-center">
                                            <a href="#" data-id="<?= $k->id_kategori ?>" class="edit" data-toggle="tooltip" title="Edit" data-placement="top">
                                                <span class="badge badge-success"><i class="fas fa-edit"></i></span>
                                            </a>
                                            <a href="#" data-id="<?= $k->id_kategori ?>" class="delete" data-toggle="tooltip" title="Hapus" data-placement="top">
                                                <span class="badge badge-danger"><i class="fas fa-trash"></i></span>
                                            </a>
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

    {{-- Modal Tambah Pemda --}}

    <div class="modal fade" id="addmodal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Kategori Produk</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="tambahform" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3 row">
                            <label for="nama_kategori" class="col-sm-2 col-form-label">Kategori</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nama_kategori"
                                    placeholder="Masukkan kategori Misal : Sayur" required>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="icon_kategori" class="col-sm-2 col-form-label">Icon</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control filefoto" required accept=".png,.jpg,.svg"
                                    name="icon_kategori" required>
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

    {{-- Modal Edit Pemda --}}

    <div class="modal fade" id="editmodal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Kategori Produk</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editform" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id_kategori" id="id_kategori">
                    <div class="modal-body">
                        <div class="mb-3 row">
                            <label for="nama_kategori" class="col-sm-2 col-form-label">Kategori</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nama_kategori" id="nama_kategori"
                                    placeholder="No KTP" required>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="icon_kategori" class="col-sm-2 col-form-label">Icon</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="icon_kategori">
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

            $('#kategoritable').DataTable({
                "responsive": true,
                dom: 'Bfrtip',
                buttons: [{
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
            $('#tambahform').submit(function(e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ url('admin/produk/kategori/insert') }}",
                    type: "POST",
                    data: new FormData(this),
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $('.spinner').show();
                    },
                    complete: function() {
                        $('.spinner').hide();
                    },
                    success: function(data) {
                        swal(data.pesan)
                            .then((result) => {
                                location.reload();
                            });
                    },
                    error: function(err) {
                        alert(err);
                    }
                })
            });

            //-------------------------------------

            //show modal update form 
            $('.edit').click(function(e) {
                e.preventDefault();
                $.ajax({
                    data: {
                        'id_kategori': $(this).data('id'),
                        '_token': "{{ csrf_token() }}"
                    },
                    type: 'POST',
                    url: "{{ url('admin/produk/kategori/get') }}",
                    success: function(data) {
                        $('#id_kategori').val(data[0].id_kategori);
                        $('#nama_kategori').val(data[0].nama_kategori);
                        $('.icon_kategori').val(data[0].icon_kategori);

                        $('#editmodal').modal('show');
                    },
                    error: function(err) {
                        alert(err);
                        console.log(err);
                    }
                });
            });


            //----------------------------------------
            // edit form
            $('#editform').submit(function(e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ url('admin/produk/kategori/update') }}",
                    type: "POST",
                    data: new FormData(this),
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $('.spinner').show();
                    },
                    complete: function() {
                        $('.spinner').hide();
                    },
                    success: function(data) {
                        swal(data.pesan)
                            .then((result) => {
                                location.reload();
                            });
                    },
                    error: function(err) {
                        alert(err);
                    }
                })
            });

            //----------------------------------------------
            // hapus form
            $('.delete').click(function(e) {
                e.preventDefault();
                var confirmed = confirm('Hapus Kategori Produk Ini ?');

                if (confirmed) {

                    $.ajax({
                        data: {
                            'id_kategori': $(this).data('id'),
                            '_token': "{{ csrf_token() }}"
                        },
                        type: 'POST',
                        url: "{{ url('admin/produk/kategori/delete') }}",
                        success: function(data) {
                            swal(data.pesan)
                                .then((result) => {
                                    location.reload();
                                });
                        },
                        error: function(err) {
                            alert(err);
                            console.log(err);
                        }
                    });
                }
            });

        });
    </script>

@endsection
