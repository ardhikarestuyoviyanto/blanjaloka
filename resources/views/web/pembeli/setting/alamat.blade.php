{{-- semua view yang dibuat didalam folder web harus di extend kan dengan file master --}}
@extends('web/master')
@section('content')

<!-- breadcrumb -->
<section class="pt-xl-5 pt-4">
    <div class="container">
        <nav id="breadcrumb" style="--bs-breadcrumb-divider: '&rarr;'" aria-label="breadcrumb">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-decoration-none cai-color-text" href="{{url('index')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Pengaturan</li>
            </ol>
        </nav>
    </div>
</section>
<!-- END OF BREADCRUMB -->

<section class="mt-3">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <div class="list-group mb-3">
                    <a href="{{url('setting/profil')}}" class="list-group-item list-group-item-action" aria-current="true">Profil Saya</a>
                    <a href="{{url('setting/alamat')}}" class="list-group-item list-group-item-action active">Alamat Pengiriman</a>
                    <a href="{{url('setting/ubahpassword')}}" class="list-group-item list-group-item-action">Ubah Password</a>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header bg-light">
                        <b>Alamat Saya</b> <br>
                        <small>Alamat Pengiriman Paket Saya</small>
                    </div>
                    @foreach($customers as $c)
                    <form action="{{url('setting/alamat/update')}}" method="post">
                        @csrf
                        <div class="card-body">

                            <div class="form-floating mb-3">
                                <select class="form-select" aria-label="Provinsi" id="provinsi" name="provinsi" required>
                                    <option value=""> - PILIH PROVINSI - </option>
                                    @foreach ($provinsi as $id => $name)
                                        @if($id == $c->provinsi)
                                            <option selected value="{{ $id }}">{{ $name }}</option>
                                        @else
                                            <option value="{{ $id }}">{{ $name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <label for="Provinsi">Provinsi</label>
                            </div>

                            <div class="form-floating mb-3">
                                <select class="form-select" aria-label="Kabupaten" id="kabupaten" name="kabupaten" required>
                                    <option value=""> - PILIH KABUPATEN - </option>
                                    @foreach ($kabupaten as $id => $name)
                                        @if($id == $c->kabupaten)
                                            <option selected value="{{ $id }}">{{ $name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <label for="kabupaten">Kabupaten</label>
                            </div>

                            <div class="form-floating mb-3">
                                <select class="form-select" aria-label="Kecamatan" id="kecamatan" name="kecamatan" required>
                                    <option value=""> - PILIH KECAMATAN - </option>
                                    @foreach ($kecamatan as $id => $name)
                                        @if($id == $c->kecamatan)
                                            <option selected value="{{ $id }}">{{ $name }}</option>
                                        @endif                                 
                                    @endforeach
                                </select>
                                <label for="kecamatan">Kecamatan</label>   
                            </div>

                            <div class="form-floating">
                                <textarea required class="form-control" placeholder="Tuliskan Alamat Selengkap Lengkapnya" id="alamat" name="alamat" style="height: 200px">{{$c->alamat}}</textarea>
                                <label for="alamat">Alamat Lengkap</label>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>


</section>

{{-- Notif Jika Alamat Diiupdate --}}
@if ($status = Session::get('success'))
<script>
    swal("{{$status}}")
</script>
@endif

<script>
    $('#provinsi').on('change', function(){
        $.ajax({
            url : "{{url('location/getkabupaten')}}",
            method : 'POST',
            data : {'id':$(this).val(), '_token': "{{csrf_token()}}"},
            success: function(res){
                $('#kabupaten').empty();
                $('#kecamatan').empty();
                $.each(res, function(id, name){
                    $('#kabupaten').append(new Option(name, id));
                });
            }   
        });
    });

    $('#kabupaten').on('change', function(){
        $.ajax({
            url : "{{url('location/getkecamatan')}}",
            method : 'POST',
            data : {'id':$(this).val(), '_token': "{{csrf_token()}}"},
            success: function(res){
                $('#kecamatan').empty();
                $.each(res, function(id, name){
                    $('#kecamatan').append(new Option(name, id));
                });
            }   
        });
    });


</script>
  
@endsection 