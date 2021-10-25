{{-- semua view yang dibuat didalam folder web harus di extend kan dengan file master --}}
@extends('web/master')
@section('content')

<!-- breadcrumb -->
<section class="pt-xl-5 pt-4">
    <div class="container">
        <nav id="breadcrumb" style="--bs-breadcrumb-divider: '&rarr;'" aria-label="breadcrumb">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-decoration-none cai-color-text" href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Daftar Sebagai Sellers</li>
            </ol>
        </nav>
    </div>
</section>
<!-- END OF BREADCRUMB -->

<!-- DAFTAR SEBAGAI SELLERS -->
<section class="mt-0">
    <div class="container">
        <div class="alert alert-success" role="alert">
            Akun ini belum terdaftar sebagai sellers, silahkan lengkapi data dibawah untuk mendaftar akun sellers
        </div>
    </div>
</section>
<!-- DAFTAR SEBAGAI SELLERS -->

<section class="mt-3">
    <div class="container">
        <div class="card">
            <div class="card-body">
                @foreach($customers as $c)
                <form action="{{url('sellers/daftar_handler')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-floating mb-4">
                        <input type="text" class="form-control bg-white" id="floatingInput" value="{{$c->nama_user}}" required readonly>
                        <label for="floatingInput">Nama Sellers</label>
                    </div>
                    <div class="form-floating mb-4">
                        <input type="text" class="form-control" id="floatingInput" required name="nama_toko" value="{{old('nama_toko')}}">
                        <label for="floatingInput">Nama Toko</label>
                    </div>
                    <div class="form-floating mb-4">
                        <select class="form-select" id="floatingSelect" required aria-label="Kategori Toko Anda" name="id_kategoritoko">
                            <option selected value="">- Kategori Toko -</option>
                            @foreach ($kategoritoko as $k)
                                <option value="{{$k->id_kategoritoko}}">{{$k->nama_kategoritoko}}</option>
                            @endforeach
                        </select>
                        <label for="floatingSelect">Kategori Toko Anda</label>
                    </div>
                    <div class="form-floating mb-4">
                        <select class="form-select" id="floatingSelect" required aria-label="Lokasi Pasar" name="id_pasar">
                            <option selected value="">- Lokasi Pasar -</option>
                            @foreach ($pasar as $p)
                                <option value="{{$p->id_pasar}}">{{$p->nama_pasar}}</option>
                            @endforeach
                        </select>
                        <label for="floatingSelect">Lokasi Pasar Tempat Anda Berjualan</label>
                    </div>
                    <div class="form-floating mb-4">
                        <textarea class="form-control" placeholder="Alamat Toko" name="alamat_toko" id="floatingTextarea2" style="height: 100px" required>{{old('alamat_toko')}}</textarea>
                        <label for="floatingTextarea2">Alamat Toko</label>
                    </div>
                    <div class="form-floating mb-4">
                        <input type="number" class="form-control" id="floatingInput" required name="no_ktp" value="{{old('no_ktp')}}">
                        <label for="floatingInput" id="label_noktp">Nomor Ktp</label>
                        @if ($errors->has('no_ktp'))
                            <div class="text-danger text-small">
                                @foreach ($errors->get('no_ktp') as $err)
                                    {{ $err }}
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <div class="mb-4">
                        <label for="formFile" class="form-label">Foto KTP</label>
                        <input class="form-control" type="file" id="formFile" required name="foto_ktp" accept=".png,.jpg,.jpeg">
                        @if ($errors->has('foto_ktp'))
                        <div class="text-danger text-small">
                            @foreach ($errors->get('foto_ktp') as $err)
                                {{ $err }}
                            @endforeach
                        </div>
                    @endif
                    </div>
                    <div class="mb-4">
                        <label for="formFile" class="form-label">Foto Penjual Memegang KTP</label>
                        <input class="form-control" type="file" id="formFile" required name="foto_penjual_ktp" accept=".png,.jpg,.jpeg">
                        @if ($errors->has('foto_penjual_ktp'))
                        <div class="text-danger text-small">
                            @foreach ($errors->get('foto_penjual_ktp') as $err)
                                {{ $err }}
                            @endforeach
                        </div>
                    @endif
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary submit" style="float: right">Register</button>
                </div>
            </form>
        @endforeach
        </div>

    </div>
</section>
  
@endsection