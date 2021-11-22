@extends('sellers/master-sellers')
@section('content')
@php session()->forget('pin'); @endphp
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Produk Saya</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Produk Saya</li>
                    </ol>
                </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        Data Produk
                    </div>
                    <form action="{{url('sellers/produk')}}" method="get">
                        <div class="card-header bg-white">
                            <div class="mb-3 row">
                                <label for="nis" class="col-sm-2 col-form-label">Kategori Produk</label>
                                <div class="col-sm-10">
                                    <select class="custom-select" required name="kategoriproduk" onchange="this.form.submit()">
                                        <option selected value="">- PILIH KATEGORI PRODUK -</option>
                                        @foreach($kategori as $k)
                                            @if($k->id_kategori == @$_GET['kategoriproduk']):
                                                <option selected value="{{$k->id_kategori}}">- {{$k->nama_kategori}}</option>
                                            @else:
                                                <option value="{{$k->id_kategori}}">- {{$k->nama_kategori}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="card-body">
                        <table class="table table-bordered table-hover" id="kategoritable">
                            <thead>
                                <tr>
                                    <th style="width:10px;">No</th>
                                    <th>Nama Produk</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Penjualan</th>
                                    <th style="width:10px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($produk as $no => $p)
                                @php
                                    $fotoproduk = explode(',', $p->foto_produk);
                                @endphp
                                    <tr>
                                        <td style="vertical-align: middle;" class="text-center">{{ $no + 1 }}</td>
                                        <td>
                                            <div class="row">
                                                <div class="col-sm-1">
                                                    <img src="{{asset('assets/admin/foto_produk/'.$fotoproduk[0])}}" alt="" width="60" height="60">
                                                </div>
                                                <div class="col-sm ml-4">
                                                    @if($p->status_produk == 'on')
                                                        {{ $p->nama_produk }}
                                                    @else
                                                        <del>{{ $p->nama_produk }}</del>
                                                        <i><small class="text-danger text-bold ml-2">Diarsipkan</small></i>
                                                    @endif
                                                    <br>
                                                    <small><i class="far fa-heart text-danger"></i> 0</small>
                                                    <small style="margin-left: 4px;"><i class="far fa-eye text-info"></i> 0</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="vertical-align: middle;">
                                            @if($p->potongan_harga == 0)
                                                Rp. {{ $p->harga }}
                                            @else
                                                <del>Rp. {{$p->harga}}</del> <br>
                                                Rp. {{$p->harga - $p->potongan_harga}} <i><small class="text-danger text-bold">(Diskon {{number_format($p->potongan_harga / $p->harga * 100, 0, '.', '')}}%)</small></i>
                                            @endif
                                        </td>
                                        <td style="vertical-align: middle;">{{ $p->jumlah_produk.' '.ucfirst(strtolower($p->nama_satuan)) }}</td>
                                        <td style="vertical-align: middle;">{{'0 '.ucfirst(strtolower($p->nama_satuan))}}</td>
                                        <td class="text-center" style="vertical-align: middle;">
                                            <a href="{{ url('sellers/produk/edit/'.$p->id_produk) }}" data-toggle="tooltip" title="Lihat" data-placement="top">
                                                <span class="badge badge-success"><i class="fas fa-edit"></i></span>
                                            </a>
                                            <a href="#" data-id_produk="{{$p->id_produk}}" data-nama_produk="{{$p->nama_produk}}" class="delete" data-toggle="tooltip" title="Hapus" data-placement="top">
                                                <span class="badge badge-danger"><i class="fas fa-trash"></i></span>
                                            </a>
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
            $('.spinner').hide();

            $('[data-toggle="tooltip"]').tooltip();

            $('#kategoritable').DataTable({
                "responsive": true
            });

            //----------------------------------------------------------------------------------------

            $('.delete').click(function(e){
                e.preventDefault();
                swal({
                    title: "Hapus Produk "+$(this).data('nama_produk'),
                    text: "Produk ini akan dihapus selamanya dari aplikasi, apakah anda ingin melanjutkan ?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if(willDelete) {
                        $.ajax({
                            data:{'id_produk':$(this).data('id_produk'), '_token': "{{csrf_token()}}"},
                            url: "{{ url('sellers/produk/delete') }}",
                            type: "POST",
                            success: function(e){
                                swal(e.pesan)
                                .then((value) => {
                                    location.reload();
                                });
                            }
                        });
                    }
                });
            });

        });
    </script>
@endsection