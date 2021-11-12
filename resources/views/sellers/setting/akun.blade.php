@extends('sellers/master-sellers')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Akun Saya</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">Akun Saya</li>
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
                                Akun Saya
                            </div>

                            @foreach ($penjual as $p)
                                <form action="{{ url('sellers/setting/akunsaya') }}" enctype="multipart/form-data"
                                    method="POST">
                                    @csrf
                                    <input type="hidden" name="id_penjual" value="{{ $p->id_penjual }}">
                                    <div class="card-body">
                                        <div class="mb-3 row">
                                            <label for="nama_user" class="col-sm-2 col-form-label">Nama Penjual</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="nama_user"
                                                    placeholder="Nama Sellers" value="{{ $p->nama_user }}" readonly>
                                                <small class="form-text text-muted"><a href="{{ url('setting/profil') }}"
                                                        target="_blank">Klik Disini</a> Untuk Update Nama Penjual</small>
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label for="pin" class="col-sm-2 col-form-label">PIN Penjual</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" name="pin"
                                                    placeholder="PIN max 6 Digit" required>
                                                @if ($errors->has('pin'))
                                                    <div class="text-danger text-small">
                                                        @foreach ($errors->get('pin') as $err)
                                                            {{ $err }}
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label for="no_ktp" class="col-sm-2 col-form-label">No KTP</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="no_ktp"
                                                    value="{{ $p->no_ktp }}" placeholder="Nama Sellers">
                                                @if ($errors->has('no_ktp'))
                                                    <div class="text-danger text-small">
                                                        @foreach ($errors->get('no_ktp') as $err)
                                                            {{ $err }}
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label for="foto_ktp" class="col-sm-2 col-form-label">Foto KTP</label>
                                            <div class="col-sm-10">
                                                <input type="file" class="form-control" name="foto_ktp" required
                                                    name="foto_ktp" accept=".png,.jpg,.jpeg">
                                                @if ($errors->has('foto_ktp'))
                                                    <div class="text-danger text-small">
                                                        @foreach ($errors->get('foto_ktp') as $err)
                                                            {{ $err }}
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label for="foto_penjual_ktp" class="col-sm-2 col-form-label">Foto Seller dengan
                                                KTP</label>
                                            <div class="col-sm-10">
                                                <input type="file" class="form-control" name="foto_penjual_ktp" required
                                                    name="foto_penjual_ktp" accept=".png,.jpg,.jpeg">
                                                @if ($errors->has('foto_penjual_ktp'))
                                                    <div class="text-danger text-small">
                                                        @foreach ($errors->get('foto_penjual_ktp') as $err)
                                                            {{ $err }}
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary" style="float: right">Simpan</button>
                                    </div>
                        </div>
                    </div>
                    </form>
                    @endforeach

                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-header">
                                Foto KTP
                            </div>
                            <div class="card-body">
                                <div class="text-center">
                                    <img src="https://help.shopee.co.id/servlet/rtaImage?eid=ka06F000000xT4i&feoid=00N6F00000Rj6Gl&refid=0EM6F000008vxV9"
                                        alt="" width="349" height="213" class="img-fluid">

                                </div>
                            </div>
                            <div class="card-footer text-muted">
                                <i>Rekomendasi Ukuran 349 x 213</i>
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-header">
                                Foto Penjual dengan KTP
                            </div>
                            <div class="card-body">
                                <div class="text-center">
                                    <img src="https://images.bisnis-cdn.com/posts/2021/02/14/1355981/ektptsunami281218.jpg"
                                        alt="" class="img-fluid" width="349" height="213">

                                </div>
                            </div>
                            <div class="card-footer text-muted">
                                <i>Rekomendasi Ukuran 349 x 213</i>
                            </div>
                        </div>

                    </div>
                </div>


            </div>
        </section>
    </div>
@endsection
