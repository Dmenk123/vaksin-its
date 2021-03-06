@extends('layout.index')

@section('content')

    <div class="content ht-100v pd-0" style="position: relative">
        @include('layout.navbar')

        <div class="content-body ht-100p pd-t-80">
            <div class="container pd-x-0" id="content">

              <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
                <div>
                  <nav aria-label="breadcrumb" class="d-none d-lg-block">
                    <ol class="breadcrumb breadcrumb-style2 mg-b-10">
                      <li class="breadcrumb-item"><a href="../dashboard">Beranda</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Riwayat</li>
                    </ol>
                  </nav>
                  <h4 class="mg-b-0 tx-montserrat tx-medium text-truncate">
                    Riwayat
                  </h4>
                </div>
                <div class="d-lg-none mg-t-10">
                </div>
                <div>
                </div>
              </div>

              <div class="row row-xs">
                <div class="col-sm-12 col-lg-12">
                  <div class="card">
                    <div class="card-body card-list">
                        @foreach ($data['jadwal'] as $key => $item)
                            @php
                                $tgl_mulai = \Carbon\Carbon::parse($item->tgl_pendaftaran_mulai)->format('Y-m-d');
                                $datetime_mulai = Carbon\Carbon::parse($tgl_mulai.' 00:00:00')->format('Y-m-d H:i:s');

                                $tgl_akhir = \Carbon\Carbon::parse($item->tgl_pendaftaran_akhir)->addDay()->format('Y-m-d');
                                $datetime_akhir = Carbon\Carbon::parse($tgl_akhir.' 23:23:59')->format('Y-m-d H:i:s');
                                // false jika sudah tidak berada di range tgl diatas
                                $cek_tgl = \Carbon\Carbon::now()->between($tgl_mulai, $tgl_akhir);
                            @endphp
                            <div class="card-list-item">
                                <a href="
                                    @if ($cek_tgl == false)
                                        @if (\Carbon\Carbon::now()->greaterThan($datetime_mulai))
                                            {{route('app.riwayat_detail',['id' => $item->id])}}
                                        @else
                                            {{ url('#') }}
                                        @endif
                                    @else
                                        @if (\App\Models\T_pendaftaran::CounterPendaftar($item->id_vaksinasi) >= (int)$item->kuota)
                                            {{route('app.riwayat_detail',['id' => $item->id])}}
                                        @else
                                            {{ url('#') }}
                                        @endif
                                    @endif">
                                <div class="d-flex justify-content-between align-items-center sc-link">
                                    <div class="media">
                                        <div class="wd-40 ht-40 bg-its-icon tx-color-its mg-r-15 mg-md-r-15 d-flex align-items-center justify-content-center rounded-its"><span class="tx-medium tx-color-its tx-24">{{$key+1}}</span></div>
                                        <div class="media-body align-self-center">
                                            <p class="tx-montserrat tx-semibold mg-b-0 tx-color-02">{{Carbon\Carbon::parse($item->tgl_pelaksanaan)->translatedFormat('d F Y')}}</p>
                                            <p class="tx-color-03 tx-13">{{\Carbon\Carbon::parse($item->jam_pelaksanaan_mulai)->format('H:i')}} - {{\Carbon\Carbon::parse($item->jam_pelaksanaan_akhir)->format('H:i')}}</p>
                                            @if ($cek_tgl == false)
                                                {{-- cek akan atau sudah ditutup --}}
                                                @if (\Carbon\Carbon::now()->lessThanOrEqualTo($datetime_mulai))
                                                    <span class="tx-13"><span class="tx-info"><i class="far fa-arrow-alt-circle-right mg-r-5"></i>Menunggu vaksinasi</span></span>
                                                @else
                                                    <span class="tx-13"><span class="tx-success"><i class="far fa-check-circle mg-r-5"></i>Selesai</span></span>
                                                @endif
                                            @else
                                                @if (\App\Models\T_pendaftaran::CounterPendaftar($item->id_vaksinasi) >= (int)$item->kuota)
                                                    <span class="tx-13"><span class="tx-success"><i class="far fa-check-circle mg-r-5"></i>Selesai</span></span>
                                                @else
                                                <span class="tx-13"><span class="tx-info"><i class="far fa-arrow-alt-circle-right mg-r-5"></i>Menunggu vaksinasi</span></span>
                                                @endif
                                            @endif

                                        </div>
                                    </div>
                                    <div class="btn btn-icon btn-its-icon btn-hover">
                                    <i data-feather="chevron-right"></i>
                                    </div>
                                </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                  </div>
                </div>

              </div><!-- row -->
            </div><!-- container -->
          </div>
    </div>
@endsection

@section('js')
<script>

    let tanggal = "{{(\Request::get('tgl')) ? \Carbon\Carbon::parse(\Request::get('tgl'))->format('Y-m-d') : \Carbon\Carbon::now()->format('Y-m-d')}}";

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


$(document).ready( function () {


    $('.datepickerNow').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true
    });

    //modal overlay
    $(document).on('show.bs.modal', '.modal', function () {
        var zIndex = 1040 + (10 * $('.modal:visible').length);
        $(this).css('z-index', zIndex);
        setTimeout(function() {
            $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
        }, 0);
    });

});

const gantiTanggal = (tgl) => {
    location.href = "{{route('index')}}?tgl="+tgl;
}

</script>
@endsection
