@extends('admin/master-admin')
@section('content')
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
                    </div>
                    <div class="card-body">
                        <form action="{{ url('admin/pasar/' . $pasar->id_pasar) }}" method="POST">
                            <input type="hidden" name="_method" value="PATCH">
                            @csrf
                            <div class="row">
                                <div class="col-8">
                                    <div class="row mb-3">
                                        <label for="nama_pasar" class="col-sm-2 col-form-label">Nama Pasar</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="nama_pasar" name="nama_pasar"
                                                value="{{ $pasar->nama_pasar }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" name="alamat"
                                                id="alamat">{{ $pasar->alamat }}</textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="operasional_pasar" class="col-sm-2 col-form-label">Jam
                                            operasional</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="operasional_pasar"
                                                name="operasional_pasar" value="{{ $pasar->operasional_pasar }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="embbed_maps" class="col-sm-2 col-form-label">Maps</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="embbed_maps" name="embbed_maps"
                                                value="{{ $pasar->embbed_maps }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="foto_pasar" class="col-sm-2 col-form-label">Foto Pasar</label>
                                        <div class="col-sm-10">
                                            <img src="{{ url('assets/admin/foto_pasar/' . $pasar->foto_pasar) }}"
                                                alt="foto pasar" width="200px">
                                            <input type="file" class="form-control" id="foto_pasar" name="foto_pasar">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </form>
                    </div>
                </div>

            </div>
        </section>
    </div>

@endsection
