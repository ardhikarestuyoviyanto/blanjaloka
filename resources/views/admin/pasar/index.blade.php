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

                        <div class="float-right d-none d-sm-inline-block">
                            <a href="{{ url('admin/pasar/create') }}" class="btn btn-primary">Tambah</a>
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="97%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pasar</th>
                                        <th>Alamat</th>
                                        <th>Jam Operasional</th>
                                        <th>Maps</th>
                                        <th>Foto</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{ !($i = 1) }}
                                    @foreach ($pasar as $p)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $p->nama_pasar }}</td>
                                            <td>{{ $p->alamat }}</td>
                                            <td>{{ $p->operasional_pasar }}</td>
                                            <td>{{ $p->embbed_maps }}</td>
                                            <td>
                                                <img src="{{ url('assets/admin/foto_pasar/' . $p->foto_pasar) }}"
                                                    alt="foto pasar" width="200px">
                                            </td>
                                            <td>
                                                <a href="{{ url('admin/pasar/' . $p->id_pasar . '/edit') }}"
                                                    class="btn btn-warning">Edit</a>
                                                <form action="{{ url('admin/pasar/' . $p->id_pasar) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="submit" class="btn btn-danger"
                                                        onclick="return confirm('Apakah anda yakin ?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>

    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({});
        });
        ss
    </script>

@endsection
