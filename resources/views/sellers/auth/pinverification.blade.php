@extends('sellers/master-sellers')
@section('content')
<div class="content-wrapper">
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Verifikasi Pin Penjual</h5>
                </div>
                <form action="{{url($route)}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <input type="password" name="pin" class="form-control" required placeholder="XXXXXX">
                        @if(isset($error))
                            <div class="text-muted text-red">
                                {{$error}}
                            </div>
                        @endif
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
