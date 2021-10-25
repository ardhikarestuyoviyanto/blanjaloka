@extends('admin/master-admin')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Customer</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Data Customers</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="alert alert-light text-bold" role="alert">
                Kolom tabel yang aktif menandakan akun customers tersebut terdaftar juga sebagai akun sellers
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            Data Customers
                            <a href="{{url('admin/users/customers/add')}}" class="btn btn-primary btn-sm" type="button" style="float: right;">Tambah</a>
                        </div>
                        <div class="card-header bg-light">
                            <form action="#" method="get">
                                <div class="mb-3 row">
                                    <label for="nis" class="col-sm-2 col-form-label">Filtering tanggal akun dibuat</label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text">
                                                <i class="far fa-calendar-alt"></i>
                                              </span>
                                            </div>
                                            <input type="text" class="form-control float-right" id="reservation">
                                        </div>
                                    </div>
                                </div>
        
                                <div class="mt-3 mb-3 row">
                                    <label for="nis" class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary btn-sm">Terapkan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                        <table id="customerstable" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th style="width:10px;">No</th>
                                <th>Customers</th>
                                <th>Email</th>
                                <th>No Telpon</th>
                                <th class='notexport'>Created At</th>
                                <th class='notexport'>Update At</th>
                                <th>Status</th>
                                <th style="width:10px;" class='notexport'>Aksi</th>
                                <th class="none">Alamat</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($customers as $no=>$c)
                                    @if(count(DB::table('users')->join('penjual', 'users.id_users', '=', 'penjual.id_users')->join('pasar', 'penjual.id_pasar', '=', 'pasar.id_pasar')->where('users.id_users', $c->id_users)->get()) == 1)
                                        <tr class="table-secondary">
                                    @else
                                        <tr>
                                    @endif
                                        <td>{{ $no + 1 }}</td>
                                        <td>{{ $c->nama_user }}</td>
                                        <td>{{ $c->email }}</td>
                                        <td>{{ $c->no_telp }}</td>
                                        <td>{{ date('d-M-Y', strtotime($c->created_at))}}</td>
                                        <td>{{ date('d-M-Y', strtotime($c->updated_at))}}</td>
                                        @if($c->status == 'on')
                                            <td class="text-primary"><i>Active</i></td>
                                        @else
                                            <td class="text-danger"><i>Not Active</i></td>
                                        @endif
                                        <td class="text-center">
                                            <a href="{{url('admin/users/customers/edit/'.$c->id_users)}}" class="edit" data-toggle="tooltip" title="Edit" data-placement="top"><span class="badge badge-success"><i class="fas fa-edit"></i></span></a>
                                            <a href="#" data-id="<?= $c->id_users; ?>" class="hapus_customers" data-toggle="tooltip" title="Hapus" data-placement="top"><span class="badge badge-danger"><i class="fas fa-trash"></i></span></a>
                                        </td>
                                        <td>
                                            <br>
                                            {{$c->alamat}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
        $('#reservation').daterangepicker()

        $('#customerstable').DataTable({
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

        $('.hapus_customers').click(function(e){
            e.preventDefault();

            var confirmed = confirm('Hapus customers ini ?');

            if(confirmed) {

                $.ajax({
                    data: {'id_users': $(this).data('id'), '_token': "{{csrf_token()}}"},
                    type: 'POST',
                    url:"{{url('admin/users/customers/delete')}}",
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