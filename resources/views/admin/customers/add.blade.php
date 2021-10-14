@extends('admin/master-admin')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Customer</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('admin/users/customers')}}">Data Customers</a></li>
                        <li class="breadcrumb-item active">Tambah Customers</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    Tambah Customers
                </div>
                <form action="{{url('admin/users/customers/addhandler')}}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="mb-3 row">
                            <label for="nis" class="col-sm-2 col-form-label">Nama Customers</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nama_user" placeholder="Nama Customers" value="{{old('nama_user')}}">
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
                                <textarea name="alamat" class="form-control" cols="6" rows="6" placeholder="Alamat Lngkap, Meliputi RT RW">{{old('alamat')}}</textarea>
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
                                    <input class="custom-control-input role" type="radio" name="status" id="flexRadioDefault33" value="on">
                                    <label class="custom-control-label" for="flexRadioDefault33" style="font-weight: normal;">
                                        Aktif
                                    </label>
                                    </div>
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input role" type="radio" name="status" id="flexRadioDefault44" value="off">
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
                                <input type="text" class="form-control" name="email" placeholder="Email" value="{{old('email')}}">
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
                                <input type="number" class="form-control" name="no_telp" placeholder="No Telpon" value="{{old('no_telp')}}">
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
                                @endif
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary btn-sm" style="float: right">Simpan</button>
                    </div>
                </form>
            </div>

        </div>
    </section>
</div>

{{-- Notif Jika Akun Berhasil Dibuat --}}
@if ($status = Session::get('success'))
<script>
    swal("{{$status}}")
</script>
@endif

@endsection