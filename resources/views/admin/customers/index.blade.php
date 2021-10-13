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
                        <div class="card-header">
                            Data Customers
                        </div>
                        <div class="card-body">
                        <table id="customerstable" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th style="width:10px;">No</th>
                                <th>Customers</th>
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
<script>
    $(document).ready(function(){
        $('#customerstable').DataTable();
    });
</script>
@endsection