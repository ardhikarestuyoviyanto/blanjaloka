@extends('sellers/master-sellers')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Produk Saya</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Produk Saya</li>
                    </ol>
                </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        Data Produk

                        <div class="float-right d-none d-sm-inline-block">
                            <a href="{{ url('sellers/produk/add') }}" class="btn btn-primary btn-sm">Tambah</a>
                        </div>

                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover" id="kategoritable">
                            <thead>
                                <tr>
                                    <th style="width:10px;">No</th>
                                    <th>Nama Produk</th>
                                    <th>Harga</th>
                                    <th style="width: 120px">Total Produk</th>
                                    <th>Status</th>
                                    <th style="width:10px;" class='notexport'>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($produk as $no => $p)
                                    @if ($p->penjual_id == session()->get('id_users'))
                                        <tr>
                                            <td>{{ $no + 1 }}</td>
                                            <td>{{ $p->nama_produk }}</td>
                                            <td>Rp{{ $p->harga }}</td>
                                            <td>{{ $p->jumlah_produk }}</td>
                                            <td>
                                                @if ($p->status_produk == '1')
                                                    <i class="text-primary">Tersedia</i>
                                                @else
                                                <i class="text-danger">Kosong</i>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ url('sellers/produk/edit/'.$p->id_produk) }}">
                                                    <span class="badge badge-success"><i class="fas fa-edit"></i></span>
                                                </a>
                                                <a href="#" data-id="<?= $p->id_produk; ?>" class="delete" data-toggle="tooltip" title="Hapus" data-placement="top">
                                                    <span class="badge badge-danger"><i class="fas fa-trash"></i></span>
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
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
                    url: "{{ url('sellers/produk/kategori/insert') }}",
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
                var confirmed = confirm('Hapus Produk Ini ?');

                if (confirmed) {

                    $.ajax({
                        data: {
                            'id_produk': $(this).data('id'),
                            '_token': "{{ csrf_token() }}"
                        },
                        type: 'POST',
                        url: "{{ url('sellers/produk/delete') }}",
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