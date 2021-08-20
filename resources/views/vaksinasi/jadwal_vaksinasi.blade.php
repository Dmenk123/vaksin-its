@extends('layout.index')

@section('content')

<div class="content ht-100v pd-0" style="position: relative">

 @include('layout.navbar')
 @php
 dump($data['jadwal']);
@endphp
<div class="content-body ht-100p pd-t-80">
    <div class="container pd-x-0" id="content">

    <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
        <div>
        <nav aria-label="breadcrumb" class="d-none d-lg-block">
            <ol class="breadcrumb breadcrumb-style2 mg-b-10">
            <li class="breadcrumb-item"><a href="../dashboard">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Jadwal Vaksinasi</li>
            </ol>
        </nav>
        <h4 class="mg-b-0 tx-montserrat tx-medium text-truncate">
            Jadwal Vaksinasi
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
                        <a href="@if ($cek_tgl == false){{ url('#') }}@else @if (\App\Models\T_pendaftaran::CounterPendaftar($item->id_vaksinasi) >= (int)$item->kuota) {{ url('#') }} @else {{route('app.vaksinasi_detail',['id' => $item->id])}} @endif @endif">
                            <div class="d-flex justify-content-between align-items-center sc-link">
                                <div class="media">
                                <div class="wd-40 ht-40 bg-its-icon tx-color-its mg-r-15 mg-md-r-15 d-flex align-items-center justify-content-center rounded-its"><i data-feather="calendar"></i></div>
                                <div class="media-body align-self-center">
                                    <p class="tx-montserrat tx-semibold mg-b-0 tx-color-02">{{Carbon\Carbon::parse($item->tgl_pelaksanaan)->translatedFormat('d F Y')}}</p>
                                    <p class="tx-color-03 tx-13">{{\Carbon\Carbon::parse($item->jam_pelaksanaan_mulai)->format('H:i')}} - {{\Carbon\Carbon::parse($item->jam_pelaksanaan_akhir)->format('H:i')}}</p>
                                    @if ($cek_tgl == false)
                                        {{-- cek akan atau sudah ditutup --}}
                                        @if (\Carbon\Carbon::now()->lessThanOrEqualTo($datetime_mulai))
                                            <span class="tx-13"><span class="tx-gray-700"><i class="far fa-circle mg-r-5"></i>Pendaftaran belum dibuka</span></span>
                                        @else
                                            <span class="tx-13"><span class="tx-danger"><i class="far fa-times-circle mg-r-5"></i>Pendaftaran ditutup</span></span>
                                        @endif
                                    @else
                                        @if (\App\Models\T_pendaftaran::CounterPendaftar($item->id_vaksinasi) >= (int)$item->kuota)
                                            <span class="tx-13"><span class="tx-danger"><i class="far fa-times-circle mg-r-5"></i>Pendaftaran ditutup</span></span>
                                        @else
                                            <span class="tx-13"><span class="tx-info"><i class="far fa-play-circle mg-r-5"></i>Pendaftaran dibuka</span></span>
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
                {{-- <div class="card-list-item">
                    <a href="{{route('app.vaksinasi_detail')}}">
                        <div class="d-flex justify-content-between align-items-center sc-link">
                            <div class="media">
                            <div class="wd-40 ht-40 bg-its-icon tx-color-its mg-r-15 mg-md-r-15 d-flex align-items-center justify-content-center rounded-its"><i data-feather="calendar"></i></div>
                            <div class="media-body align-self-center">
                                <p class="tx-montserrat tx-semibold mg-b-0 tx-color-02">Sabtu, 03 Apr 2021</p>
                                <p class="tx-color-03 tx-13">07.00 - 12.00</p>
                                <span class="tx-13"><span class="tx-info"><i class="far fa-play-circle mg-r-5"></i>Pendaftaran dibuka</span></span>
                            </div>
                            </div>
                            <div class="btn btn-icon btn-its-icon btn-hover">
                            <i data-feather="chevron-right"></i>
                            </div>
                        </div>
                    </a>
                </div> --}}
                {{-- <div class="card-list-item">
                    <a href="#">
                    <div class="d-flex justify-content-between align-items-center sc-link">
                        <div class="media">
                        <div class="wd-40 ht-40 bg-its-icon tx-color-its mg-r-15 mg-md-r-15 d-flex align-items-center justify-content-center rounded-its"><i data-feather="calendar"></i></div>
                        <div class="media-body align-self-center">
                            <p class="tx-montserrat tx-semibold mg-b-0 tx-color-02">Sabtu, 24 Apr 2021</p>
                            <p class="tx-color-03 tx-13">08.00 - 15.00</p>
                            <span class="tx-13"><span class="tx-gray-700"><i class="far fa-circle mg-r-5"></i>Pendaftaran belum dibuka</span></span>
                        </div>
                        </div>
                        <div class="btn btn-icon btn-its-icon btn-hover">
                        <i data-feather="chevron-right"></i>
                        </div>
                    </div>
                    </a>
                </div> --}}
                {{-- <div class="card-list-item">
                    <a href="#">
                    <div class="d-flex justify-content-between align-items-center sc-link">
                        <div class="media">
                        <div class="wd-40 ht-40 bg-its-icon tx-color-its mg-r-15 mg-md-r-15 d-flex align-items-center justify-content-center rounded-its"><i data-feather="calendar"></i></div>
                        <div class="media-body align-self-center">
                            <p class="tx-montserrat tx-semibold mg-b-0 tx-color-02">Sabtu, 06 Mar 2021</p>
                            <p class="tx-color-03 tx-13">12.00 - 15.00</p>
                            <span class="tx-13"><span class="tx-danger"><i class="far fa-times-circle mg-r-5"></i>Pendaftaran ditutup</span></span>
                        </div>
                        </div>
                        <div class="btn btn-icon btn-its-icon btn-hover">
                        <i data-feather="chevron-right"></i>
                        </div>
                    </div>
                    </a>
                </div> --}}
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
