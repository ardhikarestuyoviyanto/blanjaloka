@extends('admin/master-admin')
@section('content')
@php use Illuminate\Support\Facades\DB; @endphp
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Driver</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">Data Driver</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        Data Driver

                        <div class="float-right d-none d-sm-inline-block">
                            <a href="{{ url('admin/users/driver/add') }}" class="btn btn-primary btn-sm">Tambah</a>
                        </div>

                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover" id="drivertable">
                            <thead>
                                <tr>
                                    <th style="width:10px;">No</th>
                                    <th>No KTP</th>
                                    <th>Nama Driver</th>
                                    <th>No. Telp</th>
                                    <th>Kendaraan</th>
                                    <th>Tgl Lahir</th>
                                    <th class='notexport'>Created At</th>
                                    <th class='notexport'>Update At</th>
                                    <th style="width:9px;" class='notexport'>Action</th>
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
        $(document).ready(function() {
            $('body').tooltip({selector: '[data-toggle="tooltip"]'});
            $('#drivertable').DataTable({
                "responsive":true,
                processing: true,
                serverSide: true,
                ajax: "{{url('admin/users/driver/json')}}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'no_ktp', name: 'no_ktp' },
                    { data: 'nama_driver', name: 'nama_driver' },
                    { data: 'no_telp', name: 'no_telp' },
                    { data: 'kendaraan', name: 'kendaraan' },
                    { data: 'tgl_lahir', name: 'tgl_lahir' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'updated_at', name: 'updated_at' },
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
        });

        //delete data driver
        $('#drivertable').on('click', '.delete_driver[data-id]', function(e){
            e.preventDefault();
            var confirmed = confirm('Hapus Data ini ?');

            if(confirmed) {

                $.ajax({
                    data: {'id_driver':$(this).data('id'), '_token': "{{csrf_token()}}"},
                    type: 'POST',
                    url:"{{url('admin/users/driver/delete')}}",
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
        
    </script>

@endsection
