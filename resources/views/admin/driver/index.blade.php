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
                                    <th>Nama Driver</th>
                                    <th>No. Telp</th>
                                    <th>Alamat</th>
                                    <th>Kendaraan</th>
                                    <th>Lahir</th>
                                    <th class='notexport'>Created At</th>
                                    <th class='notexport'>Update At</th>
                                    <th style="width:60px;" class='notexport'>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($driver as $no=>$d)
                                        <tr>
                                            <td>{{ $no + 1 }}</td>
                                            <td>{{ $d->nama_driver}}</td>
                                            <td>{{ $d->no_telp }}</td>
                                            <td>{{ $d->alamat }}</td>
                                            <td>{{ $d->kendaraan }}</td>
                                            <td>{{ $d->tgl_lahir }}</td>
                                            <td>{{ date('d-M-Y', strtotime($d->created_at))}}</td>
                                            <td>{{ date('d-M-Y', strtotime($d->updated_at))}}</td>
                                            <td class="text-center">
                                                <a href="{{url('admin/users/driver/edit/'.$d->id_driver)}}" data-toggle="tooltip" title="Edit" data-placement="top"><span class="badge badge-success"><i class="fas fa-edit"></i></span></a>
                                                <a href="#" data-id="<?= $d->id_driver; ?>" class="delete_driver" data-toggle="tooltip" title="Hapus" data-placement="top"><span class="badge badge-danger"><i class="fas fa-trash"></i></span></a>
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


    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
            $('#drivertable').DataTable({
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
        });

        //delete data pasar
        $('.delete_driver').click(function(e){
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
