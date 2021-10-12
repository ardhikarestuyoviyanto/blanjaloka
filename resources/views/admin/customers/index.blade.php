@extends('admin/master-admin')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Customer</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Master Users</a></li>
                    <li class="breadcrumb-item active">Data Customers</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <!-- /.card-header -->
                        <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                            <th>#</th>
                            <th>Nama User</th>
                            <th>Email</th>
                            <th>Alamat</th>
                            <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                                    @forelse ($customers as $no=>$c)
                                    <tr>
                                        <td>{{ $no + 1 }}</td>
                                        <td>{{ $c->nama_user }}</td>
                                        <td>{{ $c->email }}</td>
                                        <td>{{ $c->alamat }}</td>
                                        <td>{{ $c->status }}</td>
                                    </tr>
                                @empty
                                    <tr colspan="4">
                                        <td>Data Kosong</td>
                                    </tr>
                                @endforelse
                                
                            </tbody>
                            <tfoot>
                            <tr>
                            <th>No</th>
                            <th>Nama User</th>
                            <th>Email</th>
                            <th>Alamat</th>
                            <th>Status</th>
                            </tr>
                            </tfoot>
                        </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            <!-- /.col -->
            </div>
        <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
</div>
@endsection