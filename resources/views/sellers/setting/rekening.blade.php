@extends('sellers/master-sellers')
@section('content')
<div class="content-wrapper">
    <br>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3>Rekening Bank</h3>
                    <p class="text-muted">
                        Berikut Adalah Informasi Rekening Bank Anda
                    </p>
                </div>
                <div class="card-body">
                    <form action="{{url('sellers/setting/rekening/update')}}" method="post">
                        @csrf
                        @foreach ($toko as $t)
                            <div class="mb-3">
                                <label>Nama Bank</label>
                                <select name="nama_bank" required class="form-control">
                                    <option value="" selected>- PILIH NAMA BANK -</option>
                                    @foreach($bank as $b)
                                        @if($b->nama_bank == $t->nama_bank)
                                            <option selected value="{{$b->nama_bank}}">- {{$b->nama_bank}} -</option>
                                        @else
                                            <option value="{{$b->nama_bank}}">- {{$b->nama_bank}} -</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Atas Nama</label>
                                <input type="text" class="form-control bg-white" name="atas_nama_bank" required value="{{$t->atas_nama_bank}}">
                            </div>
                            <div class="mb-3">
                                <label>No Rekening</label>
                                <input type="number" class="form-control bg-white" name="no_rekening" required value="{{$t->no_rekening}}">
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        @endforeach
                    </form>
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