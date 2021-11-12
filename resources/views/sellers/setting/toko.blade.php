@extends('sellers/master-sellers')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Toko Saya</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">Toko Saya</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-sm-8">
                        <div class="card">
                            <div class="card-header">
                                Toko Saya
                            </div>
                            <div class="card-body">

                                @foreach ($toko as $t)

                                @endforeach
                                <div class="mb-3 row">
                                    <label for="no_toko" class="col-sm-2 col-form-label">No Toko</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="no_toko" value="{{ $t->no_toko }}"
                                            readonly>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="nama_toko" class="col-sm-2 col-form-label">Nama Toko</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="nama_toko" placeholder="Nama Toko"
                                            value="{{ $t->nama_toko }}">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="nis" class="col-sm-2 col-form-label">Kategori Toko</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" id="floatingSelect" required
                                            aria-label="Kategori Toko Anda" name="id_kategoritoko">
                                            <option selected value="">- Kategori Toko -</option>
                                            @foreach ($kategoritoko as $k)
                                                <option
                                                    {{ $k->id_kategoritoko === $k->id_kategoritoko ? 'selected' : '' }}
                                                    value="{{ $k->id_kategoritoko }}">{{ $k->nama_kategoritoko }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="nis" class="col-sm-2 col-form-label">Deskripsi Toko</label>
                                    <div class="col-sm-10">
                                        <textarea name="deskripsi_toko" id="" cols="30" rows="10"
                                            class="form-control">{{ $t->deskripsi_toko }}</textarea>
                                    </div>
                                </div>

                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary" style="float: right">Simpan</button>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-header">
                                Logo Toko
                            </div>
                            <div class="card-body">
                                <div class="text-center">
                                    <img src="https://e7.pngegg.com/pngimages/805/486/png-clipart-vimeo-youtube-logo-computer-icons-youtube-blue-text.png"
                                        alt="" width="150" height="150" class="img-fluid"> <br>
                                    <a href="#" class="btn btn btn-light mt-4" data-bs-toggle="modal"
                                        data-bs-target="#modalupdatefoto" type="button"
                                        style="background-color:white; border: 2px solid #d9d9d9">Pilih Gambar</a>
                                </div>
                            </div>
                            <div class="card-footer text-muted">
                                <i>Rekomendasi Ukuran ... x ...</i>
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-header">
                                Foto Toko
                            </div>
                            <div class="card-body">
                                <div class="text-center">

                                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                        <div class="carousel-inner">
                                            <div class="carousel-item active">
                                                <img class="d-block w-100"
                                                    src="https://images.bisnis-cdn.com/posts/2020/03/16/1214084/ant-inflasi-sayur-pasar-mtb3.jpg"
                                                    alt="First slide">
                                            </div>
                                            <div class="carousel-item">
                                                <img class="d-block w-100"
                                                    src="https://images.bisnis-cdn.com/posts/2020/03/16/1214084/ant-inflasi-sayur-pasar-mtb3.jpg"
                                                    alt="Second slide">
                                            </div>
                                            <div class="carousel-item">
                                                <img class="d-block w-100"
                                                    src="https://images.bisnis-cdn.com/posts/2020/03/16/1214084/ant-inflasi-sayur-pasar-mtb3.jpg"
                                                    alt="Third slide">
                                            </div>
                                        </div>
                                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button"
                                            data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carouselExampleControls" role="button"
                                            data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>

                                    <form action="#" method="post" class="mt-4">
                                        <div class="input-group">
                                            <input type="file" name="fotopasar[]" class="form-control filefoto" required
                                                accept=".png,.jpg">
                                            <div class="input-group-prepend">
                                                <button class="btn btn-success addfile" type="button"><i
                                                        class="fas fa-plus"></i> Add</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card-footer text-muted">
                                <i>Rekomendasi Ukuran ... x ...</i>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </section>
    </div>
@endsection
