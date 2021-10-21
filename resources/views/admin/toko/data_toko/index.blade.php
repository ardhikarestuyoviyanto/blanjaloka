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
                            <th>Nama Sellers</th>
                            <th>Lokasi Pasar</th>
                            <th>Nama Toko</th>
                            <th>Kategori Toko</th>
                            <th>Total Produk</th>
                            <th>Produk Terjual</th>
                            <th>Status</th>
                            <th style="width: 10px">Aksi</th>
                            <th class="none">Deskripsi Toko</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($sellers as $no=>$s)
                                <tr>
                                    <td>{{ $no + 1 }}</td>
                                    <td>{{ $s->nama_user }}</td>
                                    <td>{{ $s->nama_pasar }}</td>
                                    <td>{{ $s->nama_toko }}</td>
                                    <td>{{$s->nama_kategoritoko}}</td>
                                    <td>23 Produk</td>
                                    <td>12 Produk</td>
                                    @if($s->status == 'on')
                                        <td class="text-primary"><i>Active</i></td>
                                    @else
                                        <td class="text-danger"><i>Not Active</i></td>
                                    @endif
                                    <td >
                                        <a href="" data-toggle="tooltip" title="Lihat Toko" data-placement="top"><span class="badge badge-success"><i class="fas fa-edit"></i></span></a>
                                        <a href="" data-toggle="tooltip" title="Jam Toko" data-placement="top"><span class="badge badge-info"><i class="fas fa-cog"></i></span></a>
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
        $('#tokotable').DataTable({
            "responsive":true,

        });

    }); 
</script>
@endsection