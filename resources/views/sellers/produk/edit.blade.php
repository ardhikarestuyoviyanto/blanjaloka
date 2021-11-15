@extends('sellers/master-sellers')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Produk</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Edit Produk</li>
                </ol>
            </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

            <div class="card">
                <div class="card-header">
                    Edit Produk
                </div>
                @foreach ($produk as $p)
                    <form action="{{url('sellers/produk/update')}}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <input type="hidden" name="id_produk" value="{{$p->id_produk}}">
                        <div class="card-body">
                            <div class="mb-3 row">
                                <label for="nama_produk" class="col-sm-2 col-form-label">Nama Produk</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nama_produk"
                                        placeholder="Masukkan produk" value="{{ $p->nama_produk }}" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="nama_produk" class="col-sm-2 col-form-label">Harga Produk</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="harga"
                                        placeholder="Masukkan harga" required value="{{ $p->harga }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="nama_produk" class="col-sm-2 col-form-label">Jumlah Produk</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="jumlah_produk"
                                        placeholder="Masukkan jumlah" required value="{{ $p->jumlah_produk }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="nis" class="col-sm-2 col-form-label">Kategori</label>
                                <div class="col-sm-10">
                                    <select class="custom-select" required name="id_kategoriproduk" id="id_kategoriproduk">
                                        <option selected value="">- PILIH KATEGORI PRODUK -</option>
                                        @foreach($kategori as $k)
                                            @if ($k->id_kategori == $p->id_kategoriproduk)
                                                <option selected value="{{$k->id_kategori}}">- {{$k->nama_kategori}}</option>
                                            @else
                                            <option value="{{$k->id_kategori}}">- {{$k->nama_kategori}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="nis" class="col-sm-2 col-form-label">Deskripsi</label>
                                <div class="col-sm-10">
                                    <textarea name="deskripsi" class="form-control" cols="6" rows="6" placeholder="Isi Berupa Kata Kata">{{ $p->deskripsi }}</textarea>
                                    @if ($errors->has('deskripsi'))
                                    <div class="text-danger text-small text-muted">
                                        @foreach ($errors->get('deskripsi') as $err)
                                            <span class="text-danger">{{ $err }}</span>
                                        @endforeach
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <input type="hidden" class="form-control" name="id_penjual" value="{{ session()->get('id_users') }}" required>
                            <div class="mb-3 row">
                                <label for="penjual" class="col-sm-2 col-form-label">Penjual</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="penjual" value="{{ session()->get('nama_user') }}" readonly required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="nama_alumni" class="col-sm-2 col-form-label">Status Produk</label>
                                <div class="col-sm-10">
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input role" type="radio" name="status_produk" id="flexRadioDefault99" value="1" @if ($p->status_produk == '1') checked @endif>
                                        <label class="custom-control-label" for="flexRadioDefault99" style="font-weight: normal;">
                                            Tersedia
                                        </label>
                                        </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input role" type="radio" name="status_produk" id="flexRadioDefault88" value="0" @if ($p->status_produk == '0') checked @endif>
                                        <label class="custom-control-label" for="flexRadioDefault88" style="font-weight: normal;">
                                            Tidak Tersedia
                                        </label>
                                    </div>
                                    @if ($errors->has('status_produk'))
                                    <div class="text-danger text-small text-muted">
                                        @foreach ($errors->get('status_produk') as $err)
                                            <span class="text-danger">{{ $err }}</span>
                                        @endforeach
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <div class="mb-3 row control-group">
                                <label for="nis" class="col-sm-2 col-form-label">Foto</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input type="file" name="fotoproduk[]" class="form-control filefoto" required accept=".png,.jpg">
                                        <div class="input-group-prepend"> 
                                            <button class="btn btn-success addfile" type="button"><i class="fas fa-plus"></i> Add</button>
                                        </div>     

                                    </div>
                                    @if ($errors->has('fotoproduk.*'))
                                    <div class="text-danger text-small text-muted">
                                        @foreach ($errors->get('fotoproduk.*') as $err)
                                            <span class="text-danger">@php print_r($err[0]) @endphp</span>
                                        @endforeach
                                    </div>
                                    @endif  
                                </div>
                            </div>

                            <div class="fileadd"></div>

                        </div>

                        <div class="card-footer">
                            <button class="btn btn-primary" style="float: right">Simpan</button>
                        </div>
                    </form>
                
                @endforeach
            </div>

        </div>
    </section>
</div>
@endsection