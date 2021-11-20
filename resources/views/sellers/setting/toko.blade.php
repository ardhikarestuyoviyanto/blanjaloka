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

                            @foreach ($toko as $t)
                                <form action="{{ url('sellers/setting/tokosaya') }}" enctype="multipart/form-data"
                                    method="POST">
                                    @csrf
                                    <input type="hidden" name="id_penjual" value="{{ $t->id_penjual }}">
                                    <div class="card-body">
                                        <div class="mb-3 row">
                                            <label for="no_toko" class="col-sm-2 col-form-label">No Toko</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="no_toko"
                                                    value="{{ $t->no_toko }}" readonly>
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label for="nama_toko" class="col-sm-2 col-form-label">Nama Toko</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="nama_toko"
                                                    placeholder="Nama Toko" value="{{ $t->nama_toko }}" required>
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
                                                            {{ $k->id_kategoritoko == $t->id_kategoritoko ? 'selected' : '' }}
                                                            value="{{ $k->id_kategoritoko }}">
                                                            {{ $k->nama_kategoritoko }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label for="nis" class="col-sm-2 col-form-label">Deskripsi Toko</label>
                                            <div class="col-sm-10">
                                                <textarea name="deskripsi_toko" id="" cols="30" rows="10"
                                                    class="form-control" required>{{ $t->deskripsi_toko }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary" style="float: right">Simpan</button>
                                    </div>
                                </form>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-header">
                                Logo Toko
                            </div>
                            <div class="card-body">
                                <div class="text-center">
                                    @if ($t->logo_toko === '')
                                        <img src="https://e7.pngegg.com/pngimages/805/486/png-clipart-vimeo-youtube-logo-computer-icons-youtube-blue-text.png"
                                            alt="" width="150" height="150" class="img-fluid">
                                    @else
                                        <img src="{{ asset('assets/admin/logo_toko/' . $t->logo_toko) }}" alt=""
                                            width="150" height="150" class="img-fluid" alt="logo toko">
                                    @endif
                                    <br>

                                    {{-- <a href="#" class="btn btn btn-light mt-4" data-bs-toggle="modal"
                                        data-bs-target="#modalupdatefoto" type="button"
                                        style="background-color:white; border: 2px solid #d9d9d9">Pilih Gambar</a> --}}

                                    <a href="#" data-id="<?= $t->id_penjual ?>" id="edit" class="btn btn btn-light mt-4"
                                        data-toggle="tooltip" data-placement="top"
                                        style="background-color:white; border: 2px solid #d9d9d9; padding:5px">
                                        Pilih Gambar
                                    </a>
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


                                            @php
                                                $arr_fototoko = explode(',', $t->foto_toko);
                                            @endphp
                                            @for ($i = 0; $i < count($arr_fototoko); $i++)
                                                <div class="carousel-item active">
                                                    <img class="d-block w-100"
                                                        src="{{ asset('assets/admin/foto_toko/' . $arr_fototoko[$i]) }}"
                                                        width="200" height="200" class="img-fluid" alt="foto toko">
                                                </div>
                                            @endfor
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

                                    <form action="{{ url('sellers/setting/fototoko') }}" enctype="multipart/form-data"
                                        method="POST" class="mt-4">
                                        @csrf
                                        <input type="hidden" name="id_penjual" value="{{ $t->id_penjual }}">
                                        <div class="input-group">
                                            <input type="file" name="foto_toko[]" class="form-control filefoto" required
                                                accept=".png,.jpg">
                                            <div class="input-group-prepend">
                                                <button class="btn btn-success addfile" type="button"><i
                                                        class="fas fa-plus"></i> Add</button>
                                            </div>

                                            @if ($errors->has('foto_toko.*'))
                                                <div class="text-danger text-small text-muted">
                                                    @foreach ($errors->get('foto_toko.*') as $err)
                                                        <span class="text-danger">@php print_r($err[0]) @endphp</span>
                                                    @endforeach
                                                </div>
                                            @endif

                                            <div class="fileadd"></div>
                                        </div>

                                        <div class="card-footer">
                                            <button class="btn btn-primary" style="float: center">Simpan</button>
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
                @endforeach
            </div>
        </section>
    </div>

    {{-- Modal Update Logo --}}
    <div class="modal fade" id="editmodal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Logo Toko</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editform" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id_penjual" id="id_penjual">
                    <div class="modal-body">
                        <div class="mb-3 row">
                            <label for="logo_toko" class="col-sm-2 col-form-label">Logo Toko</label>
                            <div class="col-sm-10">
                                <input type="file" id="logo_toko" class="form-control" name="logo_toko">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">
                            <span class="spinner-border spinner-border-sm spinner" role="status" aria-hidden="true"></span>
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.spinner').hide();

            $('[data-toggle="tooltip"]').tooltip();

            //-------------------------------------

            //show modal update form 
            $('#edit').click(function(e) {
                e.preventDefault();
                $.ajax({
                    data: {
                        'id_penjual': $(this).data('id'),
                        '_token': "{{ csrf_token() }}"
                    },
                    type: 'POST',
                    url: "{{ url('sellers/setting/logotoko') }}",
                    success: function(data) {
                        $('#id_penjual').val(data[0].id_penjual);
                        // $('#logo_toko').val(data[0].logo_toko);

                        $('#editmodal').modal('show');
                    },
                    error: function(err) {
                        alert(err);
                        console.log(err);
                    }
                });
            });


            //----------------------------------------
            // edit form
            $('#editform').submit(function(e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ url('sellers/setting/logotokoedit') }}",
                    type: "POST",
                    data: new FormData(this),
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $('.spinner').show();
                    },
                    complete: function() {
                        $('.spinner').hide();
                    },
                    success: function(data) {
                        swal(data.pesan)
                            .then((result) => {
                                location.reload();
                            });
                    },
                    error: function(err) {
                        alert(err);
                    }
                })
            });


            //foto
            $('.addfile').click(function() {
                var html = '';
                html += '<div class="mb-2 row control-group" id="removefile">';
                html += '<label for="foto_toko" class="col-sm-2 col-form-label"></label>';
                html += '<div class="col-sm-12 input-group">';
                html +=
                    '<input type="file" name="foto_toko[]" accept=".png,.jpg" class="form-control filefoto" required>';
                html += '<div class="input-group-prepend">';
                html +=
                    '<button class="btn btn-danger deletefile" type="button"><i class="fas fa-times"></i> Remove</button>';
                html += '</div></div></div>';

                $('.fileadd').append(html);
            });

            $("body").on("click", ".deletefile", function() {
                $(this).closest('#removefile').remove();
            });
        });
    </script>
@endsection
