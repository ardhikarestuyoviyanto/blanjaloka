@extends('admin/master-admin')
@section('content')
@php use Illuminate\Support\Facades\DB; @endphp
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Pasar</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">Data Pasar</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        Data Pasar

                        <div class="float-right d-none d-sm-inline-block">
                            <a href="{{ url('admin/pasar/add') }}" class="btn btn-primary btn-sm">Tambah</a>
                        </div>

                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover" id="pasartable">
                            <thead>
                                <tr>
                                    <th style="width:10px;">No</th>
                                    <th>Nomor Pasar</th>
                                    <th>Nama Pasar</th>
                                    <th>Pengelola Pasar</th>
                                    <th>Max Toko</th>
                                    <th>Toko Terisi</th>
                                    <th>Sisa Toko</th>
                                    <th style="width:60px;" class='notexport'>Aksi</th>
                                    <th class="none">Alamat</th>
                                    <th class="notexport none">Jam Operasional Pasar</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pasar as $no=>$p)
                                        <tr>
                                            <td>{{ $no + 1 }}</td>
                                            <td>{{$p->no_pasar}}</td>
                                            <td>{{ $p->nama_pasar }}</td>
                                            <td>{{ $p->nama }}</td>
                                            <td>{{ $p->max_lapak.' Toko' }}</td>
                                            <td>{{ count(DB::table('penjual')->where('id_pasar', $p->id_pasar)->get()).' Toko' }}</td>
                                            <td>{{ $p->max_lapak - count(DB::table('penjual')->where('id_pasar', $p->id_pasar)->get()).' Toko' }}</td>
                                            <td class="text-center">
                                                <a href="{{url('admin/pasar/edit/'.$p->id_pasar)}}" data-toggle="tooltip" title="Edit" data-placement="top"><span class="badge badge-success"><i class="fas fa-edit"></i></span></a>
                                                <a href="{{url('admin/pasar/jam/'.$p->id_pasar)}}" data-toggle="tooltip" title="Jam Pasar" data-placement="top"><span class="badge badge-info"><i class="fas fa-cog"></i></span></a>
                                                <a href="#" data-id="<?= $p->id_pasar; ?>" class="delete_pasar" data-toggle="tooltip" title="Hapus" data-placement="top"><span class="badge badge-danger"><i class="fas fa-trash"></i></span></a>
                                            </td>
                                            <td>
                                                <br>
                                                {{ $p->alamat }}
                                            </td>
                                            <td>
                                                <br>
                                                <table class="table">
                                                    <thead>
                                                      <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Hari</th>
                                                        <th scope="col">Jam Buka</th>
                                                        <th scope="col">Jam Tutup</th>
                                                        <th scope="col">Catatan</th>
                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach(DB::table('jampasar')->where('id_pasar', $p->id_pasar)->get() as $i=>$jam)
                                                      <tr>
                                                        <th scope="row">{{$i+1}}</th>
                                                        <td>{{ucfirst($jam->hari)}}</td>
                                                        <td>{{ $jam->buka }}</td>
                                                        <td>{{ $jam->tutup }}</td>
                                                        <td>{{ $jam->catatan }}</td>
                                                      </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
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
            $('#pasartable').DataTable({
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
        $('.delete_pasar').click(function(e){
            e.preventDefault();
            var confirmed = confirm('Hapus jam ini ?');

            if(confirmed) {

                $.ajax({
                    data: {'id_pasar':$(this).data('id'), '_token': "{{csrf_token()}}"},
                    type: 'POST',
                    url:"{{url('admin/pasar/deletehandler')}}",
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
