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
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            Data Customers
                            <a href="{{url('admin/users/customers/add')}}" class="btn btn-primary btn-sm" type="button" style="float: right;">Tambah</a>
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
                            </tr>
                            </thead>
                            <tbody>

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
        $('body').tooltip({selector: '[data-toggle="tooltip"]'});

        $('#customerstable').DataTable({
            "responsive":true,
            processing: true,
            serverSide: true,
            ajax: "{{url('admin/users/customers/json')}}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'nama_user', name: 'nama_user' },
                { data: 'email', name: 'email' },
                { data: 'no_telp', name: 'no_telp' },
                { data: 'created_at', name: 'created_at' },
                { data: 'updated_at', name: 'updated_at' },
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action' }
            ],
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

        $('#customerstable').on('click', '.hapus_customers[data-id]', function(e){
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