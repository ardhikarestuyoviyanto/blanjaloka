<!-- Pilih Lokasi Pasar dan Banner add Kecil -->
<section class="mt-4 mt-xl-5">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 mb-3">
                <h5 class="fw-bold fs-6">Pilih Lokasi Pasar</h5>
                <div class="d-flex align-items-center justify-content-between shadow border-r-sip p-3 border">
                    <div class="container-location d-flex">
                        <i class="bi bi-geo-alt-fill"></i>
                        <div class="market-name ms-2">
                            <p class="fw-bold mb-0">
                                @if(empty(session()->get('nama_pasar')))
                                    Pilih Lokasi Pasar Terdekat
                                @else
                                    {{session()->get('nama_pasar')}}
                                @endif
                            </p>
                            <small>Klik Untuk Mengubah Lokasi Pasar</small>
                        </div>
                    </div>
                    <div class="select-map">
                        <a href="javascript:void(0)" data-bs-target="#pasarModal" data-bs-toggle="modal" class="btn btn-cai px-4 py-1 bg-master">Pilih</a>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="pasarModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-xl">
                        <div class="modal-content border-r-sip">
                            <div class="modal-body p-4">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <div class="shadow">
                                            <div class="search-box">
                                                <div class="d-flex shadow border-r-sip px-3 border align-items-center">
                                                    <span><i class="bi bi-geo-alt-fill text-secondary"></i>  Pilih Lokasi Pasar</span>
                                                    <i class="bi bi-chevron-down d-inline ms-auto fs-3 text-secondary"></i>
                                                </div>
                                            </div>
                                            <div class="p-5">
                                                @foreach($data['pasar'] as $p)
                                                    @php
                                                        $foto = explode(',', $p->foto_pasar);
                                                    @endphp

                                                    <div class="item-pasar border-bottom py-3">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <img src="{{asset('assets/admin/foto_pasar/'.$foto[0])}}" alt="pasar" class="rounded w-100"/>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <div class="d-flex align-items-center justify-content-between">
                                                                    <a href="#" style="text-decoration: none; color:black;" onMouseOver="this.style.color='#03adfc'"
                                                                    onMouseOut="this.style.color='black'" class="pasar" data-id_pasar="{{$p->id_pasar}}" data-nama_pasar="{{$p->nama_pasar}}"><p class="fw-bold mb-0">{{$p->nama_pasar}}</p></a>
                                                                    <span class="badge badge-cai-success">
                                                                       <a href="#" class="terapkanpasar" data-id_pasar="{{$p->id_pasar}}" data-nama_pasar="{{$p->nama_pasar}}" style="color: green; text-decoration:none;">Terapkan</a>
                                                                    </span>
                                                                </div>
                                                                <div class="keterangan-pasar py-1">
                                                                    <p class="mb-0 text-secondary">
                                                                        <i class="bi bi-geo-alt-fill me-1"></i> 
                                                                        @foreach($data['provinsi'] as $id=>$name)
                                                                            @if($id == $p->provinsi)
                                                                                {{ucfirst(strtolower($name))}}
                                                                            @endif
                                                                        @endforeach
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h4 class="namapasar"></h4>
                                        <br>
                                        <iframe class="lokasipasar" style="border:0;" allowfullscreen="" loading="lazy" width="500px" height="300px"></iframe>
                                        <br><br>
                                        <h4 class="jampasar">Jam Operasional Pasar</h4>
                                        <br>
                                        <table class="table jampasar" id="jampasar">
                                            <thead>
                                                <tr>
                                                  <th scope="col">Hari</th>
                                                  <th scope="col">Jam Buka</th>
                                                  <th scope="col">Jam Tutup</th>
                                                </tr>
                                              </thead>
                                            <tbody>
                                            </tbody>
                                          </table>
                                        <img src="https://demo.blanjaloka.id/img/map.png" alt="Map" id="mapgambar">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="offset-0 offset-xl-1 col-xl-5 col-12">
                <a href="#">
                    <div class="text-white position-relative text-center fw-bold">
                        <p class="position-absolute top-50 start-50 translate-middle fs-xl-2">Dapatkan Voucer gratis
                            ongkir hanya dengan login pada bulan AGUSTUS</p>
                        <img class="w-100" src="{{ asset('assets/blanjaloka/img/modern-market.png') }}" alt="">
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
<!-- End of Pilih Lokasi Pasar dan Banner add Kecil -->

<script>
$(document).ready(function(){
    $('.lokasipasar').hide();
    $('.jampasar').hide();
    $('.pasar').click(function(e){
        $.ajax({
            data: {'id_pasar':$(this).data('id_pasar'), '_token': "{{csrf_token()}}"},
            type: 'POST',
            url:"{{url('pasar/detail')}}",
            success : function(data){
                $('#mapgambar').hide();
                // pasar
                $('.lokasipasar').show();
                $('.namapasar').text(data.pasardetail[0].nama_pasar);
                $('.lokasipasar').attr('src', data.pasardetail[0].embbed_maps);

                //jam pasar
                $("#jampasar > tbody"). empty();
                $('.jampasar').show();
                for (let i=0; i<data.jampasar.length; i++){
                    $('#jampasar').append('<tr> <td>' + data.jampasar[i].hari + '</td>  <td>' + data.jampasar[i].buka + '</td> <td>' + data.jampasar[i].tutup + '</td></tr>');
                }

            },
            error : function(err){
                console.log(err);
            }
        });
    });

    $('.terapkanpasar').click(function(e){
        $.ajax({
            data: {'id_pasar':$(this).data('id_pasar'),'nama_pasar':$(this).data('nama_pasar') , '_token': "{{csrf_token()}}"},
            type: 'POST',
            url:"{{url('pasar/terapkan')}}",
            beforeSend: function() {
                $.LoadingOverlay("show");
            },
            complete: function() {
                $.LoadingOverlay("hide");
            },
            success : function(data){
                swal({
                    title: "Berhasil Berpindah Pasar",
                    text: data.pesan,
                    icon: "info",
                    buttons: {
                        defeat: "Oke",
                    },
                })
                .then((value) => {
                    location.reload();
                });
            },
            error : function(err){
                console.log(err);
            }
        });
    });

});
</script>