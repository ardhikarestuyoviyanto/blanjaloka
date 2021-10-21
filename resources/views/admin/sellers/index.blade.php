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
                            <th class="none">Deskripsi Toko</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($sellers as $no=>$s)
                                <tr>
                                    <td>{{ $no + 1 }}</td>
                                    <td>{{ $s->nama_user }}</td>
                                    <td>{{ $s->email }}</td>
                                    <td>{{ $s->nama_pasar }}</td>
                                    <td>{{ $s->nama_toko }}</td>
                                    <td>{{ $s->nama_kategoritoko }}</td>
                                    <td>{{ date('d-M-Y', strtotime($s->created_at))}}</td>
                                    <td>{{ date('d-M-Y', strtotime($s->updated_at))}}</td>
                                    @if($s->status == 'on')
                                        <td class="text-primary"><i>Active</i></td>
                                    @else
                                        <td class="text-danger"><i>Not Active</i></td>
                                    @endif
                                    <td class="text-center">
                                        <a href="{{url('admin/users/sellers/edit/'.$s->id_penjual)}}" data-toggle="tooltip" title="Edit" data-placement="top"><span class="badge badge-success"><i class="fas fa-edit"></i></span></a>
                                        <a href="#" data-id="<?= $s->id_penjual; ?>" class="hapus_sellers" data-toggle="tooltip" title="Hapus" data-placement="top"><span class="badge badge-danger"><i class="fas fa-trash"></i></span></a>
                                    </td>
                                    <td>
                                        <br>
                                        {{$s->deskripsi_toko}}
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
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
        $('#reservation').daterangepicker()
        $('#sellerstable').DataTable({
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

        //hapus sellers
        $('.hapus_sellers').click(function(e){
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