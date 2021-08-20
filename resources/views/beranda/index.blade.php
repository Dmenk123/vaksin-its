@extends('layout.index')

@section('content')

@include('layout.navbar')

<div class="content-body ht-100p pd-t-80">
    <div class="container pd-x-0" id="content">

      <div class="row row-xs">

        <div class="col-sm-12 col-lg-12 mg-b-30">
          <div class="row row-xs">
            <div class="col-sm-12 col-lg-12 mg-b-20 d-flex justify-content-center">
              <a href="#photoprofil" data-toggle="modal" data-animation="effect-scale" class="animated slideInUp">
                <div class="avatar avatar-xxl">
                  <img src="{{asset('assets/images/pasfoto.jpg')}}" class="rounded-circle shadow" alt="" data-toggle="tooltip" data-placement="bottom" title="Foto profil">
                </div>
              </a>
            </div>
            <div class="col-sm-12 col-lg-12 mg-b-10 text-center">
                <h3 class="mg-b-4 tx-montserrat tx-medium animated slideInUp">{{\Session::get('logged_in')['nama']}}</h3>
                <p class="mg-b-4 tx-color-03 tx-15 tx-medium animated slideInUp">{{\Session::get('logged_in')['nip']}}</p>
            </div>
          </div>
        </div>

      </div><!-- row -->
    </div><!-- container -->
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
