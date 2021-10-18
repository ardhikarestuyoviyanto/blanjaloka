@extends('admin/master-admin')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Sellers</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('admin/users/sellers')}}">Data Sellers</a></li>
                        <li class="breadcrumb-item active">Edit Sellers</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            {{-- Notif Jika Sellers Berhasil Diedit --}}
            @if ($status = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <b>{{$status}}</b>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            <div class="card">
                <div class="card-header">
                    Edit Data Sellers
                    <a href="#" style="float: right" class="btn btn-success btn-sm"><i class="fas fa-store-alt"></i> Lihat Toko</a>
                </div>

                @foreach($sellers as $s)
                <form action="{{url('admin/users/sellers/edithandler')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id_penjual" value="{{$s->id_penjual}}">
                    <div class="card-body">
                        <div class="mb-3 row">
                            <label for="nis" class="col-sm-2 col-form-label">Nama Sellers</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nama_user" placeholder="Nama Sellers" readonly value="{{$s->nama_user}}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="nis" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="email" placeholder="Email Sellers" readonly value="{{$s->email}}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="nis" class="col-sm-2 col-form-label">No Telpon</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="no_telp" placeholder="No Telpon" readonly value="{{$s->no_telp}}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="nis" class="col-sm-2 col-form-label">Nama Toko</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nama_toko" placeholder="Nama Toko" value="{{$s->nama_toko}}" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="nis" class="col-sm-2 col-form-label">Lokasi Pasar</label>
                            <div class="col-sm-10">
                                <select class="custom-select" required name="id_pasar" required>
                                    <option selected value="">Pilih Lokasi Pasar</option>
                                    @foreach ($pasar as $p)
                                        @if($s->id_pasar == $p->id_pasar)
                                            <option selected value="{{$p->id_pasar}}">{{$p->nama_pasar}}</option>
                                        @else
                                            <option value="{{$p->id_pasar}}">{{$p->nama_pasar}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="nama_alumni" class="col-sm-2 col-form-label">Status Akun</label>
                            <div class="col-sm-10">
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input role" type="radio" required name="status" id="flexRadioDefault33" value="on" @if($s->status == 'on') checked @endif>
                                    <label class="custom-control-label" for="flexRadioDefault33" style="font-weight: normal;">
                                        Aktif
                                    </label>
                                    </div>
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input role" type="radio" required name="status" id="flexRadioDefault44" value="off" @if($s->status == 'off') checked @endif>
                                    <label class="custom-control-label" for="flexRadioDefault44" style="font-weight: normal;">
                                        Tidak Aktif
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="nis" class="col-sm-2 col-form-label">Deskripsi Toko</label>
                            <div class="col-sm-10">
                                <textarea name="deskripsi_toko" class="form-control" cols="6" rows="6" required placeholder="Deskripsi Toko">{{$s->deskripsi_toko}}</textarea>
                                @if ($errors->has('deskripsi_toko'))
                                <div class="text-danger text-small text-muted">
                                    @foreach ($errors->get('deskripsi_toko') as $err)
                                        <span class="text-danger">{{ $err }}</span>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="nis" class="col-sm-2 col-form-label">Logo Toko</label>
                            <div class="col-sm-10">
                                <input type="file" name="logo_toko" class="form-control" accept=".png,.jpg">
                                @if ($errors->has('logo_toko'))
                                <span class="text-danger text-small text-muted">
                                    @foreach ($errors->get('logo_toko') as $err)
                                        <span class="text-danger">{{ $err }}</span>
                                    @endforeach
                                </span>
                                @else
                                <span class="text-black text-small">
                                    <small><i>Jika gak perlu diubah, dikosongin aja</i></small><br>
                                    <small><i>Logo Terpasang <a target="_blank" href="{{url('assets/admin/logo_toko/'.$s->logo_toko)}}">{{$s->logo_toko}}</a></i></small>
                                </span>
                                @endif
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary btn-sm" style="float: right">Update Data</button>
                    </div>
                </form>
                @endforeach
            </div>
        </div>
    </section>
</div>
@endsection