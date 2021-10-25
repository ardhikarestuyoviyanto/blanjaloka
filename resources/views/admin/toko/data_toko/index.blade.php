@extends('admin/master-admin')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Toko</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Data Toko</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    Data Toko 
                </div>
                <div class="card-header bg-light">
                    <form action="#" method="get">
                        <div class="mb-3 row">
                            <label for="nis" class="col-sm-2 col-form-label">Pilih Pasar</label>
                            <div class="col-sm-10">
                                <select class="custom-select" required name="id_pasar" required>
                                    <option selected value="">Pilih Lokasi Pasar</option>
                                    @foreach ($pasar as $p)
                                        <option value="{{$p->id_pasar}}">{{$p->nama_pasar}}</option>
                                    @endforeach
                                </select>
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
                    <table id="tokotable" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th style="width:10px;">No</th>
                            <th>No Toko</th>
                            <th>Nama Sellers</th>
                            <th>Lokasi Pasar</th>
                            <th>Nama Toko</th>
                            <th>Kategori Toko</th>
                            <th>Total Produk</th>
                            <th>Status</th>
                            <th style="width: 60px">Aksi</th>
                            <th class="none">Jam Operasional</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($sellers as $no=>$s)
                                <tr>
                                    <td>{{ $no + 1 }}</td>
                                    <td>{{ $s->no_toko }}</td>
                                    <td>{{ $s->nama_user }}</td>
                                    <td>{{ $s->nama_pasar }}</td>
                                    <td>{{ $s->nama_toko }}</td>
                                    <td>{{$s->nama_kategoritoko}}</td>
                                    <td>23 Produk</td>
                                    @if($s->status == 'on')
                                        <td class="text-primary"><i>Active</i></td>
                                    @else
                                        <td class="text-danger"><i>Not Active</i></td>
                                    @endif
                                    <td >
                                        <a href="" data-toggle="tooltip" title="Lihat Toko" data-placement="top"><span class="badge badge-success"><i class="fas fa-store-alt"></i></span></a>
                                        <a href="{{url('admin/toko/jam/'.$s->id_penjual)}}" data-toggle="tooltip" title="Jam Toko" data-placement="top"><span class="badge badge-info"><i class="fas fa-cog"></i></span></a>
                                        @if($s->status == 'on')
                                            <a href="#" class="status" data-id="{{$s->id_penjual}}" data-status="off" data-pesan="Ubah Status Toko Menjadi Non Aktif ?" data-toggle="tooltip" title="Not Active" data-placement="top"><span class="badge badge-danger"><i class="fas fa-times"></i></span></a>
                                        @else
                                            <a href="#" class="status" data-id="{{$s->id_penjual}}" data-status="on" data-pesan="Ubah Status Toko Menjadi Aktif ?" data-toggle="tooltip" title="Active" data-placement="top"><span class="badge badge-primary"><i class="fas fa-check-double"></i></span></a>
                                        @endif
                                    </td>
                                    <td>
                                        <br><br>
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
                                            @foreach(DB::table('jamtoko')->where('id_penjual', $s->id_penjual)->get() as $i=>$jam)
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
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
        $('#tokotable').DataTable({
            "responsive":true,

        });

        //update status toko
        $('.status').click(function(e){
            e.preventDefault();
            var confirmed = confirm($(this).data('pesan'));

            if(confirmed) {

                $.ajax({
                    data: {'id_penjual':$(this).data('id'), '_token': "{{csrf_token()}}", 'status':$(this).data('status')},
                    type: 'POST',
                    url:"{{url('admin/toko/status')}}",
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