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
              <li class="breadcrumb-item"><a href="{{route('index')}}">Beranda</a></li>
              <li class="breadcrumb-item"><a href="{{route('app.jadwal_vaksin')}}">Jadwal Vaksinasi</a></li>
              <li class="breadcrumb-item active" aria-current="page">Detail Vaksinasi</li>
            </ol>
          </nav>
          <h4 class="mg-b-0 tx-montserrat tx-medium text-truncate">
            Detail Vaksinasi
          </h4>
        </div>
        <div class="d-lg-none mg-t-10">
        </div>
        <div>
          <a href="vaksinasi.html"  class="btn btn-white tx-montserrat tx-semibold"><i data-feather="arrow-left" class="wd-10 mg-r-5"></i> Kembali</a>
        </div>
      </div>

      <div class="row row-xs">
        <div class="col-sm-12 col-lg-12 mg-b-10">
          <div class="card">
            <div class="card-header">
              <div class="row row-xs">
                <div class="col-10 col-sm-10 col-lg-10 d-flex align-items-center">
                  <div class="d-flex align-items-center">
                    <div>
                      <h5 class="tx-medium tx-montserrat mg-b-0">{{\Carbon\Carbon::parse($data['jadwal']->tgl_pelaksanaan)->translatedFormat('d F Y')}}</h5>
                      <p class="mg-b-5">{{\Carbon\Carbon::parse($data['jadwal']->jam_pelaksanaan_mulai)->format('H:i')}} - {{\Carbon\Carbon::parse($data['jadwal']->jam_pelaksanaan_akhir)->format('H:i')}}</p>
                      <span class="tx-13"><span class="tx-info"><i class="far fa-play-circle mg-r-5"></i>Pendaftaran dibuka</span></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body card-list">
              <p class="tx-medium tx-15">Tentang Vaksinasi Ini</p>
              <div class="card-list-text">
                <span class="tx-10 tx-spacing-1 tx-color-03 tx-uppercase tx-semibold">Vaksinator</span>
                <p class="mg-b-0">{{$data['jadwal']->vaksinator}}</p>
              </div>
              <div class="card-list-text">
                <span class="tx-10 tx-spacing-1 tx-color-03 tx-uppercase tx-semibold">Jenis Vaksin</span>
                <p class="mg-b-0">{{$data['jadwal']->jenis_vaksin}}</p>
              </div>
              <div class="card-list-text">
                <span class="tx-10 tx-spacing-1 tx-color-03 tx-uppercase tx-semibold">Pendaftaran</span>
                <p class="mg-b-0">{{\Carbon\Carbon::parse($data['jadwal']->tgl_pendaftaran_mulai)->translatedFormat('d F Y')}} - {{\Carbon\Carbon::parse($data['jadwal']->tgl_pendaftaran_akhir)->translatedFormat('d F Y')}}</p>
              </div>
              <hr class="mg-t-20 mg-b-20">
              <p class="tx-medium tx-15">Pelaksanaan</p>
              <div class="card-list-text">
                <span class="tx-10 tx-spacing-1 tx-color-03 tx-uppercase tx-semibold">Tanggal Vaksinasi</span>
                <p class="mg-b-0">{{\Carbon\Carbon::parse($data['jadwal']->tgl_pelaksanaan)->translatedFormat('d F Y')}}</p>
              </div>
              <div class="card-list-text">
                <span class="tx-10 tx-spacing-1 tx-color-03 tx-uppercase tx-semibold">Sesi Vaksinasi</span>
                <p class="mg-b-0">{{\Carbon\Carbon::parse($data['jadwal']->jam_pelaksanaan_mulai)->format('H:i')}} - {{\Carbon\Carbon::parse($data['jadwal']->jam_pelaksanaan_akhir)->format('H:i')}}</p>
              </div>
              <div class="card-list-text">
                <span class="tx-10 tx-spacing-1 tx-color-03 tx-uppercase tx-semibold">Lokasi</span>
                <p class="mg-b-0">{{$data['jadwal']->lokasi}}</p>
              </div>
              <div class="card-list-text">
                <span class="tx-10 tx-spacing-1 tx-color-03 tx-uppercase tx-semibold">Kuota</span>
                <p class="mg-b-0">{{$data['jadwal']->kuota}} orang</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-12 col-lg-12 mg-b-10 pd-l-5 pd-r-5 ht-70 ht-md-70 ht-lg-70">
        </div>
        <div class="col-sm-12 col-lg-12 mg-b-10 d-flex justify-content-center">
            <div class="card pos-fixed z-index-10 b-40 shadow wd-90p wd-md-80p wd-lg-70p animated slideInUp">
                <div class="card-body card-alert-success d-flex justify-content-between align-items-center">
                    <span class="tx-montserrat tx-medium d-flex align-items-center"><i class="fa-lg fas fa-check-circle mg-l-10 mg-r-15 tx-success"></i>Kuota tersedia.</span>
                    <form class="z-index-10">
                      <button type="button" onclick="daftarVaksinasi('{{$data['jadwal']->id}}')" class="btn btn-its tx-montserrat tx-semibold">Daftar Vaksinasi</button>
                    </form>
                </div>
            </div>
        </div>

      </div><!-- row -->
    </div><!-- container -->
  </div>

  <div class="modal fade" id="modal_form_daftar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_form_daftar_title">Formulir Pendaftaran Vaksinasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                      <label for="exampleFormControlInput1">Nama</label>
                      <input type="text" class="form-control" id="f_id" name="f_id">
                      <input type="text" class="form-control" id="f_nama" name="f_nama" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlInput1">Nik</label>
                      <input type="text" class="form-control" id="f_nik" name="f_nik" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Usia</label>
                        <input type="text" class="form-control" id="f_usia" name="f_usia" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlSelect1">Jenis Kelamin</label>
                      <select class="form-control" id="f_jk" name="f_jk" required>
                        <option value="">-- pilih salah satu --</option>
                        <option value="Laki-Laki">Laki-Laki</option>
                        <option value="Perempuan">Perempuan</option>
                      </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Pekerjaan</label>
                        <input type="text" class="form-control" id="f_pekerjaan" name="f_pekerjaan" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlTextarea1">Alamat Domisili</label>
                      <textarea class="form-control" id="f_alamat_domisili" name="f_alamat_domisili" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Alamat KTP</label>
                        <textarea class="form-control" id="f_alamat_ktp" name="f_alamat_ktp" rows="3"></textarea>
                      </div>
                  </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="simpanVaksinasi()">Daftar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
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

const daftarVaksinasi = (id) => {
    $('#modal_form_daftar').modal('show');
}

const simpanVaksinasi = () => {
   Swal.fire({
        title: 'Yakin Mendaftar Vaksinasi ?',
        text: "Peringatan, dilarang memanipulasi data diri anda.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Daftar Sekarang !'
    }).then((result) => {
        if (result.isConfirmed) {

        }
    })

}

</script>
@endsection
