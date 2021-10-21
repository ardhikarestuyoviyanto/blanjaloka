@extends('admin/master-admin')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Customer</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('admin/users/customers')}}">Data Customers</a></li>
                        <li class="breadcrumb-item active">Edit Customers</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            {{-- Notif Jika Akun Berhasil Diedit --}}
            @if ($status = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <b>{{$status}}</b>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            {{-- cek akun ini terdaftar sebagai seller atau tidak --}}
            @if(count($sellers) != 0)
                <div class="alert alert-light" role="alert">
                    @foreach ($sellers as $s)
                        <b>Akun ini terdaftar sebagai akun seller, di <a href="" style="color: black"><u>{{$s->nama_pasar}}</u></a></b>
                    @endforeach
                </div>
            @else
                <div class="alert alert-light" role="alert">
                    <b>Akun ini <u>belum terdaftar</u> sebagai akun seller</b>
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    Edit Data Customers
                    @if(count($sellers) !=0)
                        @foreach($sellers as $s)
                            <a href="{{url('admin/users/sellers/edit/'.$s->id_penjual)}}" class="btn btn-success btn-sm" style="float: right"><i class="fas fa-store-alt"></i> Lihat Akun Sellers</a>
                        @endforeach
                    @else
                        <a href="#" data-toggle="modal" data-target="#addsellers" type="button" class="btn btn-info btn-sm" style="float: right"><i class="fas fa-store-alt"></i> Jadikan Akun Seller</a>
                    @endif
                </div>

                @foreach($customers as $c)
                <form action="{{url('admin/users/customers/edithandler')}}" method="POST">
                    @csrf
                    <input type="hidden" name="id_users" value="{{$c->id_users}}">
                    <div class="card-body">
                        <div class="mb-3 row">
                            <label for="nis" class="col-sm-2 col-form-label">Nama Customers</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nama_user" placeholder="Nama Customers" value="{{$c->nama_user}}">
                                @if ($errors->has('nama_user'))
                                <div class="text-danger text-small text-muted">
                                    @foreach ($errors->get('nama_user') as $err)
                                        <span class="text-danger">{{ $err }}</span>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="nis" class="col-sm-2 col-form-label">Alamat Lengkap</label>
                            <div class="col-sm-10">
                                <textarea name="alamat" class="form-control" cols="6" rows="6" placeholder="Alamat Lengkap, Meliputi RT RW">{{$c->alamat}}</textarea>
                                @if ($errors->has('alamat'))
                                <div class="text-danger text-small text-muted">
                                    @foreach ($errors->get('alamat') as $err)
                                        <span class="text-danger">{{ $err }}</span>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="nama_alumni" class="col-sm-2 col-form-label">Status Akun</label>
                            <div class="col-sm-10">
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input role" type="radio" name="status" id="flexRadioDefault33" value="on" @if($c->status == 'on') checked @endif>
                                    <label class="custom-control-label" for="flexRadioDefault33" style="font-weight: normal;">
                                        Aktif
                                    </label>
                                    </div>
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input role" type="radio" name="status" id="flexRadioDefault44" value="off" @if($c->status == 'off') checked @endif>
                                    <label class="custom-control-label" for="flexRadioDefault44" style="font-weight: normal;">
                                        Tidak Aktif
                                    </label>
                                </div>
                                @if ($errors->has('status'))
                                <div class="text-danger text-small text-muted">
                                    @foreach ($errors->get('status') as $err)
                                        <span class="text-danger">{{ $err }}</span>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="nis" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="email" placeholder="Email" value="{{$c->email}}">
                                @if ($errors->has('email'))
                                <div class="text-danger text-small text-muted">
                                    @foreach ($errors->get('email') as $err)
                                        <span class="text-danger">{{ $err }}</span>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="nis" class="col-sm-2 col-form-label">No Telpon</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="no_telp" placeholder="No Telpon" value="{{$c->no_telp}}">
                                @if ($errors->has('no_telp'))
                                <div class="text-danger text-small text-muted">
                                    @foreach ($errors->get('no_telp') as $err)
                                        <span class="text-danger">{{ $err }}</span>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="nis" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="password" placeholder="Password">
                                @if ($errors->has('password'))
                                <span class="text-danger text-small text-muted">
                                    @foreach ($errors->get('password') as $err)
                                        <span class="text-danger">{{ $err }}</span>
                                    @endforeach
                                </span>
                                @else
                                <span class="text-black text-small">
                                    <small><i>Jika gak perlu diubah, dikosongin aja</i></small>
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

<div class="modal fade" id="addsellers">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Jadikan akun sellers</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form method="POST" action="{{url('admin/users/customers/makesellers')}}">
            @csrf
            <input type="hidden" name="id_users" value="{{$id_users}}">
            <div class="modal-body">
                <div class="mb-3">
                    <label>No Toko</label>
                    <input type="text" name="no_toko" id="no_toko" class="form-control" required placeholder="Nomor Toko">
                </div>
                <div class="mb-3">
                    <label>Nama Toko</label>
                    <input type="text" name="nama_toko" id="nama_toko" class="form-control" required placeholder="Masukkan nama toko">
                </div>
                <div class="mb-3">
                    <label>Kategori Toko</label>
                    <select class="custom-select" required name="id_kategoritoko">
                        <option selected value="">Pilih Kategori Toko</option>
                        @foreach ($kategoritoko as $k)
                            <option value="{{$k->id_kategoritoko}}">{{$k->nama_kategoritoko}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label>Status Akun Toko</label>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input role" type="radio" name="status" id="flexRadioDefault55" value="on" required>
                        <label class="custom-control-label" for="flexRadioDefault55" style="font-weight: normal;">
                            Aktif
                        </label>
                        </div>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input role" type="radio" name="status" id="flexRadioDefault66" value="off" required>
                        <label class="custom-control-label" for="flexRadioDefault66" style="font-weight: normal;">
                            Tidak Aktif
                        </label>
                    </div>
                </div>
                <div class="mb-3">
                    <label>Pilih Lokasi Pasar</label>
                    <select class="custom-select" required name="id_pasar">
                        <option selected value="">Pilih Lokasi Pasar</option>
                        @foreach ($pasar as $p)
                            <option value="{{$p->id_pasar}}">{{$p->nama_pasar}}</option>
                        @endforeach
                    </select>
                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-sm">  
                    Simpan
                </button>
            </div>
        </form>
        </div>
    </div>
</div>
@endsection