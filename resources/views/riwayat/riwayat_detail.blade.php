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
          <a href="{{route('app.riwayat')}}"  class="btn btn-white tx-montserrat tx-semibold"><i data-feather="arrow-left" class="wd-10 mg-r-5"></i> Kembali</a>
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
                      <span class="tx-13"><span class="tx-success"><i class="far fa-check-circle mg-r-5"></i>Selesai</span></span>
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
              <div class="card-list-text">
                <span class="tx-10 tx-spacing-1 tx-color-03 tx-uppercase tx-semibold">Vaksinasi Ke</span>
                <p class="mg-b-0">{{$data['jadwal']->vaksinasi_ke}}</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-12 col-lg-12 mg-b-10">
          <div class="card">
            <div class="card-header">
              <div class="row row-xs">
                <div class="col-10 col-sm-10 col-lg-10 d-flex align-items-center">
                  <div class="d-flex align-items-center">
                    <div>
                      <h5 class="tx-medium tx-montserrat mg-b-0">KIPI</h5>
                    </div>
                  </div>
                </div>
                <div class="col-2 col-sm-2 col-lg-2 d-flex align-items-center justify-content-end">
                  <button type="button" data-animation="effect-scale" class="btn btn-white tx-montserrat tx-semibold float-right d-none d-lg-block" onclick="tambahKipi('{{$data['jadwal']->id}}')"><i data-feather="plus" class="wd-10 mg-r-5"></i> Tambah</button>
                  {{-- <a href="#tambahkipi" data-toggle="modal" data-animation="effect-scale" class="btn btn-white btn-icon tx-montserrat tx-medium float-right d-lg-none"><i data-feather="plus"></i></a> --}}
                </div>
              </div>
            </div>
            <div class="card-body pd-0">
              <div class="table-responsive">
                <table class="table table-borderless table-hover">
                  <thead>
                    <tr class="tx-10 tx-spacing-1 tx-color-03 tx-uppercase">
                      <th class="wd-15p th-its">Tanggal Kejadian</th>
                      <th class="wd-40p th-its">Gejala</th>
                      <th class="wd-25p th-its">Tindakan</th>
                      <th class="wd-15p th-its">Hubungi Dokter</th>
                      <th class="wd-5p th-its tx-color-03"></th>
                    </tr>
                  </thead>
                  <tbody>
                    @if ($data['kipi']->isNotEmpty())
                        @foreach ($data['kipi'] as $valuenya)
                        <tr>
                            <td class="td-its tx-medium align-middle border-bottom">{{Carbon\Carbon::parse($valuenya->tanggal)->translatedFormat('d F Y')}}</td>
                            <td class="td-its align-middle border-bottom">{{$valuenya->gejala}}</td>
                            <td class="td-its align-middle border-bottom">{{$valuenya->tindakan}}</td>
                            <td class="td-its align-middle border-bottom">{{($valuenya->is_hub_dokter == '1') ? 'Sudah' : 'Belum'}}</td>
                            <td class="td-its align-middle border-bottom tx-color-03">
                              <button type="button" onclick="haspusKipi('{{$valuenya->id}}')" data-animation="effect-scale"  class="btn btn-white btn-icon" role="button" data-toggle="modal" data-target="#hapuskipi" data-animation="effect-scale"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash wd-10"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></button>
                            </td>
                          </tr>
                        @endforeach
                    @else
                    <tr>
                        <td class="td-its tx-medium align-middle border-bottom" colspan="5" align="center">Belum Ada Data...</td>
                    </tr>
                    @endif
                  </tbody>
                </table>
              </div>
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
                <h5 class="modal-title" id="modal_form_daftar_title">Formulir Tambah KIPI</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formDaftar">
                    @csrf
                    <div class="form-group">
                      <label for="exampleFormControlInput1">Tanggal</label>
                      <input type="hidden" class="form-control" id="f_id" name="f_id">
                      <input type="text" class="form-control datepickerNow" name="f_tanggal" id="f_tanggal" autocomplete="off" placeholder="- Pilih Tanggal -" style="cursor: pointer;" value="{{\Carbon\Carbon::now()->format('d-m-Y')}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Peserta</label>
                        <select class="form-control" id="f_id_pendaftaran" name="f_id_pendaftaran" required>
                            <option value="">-- pilih salah satu --</option>
                            @foreach (\App\Models\T_pendaftaran::get() as $k => $v)
                            <option value="{{$v->id}}">NIK : {{$v->nik}} - Nama : {{$v->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Gejala</label>
                        <input type="text" class="form-control" id="f_gejala" name="f_gejala" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlSelect1">Sudah dihubungi Dokter</label>
                      <select class="form-control" id="f_is_hub_dokter" name="f_is_hub_dokter" required>
                        <option value="1">Ya</option>
                        <option value="0">Tidak</option>
                      </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Tindakan</label>
                        <input type="text" class="form-control" id="f_tindakan" name="f_tindakan" required>
                    </div>
                  </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="simpanKipi()">Daftar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script>

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

const tambahKipi = (id) => {
    $('#f_id').val(id);
    $('#modal_form_daftar').modal('show');
}

const simpanKipi = () => {
   Swal.fire({
        title: 'Perhatian',
        text: "Simpan Data KIPI",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Simpan Sekarang !'
    }).then((result) => {
        if (result.isConfirmed) {
            let form= $("#formDaftar");
            $.ajax({
                type: "POST",
                url: "{{ route('app.kipi_simpan')}}",
                dataType: "json",
                data: form.serialize(),
                success: function (response) {
                    if(response.status == 'success') {
                        Swal.fire(
                            'Sukses!',
                            'Data KIPI berhasil Disimpan.',
                            'success'
                        )
                        location.reload();
                    }else{
                        Swal.fire(
                            'Gagal!',
                            'Data KIPI Gagal Disimpan.',
                            'error'
                        )
                    }
                }
            });
        }
    })

}

const haspusKipi = (id) => {
    Swal.fire({
        title: 'Perhatian',
        text: "Hapus Data KIPI",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus Data !'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: "{{ route('app.kipi_hapus')}}",
                dataType: "json",
                data: {id:id},
                success: function (response) {
                    if(response.status == 'success') {
                        Swal.fire(
                            'Sukses!',
                            'Data KIPI berhasil Dihapus.',
                            'success'
                        )
                        location.reload();
                    }else{
                        Swal.fire(
                            'Gagal!',
                            'Data KIPI Gagal Dihapus.',
                            'error'
                        )
                    }
                }
            });
        }
    })
}

</script>
@endsection
