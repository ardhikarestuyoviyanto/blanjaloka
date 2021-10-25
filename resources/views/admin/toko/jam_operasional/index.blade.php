@extends('admin/master-admin')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Jam Operasional</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('admin/toko')}}">Data Toko</a></li>
                            <li class="breadcrumb-item active">Jam Operasional</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        Jam Operasional

                        <div class="float-right d-none d-sm-inline-block">
                            <a href="#" data-toggle="modal" data-target="#addjamtoko" class="btn btn-primary btn-sm">Tambah</a>
                        </div>

                    </div>
                    
                    <div class="card-header bg-gray-light">
                        @foreach($sellers as $s)
                        <table width="100%">
                            <tbody>
                                <tr class="text-bold">
                                    <td width="150px">No Toko</td>
                                    <td width="10px">:</td>
                                    <td>{{$s->no_pasar}}</td>
                                </tr>
                                <tr class="text-bold">
                                    <td width="150px">Nama Toko</td>
                                    <td width="10px">:</td>
                                    <td>{{$s->nama_toko}}</td>
                                </tr>
                                <tr class="text-bold">
                                    <td width="150px">Nama Seller</td>
                                    <td width="10px">:</td>
                                    <td>{{$s->nama_user}}</td>
                                </tr>
                                <tr class="text-bold">
                                    <td width="150px">Lokasi Pasar</td>
                                    <td width="10px">:</td>
                                    <td>{{$s->nama_pasar}}</td>
                                </tr>
                            </tbody>
                        </table>
                        @endforeach
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered table-hover" id="pasartable">
                            <thead>
                                <tr>
                                    <th style="width:10px;">No</th>
                                    <th>Hari</th>
                                    <th>Jam Buka</th>
                                    <th>Jam Tutup</th>
                                    <th>Catatan</th>
                                    <th style="width:10px;" class='notexport'>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jamtoko as $no=>$j)
                                        <tr>
                                            <td>{{ $no + 1 }}</td>
                                            <td>{{ ucfirst($j->hari) }}</td>
                                            <td>{{ $j->buka }}</td>
                                            <td>{{ $j->tutup }}</td>
                                            <td>{{ $j->catatan }}</td>
                                            <td class="text-center">
                                                <a href="#"  class="edit_jamtoko" data-id="{{$j->id_jamtoko}}" data-toggle="tooltip" title="Edit" data-placement="top"><span class="badge badge-success"><i class="fas fa-edit"></i></span></a>
                                                <a href="#" data-id="<?= $j->id_jamtoko; ?>" class="delete_jamtoko" data-toggle="tooltip" title="Hapus" data-placement="top"><span class="badge badge-danger"><i class="fas fa-trash"></i></span></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </section>
    </div>

    {{-- Modal Tambah Jam Toko --}}
    <div class="modal fade" id="addjamtoko">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambahkan Jam Operasional Toko</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="saveform">
                @csrf
                <input type="hidden" name="id_penjual" value="{{$id_penjual}}">
                <div class="modal-body">
                    <div class="mb-3 row">
                        <label for="nis" class="col-sm-2 col-form-label">Pilih Hari</label>
                        <div class="col-sm-10">
                            <select class="custom-select" required name="hari">
                                <option selected value="">- PILIH HARI -</option>
                                <option value="senin">- SENIN -</option>
                                <option value="selasa">- SELASA -</option>
                                <option value="rabu">- RABU -</option>
                                <option value="kamis">- KAMIS -</option>
                                <option value="jumat">- JUMAT -</option>
                                <option value="sabtu">- SABTU -</option>
                                <option value="minggu">- MINGGU -</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nis" class="col-sm-2 col-form-label">Jam Buka</label>
                        <div class="col-sm-10">
                            <input type="time" name="buka" id="" required class="form-control" placeholder="Jam Toko Buka">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nis" class="col-sm-2 col-form-label">Jam Tutup</label>
                        <div class="col-sm-10">
                            <input type="time" name="tutup" id="" required class="form-control" placeholder="Jam Toko Tutup">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nis" class="col-sm-2 col-form-label">Catatan</label>
                        <div class="col-sm-10">
                            <input type="text" name="catatan" id="" class="form-control" placeholder="Catatan Tambahan">
                        </div>
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

    {{-- Modal Edit Jam Toko --}}
    <div class="modal fade" id="editjamtoko">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Jam Operasional Pasar</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="updateform">
                @csrf
                <input type="hidden" name="id_jamtoko" id="id_jamtoko">
                <div class="modal-body">
                    <div class="mb-3 row">
                        <label for="nis" class="col-sm-2 col-form-label">Pilih Hari</label>
                        <div class="col-sm-10">
                            <select class="custom-select" required name="hari" id="hari">
                                <option selected value="">- PILIH HARI -</option>
                                <option value="senin">- SENIN -</option>
                                <option value="selasa">- SELASA -</option>
                                <option value="rabu">- RABU -</option>
                                <option value="kamis">- KAMIS -</option>
                                <option value="jumat">- JUMAT -</option>
                                <option value="sabtu">- SABTU -</option>
                                <option value="minggu">- MINGGU -</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nis" class="col-sm-2 col-form-label">Jam Buka</label>
                        <div class="col-sm-10">
                            <input type="time" name="buka" id="buka" required class="form-control" placeholder="Jam Pasar Buka">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nis" class="col-sm-2 col-form-label">Jam Tutup</label>
                        <div class="col-sm-10">
                            <input type="time" name="tutup" id="tutup" required class="form-control" placeholder="Jam Pasar Tutup">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nis" class="col-sm-2 col-form-label">Catatan</label>
                        <div class="col-sm-10">
                            <input type="text" name="catatan" id="catatan" class="form-control" placeholder="Catatan Tambahan">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm">  
                        Update
                    </button>
                </div>
            </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
            
            $('#pasartable').DataTable({
                "responsive":true,
            });

            //save form
            $('#saveform').submit(function(e){
                e.preventDefault();
                $.ajax({
                    data: $(this).serialize(),
                    type: 'POST',
                    url:"{{url('admin/toko/jam/insert')}}",
                    success : function(data){
                        swal(data.pesan)
                        .then((result) => {
                            location.reload();
                        });
                    },
                    error : function(err){
                        alert(err);
                        console.log(err);
                    }
                });

            });


            //show modal update form 
            $('.edit_jamtoko').click(function(e){
                e.preventDefault();
                $.ajax({
                    data: {'id_jamtoko':$(this).data('id'), '_token': "{{csrf_token()}}"},
                    type: 'POST',
                    url:"{{url('admin/toko/jam/get')}}",
                    success : function(data){
                        $('#id_jamtoko').val(data[0].id_jamtoko);
                        $('#hari').val(data[0].hari);
                        $('#buka').val(data[0].buka);
                        $('#tutup').val(data[0].tutup);
                        $('#catatan').val(data[0].catatan);
                        
                        $('#editjamtoko').modal('show');
                    },
                    error : function(err){
                        alert(err);
                        console.log(err);
                    }
                });
            });

            //update jam toko
            $('#updateform').submit(function(e){
                e.preventDefault();
                $.ajax({
                    data: $(this).serialize(),
                    type: 'POST',
                    url:"{{url('admin/toko/jam/update')}}",
                    success : function(data){
                        swal(data.pesan)
                        .then((result) => {
                            location.reload();
                        });
                    },
                    error : function(err){
                        alert(err);
                        console.log(err);
                    }
                });

            });

            //delete jam toko
            $('.delete_jamtoko').click(function(e){
                e.preventDefault();
                var confirmed = confirm('Hapus jam ini ?');

                if(confirmed) {

                    $.ajax({
                        data: {'id_jamtoko':$(this).data('id'), '_token': "{{csrf_token()}}"},
                        type: 'POST',
                        url:"{{url('admin/toko/jam/delete')}}",
                        success : function(data){
                            swal(data.pesan)
                            .then((result) => {
                                location.reload();
                            });
                        },
                        error : function(err){
                            alert(err);
                            console.log(err);
                        }
                    });
                }
            });

        });
        
    </script>

@endsection
