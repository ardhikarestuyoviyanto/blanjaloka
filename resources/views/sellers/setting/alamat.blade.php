@extends('sellers/master-sellers')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Alamat Toko</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Alamat Toko</li>
                </ol>
            </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    Alamat Toko
                </div>
                <div class="card-body">
                    Lokasi Pasar (Readonly), (Provinsi, Kecamatan, Kabupaten) => dari tabel pasar <br>
                    Alamat Toko <br>
                    Embbed Maps Toko <br>
                    Tampilan Preview Emmbed maps
                </div>
            </div>
        </div>
    </section>
</div>
@endsection