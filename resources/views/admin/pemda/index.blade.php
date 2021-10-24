@extends('admin/master-admin')
@section('content')
    @php use Illuminate\Support\Facades\DB; @endphp
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Pemda</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">Data Pemda</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        Data Pemda

                        <div class="float-right d-none d-sm-inline-block">
                            <a href="#" data-toggle="modal" data-target="#addmodal"
                                class="btn btn-primary btn-sm">Tambah</a>
                        </div>

                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover" id="pemdatable">
                            <thead>
                                <tr>
                                    <th style="width:10px;">No</th>
                                    <th>No KTP</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>No Telp</th>
                                    <th>Created at</th>
                                    <th>Update at</th>
                                    <th style="width:10px;" class='notexport'>Aksi</th>
                                    <th class="none">Alamat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pemda as $no => $p)
                                    <tr>
                                        <td>{{ $no + 1 }}</td>
                                        <td>{{ $p->noktp }}</td>
                                        <td>{{ $p->nama_pemda }}</td>
                                        <td>{{ $p->email }}</td>
                                        <td>{{ $p->no_telp }}</td>
                                        <td>{{ date('d-M-Y', strtotime($p->created_at)) }}</td>
                                        <td>{{ date('d-M-Y', strtotime($p->updated_at)) }}</td>
                                        <td class="text-center">
                                            <a href="#" data-id="<?= $p->id_pemda ?>" class="edit"
                                                data-toggle="tooltip" title="Edit" data-placement="top"><span
                                                    class="badge badge-success"><i class="fas fa-edit"></i></span></a>
                                            <a href="#" data-id="<?= $p->id_pemda ?>" class="delete"
                                                data-toggle="tooltip" title="Hapus" data-placement="top"><span
                                                    class="badge badge-danger"><i class="fas fa-trash"></i></span></a>
                                        </td>
                                        <td>
                                            <br>
                                            {{ $p->alamat_pemda }}
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
                    <h4 class="modal-title">Tambah Pemda</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="tambahform">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3 row">
                            <label for="noktp" class="col-sm-2 col-form-label">No KTP</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="noktp" placeholder="No KTP" required>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="nama_pemda" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nama_pemda" placeholder="Nama" required>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10 validate">
                                <input type="email" class="form-control" name="email" placeholder="Email" required>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="no_telp" class="col-sm-2 col-form-label">No Telp</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="no_telp" placeholder="No Telp" required>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="alamat_pemda" class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm-10">
                                <textarea name="alamat_pemda" class="form-control" cols="6" rows="4"
                                    placeholder="Alamat Lengkap" required></textarea>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="password" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10 validate">
                                <input type="password" class="form-control" name="password" placeholder="Password"
                                    required>
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
                    <h4 class="modal-title">Edit Pemda</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editform">
                    @csrf
                    <input type="hidden" name="id_pemda" id="id_pemda">
                    <div class="modal-body">
                        <div class="mb-3 row">
                            <label for="noktp" class="col-sm-2 col-form-label">No KTP</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="noktp" id="noktp" placeholder="No KTP"
                                    required>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="nama_pemda" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nama_pemda" id="nama_pemda"
                                    placeholder="Nama" required>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10 validate">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Email"
                                    required>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="no_telp" class="col-sm-2 col-form-label">No Telp</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="no_telp" id="no_telp" placeholder="No Telp"
                                    required>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="alamat_pemda" class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm-10">
                                <textarea name="alamat_pemda" class="form-control" cols="6" rows="4" id="alamat_pemda"
                                    placeholder="Alamat Lengkap" required></textarea>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="password" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10 validate">
                                <input type="password" class="form-control" name="password" placeholder="Password">
                                <small id="password" class="form-text text-muted">Kalau gak perlu diubah dikosongin
                                    aja</small>
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

            $('#pemdatable').DataTable({
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
                    url: "{{ url('admin/users/pemda/insert') }}",
                    type: "POST",
                    data: $(this).serialize(),
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
                        'id_pemda': $(this).data('id'),
                        '_token': "{{ csrf_token() }}"
                    },
                    type: 'POST',
                    url: "{{ url('admin/users/pemda/get') }}",
                    success: function(data) {
                        $('#id_pemda').val(data[0].id_pemda);
                        $('#nama_pemda').val(data[0].nama_pemda);
                        $('#alamat_pemda').val(data[0].alamat_pemda);
                        $('#no_telp').val(data[0].no_telp);
                        $('#email').val(data[0].email);
                        $('#noktp').val(data[0].noktp);

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
                    url: "{{ url('admin/users/pemda/update') }}",
                    type: "POST",
                    data: $(this).serialize(),
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
                var confirmed = confirm('Hapus Akun Pemda Ini ?');

                if (confirmed) {

                    $.ajax({
                        data: {
                            'id_pemda': $(this).data('id'),
                            '_token': "{{ csrf_token() }}"
                        },
                        type: 'POST',
                        url: "{{ url('admin/users/pemda/delete') }}",
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
