@extends('sellers/master-sellers')
@section('content')
<div class="content-wrapper">
    <br>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3>Alamat Toko</h3>
                    <p class="text-muted">
                        Berikut Adalah Detail Alamat Toko Anda
                    </p>
                </div>
                <div class="card-body">
                    @foreach($toko as $t)
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label>Lokasi Pasar</label>
                                <input type="text" class="form-control bg-white" readonly value="{{$t->nama_pasar}}">
                                <small class="form-text text-muted">
                                    Jika Anda ingin mengganti lokasi pasar, silahkan menghubungi customers service Blanjaloka
                                </small>
                            </div>
                            <div class="mb-3">
                                <label>Provinsi</label>
                                @foreach($provinsi as $id => $name)
                                    @if($t->provinsi == $id)
                                        <input type="text" class="form-control bg-white" readonly value="{{$name}}">
                                    @endif
                                @endforeach
                            </div>
                            <div class="mb-3">
                                <label>Kabupaten</label>
                                @foreach($kabupaten as $id => $name)
                                    @if($t->kabupaten == $id)
                                        <input type="text" class="form-control bg-white" readonly value="{{$name}}">
                                    @endif
                                @endforeach
                            </div>
                            <div class="mb-3">
                                <label>Kecamatan</label>
                                @foreach($kecamatan as $id => $name)
                                    @if($t->kecamatan == $id)
                                        <input type="text" class="form-control bg-white" readonly value="{{$name}}">
                                    @endif
                                @endforeach
                            </div>
                        </div>

                        <div class="col-sm-8 pl-4">
                            <form action="{{url('sellers/setting/alamat/update')}}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label>Alamat Lengkap Toko</label>
                                    <textarea name="alamat_toko" class="form-control" placeholder="Anda Bisa Isikan Dengan Detail Alamat Toko Anda" id="" cols="30" rows="6" required>{{$t->alamat_toko}}</textarea>
                                </div>

                                <div>
                                    <label>Embbed Maps Lokasi Toko</label>
                                    <textarea name="embbed_maps_toko" class="form-control" id="" cols="30" rows="6" required>{{$t->embbed_maps_toko}}</textarea>
                                    <small><a target="__BLANK" href="https://google-map-generator.com/">Info Lebih lanjut mengenai Embedded maps</a></small> 
                                </div>

                                <div class="mb-3">
                                    @if($t->embbed_maps_toko != null)
                                        <br>
                                        <iframe src="{{$t->embbed_maps_toko}}" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                                    @endif
                                </div>
                                <br>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">
                                        Simpan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</div>
@if ($status = Session::get('success'))
<script>swal("{{$status}}")</script>
@endif
<br>
@endsection