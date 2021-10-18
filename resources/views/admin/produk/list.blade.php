@extends('admin/master-admin')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detail Toko</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('admin/produk')}}">Lihat Produk</a></li>
                        <li class="breadcrumb-item active">Detail Toko</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-3">
      
                  <!-- Profile Image -->
                  <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                      <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle" src="{{url('assets/blanjaloka/img/user4-128x128.jpg')}}" alt="User profile picture">
                      </div>
      
                      <h3 class="profile-username text-center">Toko Pak Budi</h3>
      
                      <p class="text-muted text-center">Budi</p>
      
                      <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                          <b>Total Produk</b> <a class="float-right">1,322</a>
                        </li>
                        <li class="list-group-item">
                          <b>Produk Terjual</b> <a class="float-right">543</a>
                        </li>
                        <li class="list-group-item">
                          <b>Produk Habis</b> <a class="float-right">13,287</a>
                        </li>
                      </ul>
      
                    </div>
                  </div>
      
                  <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title">Jam Operasional Toko</h3>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">Hari</th>
                                <th scope="col">Buka</th>
                                <th scope="col">Tutup</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <th scope="row">Senin</th>
                                <td>Mark</td>
                                <td>Otto</td>
                              </tr>
                              <tr>
                                <th scope="row">Selasa</th>
                                <td>Mark</td>
                                <td>Otto</td>
                              </tr>
                            </tbody>
                          </table>
                    </div>
                  </div>
                </div>

                <div class="col-md-9">
                  <div class="card">
                    <div class="card-header p-2">
                      <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">List Produk</a></li>
                        <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Riwayat Transaksi</a></li>
                        <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Lokasi Toko</a></li>
                        <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Promo</a></li>
                        <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                      </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                      <div class="tab-content">
                        <div class="active tab-pane" id="activity">



                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>

        </div>
    </section>
</div>


@endsection