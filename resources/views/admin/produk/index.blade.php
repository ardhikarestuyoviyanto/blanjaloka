@extends('admin/master-admin')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Lihat Produk Berdasarkan Sellers</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Lihat Produk</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    Lihat Produk Berdasarkan Sellers    
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
                    <table id="sellerstable" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th style="width:10px;">No</th>
                            <th>Sellers</th>
                            <th>Lokasi Pasar</th>
                            <th>Nama Toko</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                            <th>Status</th>
                            <th>Aksi</th>
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
                                    <td>{{ date('d-M-Y', strtotime($s->created_at))}}</td>
                                    <td>{{ date('d-M-Y', strtotime($s->updated_at))}}</td>
                                    @if($s->status == 'on')
                                        <td class="text-primary"><i>Active</i></td>
                                    @else
                                        <td class="text-danger"><i>Not Active</i></td>
                                    @endif
                                    <td >
                                        <a href="{{url('admin/produk/listproduk/'.$s->id_penjual)}}" data-toggle="tooltip" class="btn btn-primary btn-xs" title="Lihat Produk" data-placement="top">Lihat Produk</a>
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
        $('#sellerstable').DataTable({
            "responsive":true,

        });

    }); 
</script>
@endsection