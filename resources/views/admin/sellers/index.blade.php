@extends('admin/master-admin')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Sellers</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Data Sellers</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    Data Sellers
                </div>
                <div class="card-body">
                    <table id="sellerstable" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th style="width:10px;">No</th>
                            <th>Nama Sellers</th>
                            <th>Email</th>
                            <th>Lokasi Pasar</th>
                            <th>Nama Toko</th>
                            <th>Kategori Toko</th>
                            <th>Created at</th>
                            <th>Updated at</th>
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
    </section>
</div>

<script>
    $(document).ready(function(){
        $('body').tooltip({selector: '[data-toggle="tooltip"]'});
        
        $('#sellerstable').DataTable({
            "responsive":true,
            processing: true,
            serverSide: true,
            ajax: "{{url('admin/users/sellers/json')}}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'nama_user', name: 'nama_user' },
                { data: 'email', name: 'email' },
                { data: 'nama_pasar', name: 'nama_pasar' },
                { data: 'nama_toko', name: 'nama_toko' },
                { data: 'nama_kategoritoko', name: 'nama_kategoritoko' },
                { data: 'created_at', name: 'created_at' },
                { data: 'updated_at', name: 'updated_at' },
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action' },
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


        $('#sellerstable').on('click', '.hapus_sellers[data-id]', function(e){
            e.preventDefault();

            var confirmed = confirm('Hapus sellers ini ?');

            if(confirmed) {

                $.ajax({
                    data: {'id_penjual': $(this).data('id'), '_token': "{{csrf_token()}}"},
                    type: 'POST',
                    url:"{{url('admin/users/sellers/delete')}}",
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