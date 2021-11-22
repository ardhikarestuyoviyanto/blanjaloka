@extends('sellers/master-sellers')
@section('content')
<div class="content-wrapper">
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Buat Pin Penjual</h5>
                </div>
                <form action="{{url('sellers/setting/createpin')}}" method="post">
                    @csrf
                    <input type="hidden" name="route" value="{{$route}}">
                    <div class="modal-body">
                        <input type="password" name="pin" class="form-control" required placeholder="Masukkan 6 Digit PIN Anda">
                        @if ($errors->has('pin'))
                            <div class="text-danger text-small text-sm">
                                @foreach ($errors->get('pin') as $err)
                                    {{ $err }}
                                @endforeach
                            </div>
                        @endif
                        <input type="password" name="pin_confirmation" class="form-control mt-3" required placeholder="Konfirmasi PIN">
                        <small class="text-muted">Ketika anda ingin mengakses menu - menu sensitif anda harus memasukkan PIN penjual, PIN penjual ini sangat berguna untuk mengamankan akun anda.</small>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $('#exampleModal').modal('show');
</script>
@endsection
