@extends('layout.index')

@section('content')


<section class="content-header">
      <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="shadow-sm p-3 mb-1 bg-white rounded tepi">
                    <div class="row mb-2">
                        <div class="col-sm-3 text-center">
                            <img src="assets/images/calendar.svg" alt="" height="50">
                        </div>
                        <div class="col-sm-9 box-judul row">
                            <input type="text" class="form-control datepickerNow" name="tgl_aktif" id="tgl_aktif" autocomplete="off" placeholder="- Pilih Tanggal -" style="cursor: pointer;" value="{{\Request::get('tgl') ?? \Carbon\Carbon::now()->format('d-m-Y')}}" onchange="gantiTanggal(this.value)">
                            <br>
                            <div class="col-8">
                                <p>
                                    <strong>Data Update terakhir :</strong>
                                    <br>
                                    {{$log_penarikan->metode}} : {{\Carbon\Carbon::parse($log_penarikan->created_at)->translatedFormat('d F Y H:i')}}
                                </p>
                            </div>
                            <div class="col-4">
                                <button type="button btn btn-sm" class="btn btn-info" onclick="tarikData()">Tarik Data</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <!-- I. APBD Pemkot Surabaya -->
                <div class="shadow-sm p-3 mb-1 bg-white rounded tepi">
                    <div class="row mb-2">
                        <div class="col-sm-3 text-center">
                            <img src="assets/images/bantuan1.svg" alt="" height="50">
                        </div>
                        <div class="col-sm-9  box-judul">

                            <label class="" style="font-weight: bold;"><span class="text-info">I. APBD Pemkot Surabaya</span></label>
                            <p>
                                Total Anggaran : Rp. {{number_format(array_sum([$kesehatan[0]->kuota, $vaksin[0]->kuota, $ekonomi[0]->kuota, $jps[0]->kuota]),2,',','.')}}
                                <br>
                                Total Realisasi : Rp. {{number_format(array_sum([$kesehatan[0]->real, $vaksin[0]->real, $ekonomi[0]->real, $jps[0]->real]),2,',','.')}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-3 col-6">
                <!-- II. Bantuan Pusat dan Propinsi -->
                <div class="shadow-sm p-3 mb-1 bg-white rounded tepi">
                    <div class="row mb-2">
                        <div class="col-sm-3 text-center">
                            <img src="assets/images/bantuan2.svg" alt="" height="50">
                        </div>
                        <div class="col-sm-9  box-judul">

                            <label class="" style="font-weight: bold;"><span class="text-info">II. Bantuan Pusat dan Propinsi</span></label>
                            <p>
                                Total Kuota : Rp. {{number_format(array_sum([$bst[0]->kuota, $pkh[0]->kuota, $sembako[0]->kuota]) + $santunan_covid[0]->kuota,2,',','.')}}
                                <br>
                                Total Realisasi : Rp. {{number_format(array_sum([$bst[0]->real, $pkh[0]->real, $sembako[0]->real, $beras[0]->real, $beras_ppkm[0]->real]) + $santunan_covid[0]->real,2,',','.')}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-3 col-6">
                <!-- III. Bantuan Masyarakat -->
                <div class="shadow-sm p-3 mb-1 bg-white rounded tepi">
                    <div class="row mb-2">
                        <div class="col-sm-3 text-center">
                            <img src="assets/images/bantuan3.svg" alt="" height="50">
                        </div>
                        <div class="col-sm-9  box-judul">
                            <label class="" style="font-weight: bold;"><span class="text-info">III. Bantuan Masyarakat</span></label>
                            <p>
                                Total Bantuan RSUD : Rp. {{number_format(array_sum([$total_bdh, $total_swd]),2,',','.')}}
                                <br>
                                Surabaya Peduli : Rp. {{number_format(array_sum([$total_bantuan_barang, $total_bantuan_uang]),2,',','.')}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="shadow-sm p-3 bg-white rounded tepi">
                        <div class="row">
                            <div class="col-sm-1 text-center">
                                <img src="assets/images/bantuan1.svg" alt="" height="50">
                            </div>
                            <div class="col-sm-11">
                                <strong>
                                    <span class="judul">
                                        I. APBD Pemkot Surabaya <br>
                                    </span>
                                </strong>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered no-footer table-hover" role="grid" id="tbl_apbd_pemkot">
                                <thead>
                                    <tr role="row" class="table-primary">
                                        <th width="10px;">No.</th>
                                        <th>Bidang</th>
                                        <th>Anggaran</th>
                                        <th>Realisasi</th>
                                        <th>Prosentase</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr data-jenis="kesehatan" data-judul="KESEHATAN">
                                        <td valign="top">1</td>
                                        <td valign="top">KESEHATAN</td>
                                        <td valign="top"><div style="float: left;">Rp. </div><div style="float: right;">{{number_format($kesehatan[0]->kuota,2,',','.')}}</div></td>
                                        <td valign="top"><div style="float: left;">Rp. </div><div style="float: right;">{{number_format($kesehatan[0]->real,2,',','.')}}</div></td>
                                        <td valign="top">{{round((float)$kesehatan[0]->real / (float)$kesehatan[0]->kuota  * 100,0,PHP_ROUND_HALF_UP)}} %</td>
                                    </tr>
                                    <tr data-jenis="vaksin" data-judul="PENDUKUNG VAKSINASI">
                                        <td valign="top">2</td>
                                        <td valign="top">PENDUKUNG VAKSINASI</td>
                                        <td valign="top"><div style="float: left;">Rp. </div><div style="float: right;">{{number_format($vaksin[0]->kuota,2,',','.')}}</div></td>
                                        <td valign="top"><div style="float: left;">Rp. </div><div style="float: right;">{{number_format($vaksin[0]->real,2,',','.')}}</div></td>
                                        <td valign="top">{{round((float)$vaksin[0]->real / (float)$vaksin[0]->kuota  * 100,0,PHP_ROUND_HALF_UP)}} %</td>
                                    </tr>
                                     <tr data-jenis="ekonomi" data-judul="EKONOMI">
                                        <td valign="top">3</td>
                                        <td valign="top">EKONOMI</td>
                                        <td valign="top"><div style="float: left;">Rp. </div><div style="float: right;">{{number_format($ekonomi[0]->kuota,2,',','.')}}</div></td>
                                        <td valign="top"><div style="float: left;">Rp. </div><div style="float: right;">{{number_format($ekonomi[0]->real,2,',','.')}}</div></td>
                                        <td valign="top">{{round((float)$ekonomi[0]->real / (float)$ekonomi[0]->kuota  * 100,0,PHP_ROUND_HALF_UP)}} %</td>
                                    </tr>
                                    <tr data-jenis="jps" data-judul="JARING PENGAMAN SOSIAL (JPS)">
                                        <td valign="top">4</td>
                                        <td valign="top">JARING PENGAMAN SOSIAL (JPS)</td>
                                        <td valign="top"><div style="float: left;">Rp. </div><div style="float: right;">{{number_format($jps[0]->kuota,2,',','.')}}</div></td>
                                        <td valign="top"><div style="float: left;">Rp. </div><div style="float: right;">{{number_format($jps[0]->real,2,',','.')}}</div></td>
                                        <td valign="top">{{round((float)$jps[0]->real / (float)$jps[0]->kuota  * 100,0,PHP_ROUND_HALF_UP)}} %</td>
                                    </tr>
                                    <tr>
                                        <td valign="top"></td>
                                        <td valign="top">TOTAL</td>
                                        <td valign="top"><div style="float: left;">Rp. </div><div style="float: right;">{{number_format(array_sum([$kesehatan[0]->kuota, $vaksin[0]->kuota, $ekonomi[0]->kuota, $jps[0]->kuota]),2,',','.')}}</div></td>
                                        <td valign="top"><div style="float: left;">Rp. </div><div style="float: right;">{{number_format(array_sum([$kesehatan[0]->real, $vaksin[0]->real, $ekonomi[0]->real, $jps[0]->real]),2,',','.')}}</div></td>
                                        <td valign="top">{{round((float)array_sum([$kesehatan[0]->real, $vaksin[0]->real, $ekonomi[0]->real, $jps[0]->real]) / (float)array_sum([$kesehatan[0]->kuota, $vaksin[0]->kuota, $ekonomi[0]->kuota, $jps[0]->kuota])  * 100,0,PHP_ROUND_HALF_UP)}} %</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <h5><strong>I.I Belanja Tidak Terduga (BTT)</strong></h5>
                        <div class="table-responsive">
                            <table class="table table-bordered no-footer table-hover" id="tbl_btt" role="grid">
                                <thead>
                                    <tr role="row" class="table-primary">
                                        <th width="10px;">No.</th>
                                        <th>Uraian</th>
                                        <th>Anggaran (RP)</th>
                                        <th>Realisasi (RP)</th>
                                        <th>Prosentase</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                        $total_alokasi = 0;
                                        $total_realisasi = 0;
                                    @endphp
                                    @foreach ($arr_group_btt as $idx => $item)
                                        <tr data-judul="{{$idx}}">
                                            <td valign="top">{{$no}}</td>
                                            <td valign="top">{{$idx}}</td>
                                            <td valign="top"><div style="float: left;">Rp. </div><div style="float: right;">{{number_format($item['alokasi'],2,',','.')}}</div></td>
                                            <td valign="top"><div style="float: left;">Rp. </div><div style="float: right;">{{number_format($item['realisasi'],2,',','.')}}</div></td>
                                            <td valign="top">{{round((float)$item['realisasi'] / (float)$item['alokasi']  * 100,0,PHP_ROUND_HALF_UP)}} %</td>
                                        </tr>
                                        @php
                                            $no++;
                                            $total_alokasi += $item['alokasi'];
                                            $total_realisasi += $item['realisasi'];
                                        @endphp
                                    @endforeach
                                    <tr>
                                        <td valign="top"></td>
                                        <td valign="top">TOTAL</td>
                                        <td valign="top"><div style="float: left;">Rp. </div><div style="float: right;">{{number_format($total_alokasi,2,',','.')}}</div></td>
                                        <td valign="top"><div style="float: left;">Rp. </div><div style="float: right;">{{number_format($total_realisasi,2,',','.')}}</div></td>
                                        <td valign="top">{{round((float)$total_realisasi / (float)$total_alokasi * 100,0,PHP_ROUND_HALF_UP)}} %</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="shadow-sm p-3 bg-white rounded tepi">
                        <div class="row">
                            <div class="col-sm-1 text-center">
                                <img src="assets/images/bantuan2.svg" alt="" height="50">
                            </div>
                            <div class="col-sm-11">
                                <strong>
                                    <span class="judul">
                                        II. Bantuan Pusat dan Propinsi <br>
                                    </span>
                                </strong>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5><strong>A. BANTUAN DARI PEMERINTAH PUSAT (APBN)</strong></h5>
                        <div class="table-responsive">
                            <table class="table table-bordered no-footer table-hover tabel_bantuan" id="tbl_bantuan_pusat" role="grid">
                                <thead>
                                    <tr role="row" class="table-primary">
                                        <th width="10px;">No.</th>
                                        <th>Jenis Bantuan</th>
                                        <th>Kuota (RP)</th>
                                        <th>Realisasi (RP)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr data-jenis="5" data-judul="BANTUAN SOSIAL TUNAI">
                                        <td valign="top">1</td>
                                        <td valign="top">BANTUAN SOSIAL TUNAI</td>
                                        <td valign="top"><div style="float: left;">Rp. </div><div style="float: right;">{{number_format($bst[0]->kuota,2,',','.')}}</div></td>
                                        <td valign="top"><div style="float: left;">Rp. </div><div style="float: right;">{{number_format($bst[0]->real,2,',','.')}}</div></td>
                                    </tr>
                                     <tr data-jenis="6" data-judul="PROGRAM KELUARGA HARAPAN (PKH)">
                                        <td valign="top">2</td>
                                        <td valign="top">PROGRAM KELUARGA HARAPAN (PKH)</td>
                                        <td valign="top"><div style="float: left;">Rp. </div><div style="float: right;">{{number_format($pkh[0]->kuota,2,',','.')}}</div></td>
                                        <td valign="top"><div style="float: left;">Rp. </div><div style="float: right;">{{number_format($pkh[0]->real,2,',','.')}}</div></td>
                                    </tr>
                                    <tr data-jenis="7" data-judul="PROGRAM SEMBAKO/BPNT/BSP">
                                        <td valign="top">3</td>
                                        <td valign="top">PROGRAM SEMBAKO/BPNT/BSP</td>
                                        <td valign="top"><div style="float: left;">Rp. </div><div style="float: right;">{{number_format($sembako[0]->kuota,2,',','.')}}</div></td>
                                        <td valign="top"><div style="float: left;">Rp. </div><div style="float: right;">{{number_format($sembako[0]->real,2,',','.')}}</div></td>
                                    </tr>
                                    <tr data-jenis="8" data-judul="BANTUAN BERAS DARI KEMENSOS @5Kg x Rp11.700">
                                        <td valign="top">4</td>
                                        <td valign="top">BANTUAN BERAS DARI KEMENSOS @5Kg x Rp11.700</td>
                                        <td valign="top"><div style="float: left;">-</td>
                                        <td valign="top"><div style="float: left;">Rp. </div><div style="float: right;">{{number_format($beras[0]->real,2,',','.')}}</div></td>
                                    </tr>
                                    <tr data-jenis="9" data-judul="BANTUAN BERAS PPKM DARI KEMENSOS @10Kg x Rp11.700">
                                        <td valign="top">5</td>
                                        <td valign="top">BANTUAN BERAS PPKM DARI KEMENSOS @10Kg x Rp11.700</td>
                                        <td valign="top">-</td>
                                        <td valign="top"><div style="float: left;">Rp. </div><div style="float: right;">{{number_format($beras_ppkm[0]->real,2,',','.')}}</div></td>
                                    </tr>

                                    <tr>
                                        <td valign="top"></td>
                                        <td valign="top">TOTAL</td>
                                        <td valign="top"><div style="float: left;">Rp. </div><div style="float: right;">{{number_format(array_sum([$bst[0]->kuota, $pkh[0]->kuota, $sembako[0]->kuota]),2,',','.')}}</div></td>
                                        <td valign="top"><div style="float: left;">Rp. </div><div style="float: right;">{{number_format(array_sum([$bst[0]->real, $pkh[0]->real, $sembako[0]->real, $beras[0]->real, $beras_ppkm[0]->real]),2,',','.')}}</div></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <h5><strong>B. BANTUAN DARI PEMERINTAH PROVINSI (APBD Propinsi)</strong></h5>
                        <div class="table-responsive">
                            <table class="table table-bordered no-footer table-hover tabel_bantuan" id="tbl_bantuan_provinsi" role="grid">
                                <thead>
                                    <tr role="row" class="table-primary">
                                        <th width="10px;">No.</th>
                                        <th>Jenis Bantuan</th>
                                        <th>Kuota (RP)</th>
                                        <th>Realisasi (RP)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr data-jenis="10" data-judul="SANTUNAN KEMATIAN COVID-19">
                                        <td valign="top">1</td>
                                        <td valign="top">SANTUNAN KEMATIAN COVID-19</td>
                                        <td valign="top"><div style="float: left;">Rp. </div><div style="float: right;">{{number_format($santunan_covid[0]->kuota,2,',','.')}}</div></td>
                                        <td valign="top"><div style="float: left;">Rp. </div><div style="float: right;">{{number_format($santunan_covid[0]->real,2,',','.')}}</div></td>
                                    </tr>
                                    <tr>
                                        <td valign="top"></td>
                                        <td valign="top">TOTAL</td>
                                        <td valign="top"><div style="float: left;">Rp. </div><div style="float: right;">{{number_format(array_sum([$santunan_covid[0]->kuota]),2,',','.')}}</div></td>
                                        <td valign="top"><div style="float: left;">Rp. </div><div style="float: right;">{{number_format(array_sum([$santunan_covid[0]->real]),2,',','.')}}</div></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="shadow-sm p-3 bg-white rounded tepi">
                        <div class="row">
                            <div class="col-sm-1 text-center">
                                <img src="assets/images/bantuan3.svg" alt="" height="50">
                            </div>
                            <div class="col-sm-11">
                                <strong>
                                    <span class="judul">
                                        III. Bantuan Masyarakat <br>
                                    </span>
                                </strong>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered no-footer table-hover" role="grid" id="tbl_csr">
                                <thead>
                                    <tr role="row" class="table-primary">
                                        <th width="10px;">No.</th>
                                        <th>Jenis Bantuan</th>
                                        <th>Jumlah (Rp)</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr data-jenis="11" data-judul="BANTUAN LANGSUNG KE RSUD BDH">
                                        <td valign="top">1</td>
                                        <td valign="top">BANTUAN LANGSUNG KE RSUD BDH (BARANG)</td>
                                        <td valign="top"><div style="float: left;">Rp. </div><div style="float: right;">{{number_format($total_bdh,2,',','.')}}</div></td>
                                    </tr>
                                    <tr data-jenis="12" data-judul="BANTUAN LANGSUNG KE RSUD SOEWANDHI">
                                        <td valign="top">2</td>
                                        <td valign="top">BANTUAN LANGSUNG KE RSUD SOEWANDHI (BARANG)</td>
                                        <td valign="top"><div style="float: left;">Rp. </div><div style="float: right;">{{number_format($total_swd,2,',','.')}}</div></td>
                                    </tr>
                                    <tr data-jenis="13" data-judul="SURABAYA PEDULI (BARANG)">
                                        <td valign="top">3</td>
                                        <td valign="top">SURABAYA PEDULI (BARANG)</td>
                                        <td valign="top"><div style="float: left;">Rp. </div><div style="float: right;">{{number_format($total_bantuan_barang,2,',','.')}}</div></td>
                                    </tr>
                                     <tr data-jenis="14" data-judul="SURABAYA PEDULI (UANG)">
                                        <td valign="top">4</td>
                                        <td valign="top">SURABAYA PEDULI (UANG)</td>
                                        <td valign="top"><div style="float: left;">Rp. </div><div style="float: right;">{{number_format($total_bantuan_uang,2,',','.')}}</div></td>
                                    </tr>
                                    <tr>
                                        <td valign="top"></td>
                                        <td valign="top">TOTAL</td>
                                        <td valign="top"><div style="float: left;">Rp. </div><div style="float: right;">{{number_format(array_sum([$total_bdh, $total_swd, $total_bantuan_barang, $total_bantuan_uang]),2,',','.')}}</div></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @php
                $anggaran_total_apbd = array_sum([$kesehatan[0]->kuota, $vaksin[0]->kuota, $ekonomi[0]->kuota, $jps[0]->kuota]);
                $anggaran_total_bantuan_provinsi = array_sum([$santunan_covid[0]->kuota]);
                $anggaran_total_bantuan_pusat = array_sum([$bst[0]->kuota, $pkh[0]->kuota, $sembako[0]->kuota, $beras[0]->kuota, $beras_ppkm[0]->kuota]);

                $total_apbd = array_sum([$kesehatan[0]->real, $vaksin[0]->real, $ekonomi[0]->real, $jps[0]->real]);
                $total_csr = array_sum([$total_bdh, $total_swd, $total_bantuan_barang, $total_bantuan_uang]);
                $total_bantuan_provinsi = array_sum([$santunan_covid[0]->real]);
                $total_bantuan_pusat = array_sum([$bst[0]->real, $pkh[0]->real, $sembako[0]->real, $beras[0]->real, $beras_ppkm[0]->real]);
            @endphp
            <div class="col-12">
                <div class="card">
                    <div class="shadow-sm p-3 bg-white rounded tepi">
                        <div class="card-body row table-responsive">
                            <table class="table table-border no-footer table-hover" role="grid" id="tbl_grandtotal">
                                 <thead>
                                    <tr role="row" class="table-warning">
                                        <th><h5><strong>GRAND TOTAL BELANJA PENANGANGAN COVID-19<strong></h5></th>
                                        <th width="33%" style="vertical-align:middle;font-size:18px;text-align: center;"><span style="font-size: 14px;">Anggaran</span><br><div style="float: left;">Rp. </div><div style="float: right;">{{number_format(array_sum([$anggaran_total_apbd,$anggaran_total_bantuan_provinsi,$anggaran_total_bantuan_pusat]),2,',','.')}}</div></th>
                                        <th width="33%" style="vertical-align:middle;font-size:18px;text-align: center;"><span style="font-size: 14px;">Realisasi</span><br><div style="float: left;">Rp. </div><div style="float: right;">{{number_format(array_sum([$total_apbd,$total_csr,$total_bantuan_provinsi,$total_bantuan_pusat]),2,',','.')}}</div></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>


            </div>

        </div>


    <div class="modal fade" id="detail_apbd_pemkot" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-xl">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modalTitleDetailApbdPemkot">Detail Bansos APBD Pemkot Surabaya</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
				</div>
				<div class="modal-body">
					<div class="table-responsive mt-3">
						<div class="freeze-table">
							<table class="table table-bordered table-striped table-hover dataTable" width="100%" id="datatable_apbd_pemkot">
								<thead>
									<tr class="table-primary">
										<th style="width: 10px;">No.</th>
										<th>Bidang</th>
										<th>OPD</th>
										<th>Kode</th>
										<th>Nama Subkegitan</th>
										<th>Rekening</th>
                                        <th>Nama Komponen</th>
                                        <th>Sumber Dana</th>
                                        <th>Anggaran</th>
                                        <th>Realisasi</th>
                                        <th>Anggaran (Raw)</th>
                                        <th>Realisasi (Raw)</th>
                                        <th>%</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
				</div>
			</div>
		</div>
	</div>

    <div class="modal fade" id="detail_btt" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-xl">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modalTitleDetailBtt">Detail BTT</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
				</div>
				<div class="modal-body">
					<div class="table-responsive mt-3">
						<div class="freeze-table">
							<table class="table table-bordered table-striped table-hover dataTable" width="100%" id="datatable_btt">
								<thead>
									<tr class="table-primary">
										<th style="width: 10px;">No.</th>
										<th>Bidang</th>
										<th>OPD</th>
                                        <th>Nama Komponen</th>
                                        <th>Anggaran</th>
                                        <th>Realisasi</th>
                                        <th>Anggaran (Raw)</th>
                                        <th>Realisasi (Raw)</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
				</div>
			</div>
		</div>
	</div>

    <div class="modal fade" id="detail_bantuan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-xl">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modalTitleDetailBantuan">Detail Bantuan</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
				</div>
				<div class="modal-body">
					<div class="table-responsive mt-3">
						<div class="freeze-table">
							<table class="table table-bordered table-striped table-hover dataTable" width="100%" id="datatable_bantuan">
								<thead>
									<tr class="table-primary">
										<th style="width: 10px;">No.</th>
                                        <th>Bulan</th>
                                        <th>Tahun</th>
										<th>Jenis Bantuan</th>
                                        <th>Keterangan</th>
										<th>Kuota (Rp)</th>
                                        <th>Realisasi (Rp)</th>
                                        <th>Kuota (Raw)</th>
                                        <th>Realisasi (Raw)</th>
                                        <th>%</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
				</div>
			</div>
		</div>
	</div>

    <div class="modal fade" id="detail_csr" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-xl">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modalTitleDetailCsr">Detail Bantuan Masyarakat</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
				</div>
				<div class="modal-body">
					<div class="table-responsive mt-3">
						<div class="freeze-table">
							<table class="table table-bordered table-striped table-hover dataTable" width="100%" id="datatable_csr">
								<thead>
									<tr class="table-primary">
										<th style="width: 10px;">No.</th>
										<th>Nama Bantuan</th>
                                        <th>Jumlah (Rp)</th>
                                        <th>Jumlah (Raw)</th>
										<th>Rincian Detil</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
				</div>
			</div>
		</div>
	</div>

    <div class="modal fade" id="detail_csr_default" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-xl">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modalTitleDetailCsrDefault">Detail Bantuan Masyarakat</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
				</div>
				<div class="modal-body">
					<div class="table-responsive mt-3">
						<div class="freeze-table">
							<table class="table table-bordered table-striped table-hover dataTable" width="100%" id="datatable_csr_default">
								<thead>
									<tr class="table-primary">
										<th style="width: 10px;">No.</th>
										<th>Nama Bantuan</th>
                                        <th>Jumlah (Rp)</th>
                                        <th>Jumlah (Raw)</th>
										<th>Asal</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
				</div>
			</div>
		</div>
	</div>

     <div class="modal fade" id="detail_csr_uang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-xl">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modalTitleDetailCsrUang">Detail Bantuan Masyarakat</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
				</div>
				<div class="modal-body">
					<div class="table-responsive mt-3">
						<div class="freeze-table">
							<table class="table table-bordered table-striped table-hover dataTable" width="100%" id="datatable_csr_uang">
								<thead>
									<tr class="table-primary">
										<th style="width: 10px;">No.</th>
										<th>Nama Bantuan</th>
										<th>Jumlah Bantuan (Rp) </th>
                                        <th>Jumlah Penerima Distribusi (Rp)</th>
                                        <th>Jumlah Bantuan (Raw) </th>
                                        <th>Jumlah Penerima Distribusi (Raw)</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
				</div>
			</div>
		</div>
	</div>

    <div class="modal fade" id="subdetail_csr" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-xl">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modalTitleSubdetail">Rincian Detail</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
				</div>
				<div class="modal-body">
					<div class="table-responsive mt-3">
						<div class="freeze-table">
							<table class="table table-bordered" width="100%" id="table_subdetail_csr">
								<thead>
									<tr class="table-primary">
										<th style="width: 10px;">No.</th>
										<th>Jenis Barang</th>
                                        <th>Merk</th>
										<th>Diterima Dari</th>
                                        <th>Jumlah Per Item</th>
                                        <th>Total</th>
                                        <th>Diserahkan Kepada</th>
									</tr>
								</thead>
								<tbody id="bodine-subdetail-csr">
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="resetContainerSubdetail()">Tutup</button>
				</div>
			</div>
		</div>
	</div>

    <div class="modal fade" id="subdetail_csr_uang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-xl">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modalTitleSubdetailUang">Rincian Detail</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
				</div>
				<div class="modal-body">
					<div class="table-responsive mt-3">
						<div class="freeze-table">
							<table class="table table-bordered table-striped table-hover dataTable" width="100%" id="datatable_subdetail_csr_uang">
								<thead>
									<tr class="table-primary">
										<th style="width: 10px;">No.</th>
										<th>Tanggal</th>
                                        <th>Jenis Barang</th>
										<th id="thSubdetailUang"></th>
                                        <th>Jumlah</th>
                                        <th>Jumlah (Raw)</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
				</div>
			</div>
		</div>
	</div>

    </section>
    <!-- /.content -->


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
    $('#tbl_apbd_pemkot tr:not(:last-child)').click(function () {
        let jenis = $(this).data('jenis');
        let judul = $(this).data('judul');
        $('#modalTitleDetailApbdPemkot').text(judul);
        $('#detail_apbd_pemkot').modal('show');
        load_detail_apbd_surabaya(jenis);
    });

    $('#tbl_btt tr:not(:last-child)').click(function () {
        let judul = $(this).data('judul');
        $('#modalTitleDetailBtt').text(judul);
        $('#detail_btt').modal('show');
        load_detail_btt(judul);
    });

    $('table.tabel_bantuan tr:not(:last-child)').click(function () {
        let jenis = $(this).data('jenis');
        let judul = $(this).data('judul');
        // console.log(jenis, judul);
        $('#modalTitleDetailBantuan').text(judul);
        $('#detail_bantuan').modal('show');
        load_detail_bantuan(jenis, judul);
    });

    $('#tbl_csr tr:not(:last-child)').click(function () {
        let jenis = $(this).data('jenis');
        // surabaya uang
        if(jenis == 14) {
            $('#detail_csr_uang').modal('show');
            load_detail_csr_uang(jenis);
        }
        // surabaya barang
        else if(jenis == 13){
            $('#detail_csr').modal('show');
            load_detail_csr(jenis);
        }else{
            $('#detail_csr_default').modal('show');
            load_detail_csr_default(jenis);
        }
    });

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

    $('#subdetail_csr').on('hidden.bs.modal', function () {
        $('#bodine-subdetail-csr').html('');
    })
});

const gantiTanggal = (tgl) => {
    location.href = "{{route('index')}}?tgl="+tgl;
}

const load_detail_apbd_surabaya = (jenis) => {
    if ( $.fn.DataTable.isDataTable('#datatable_apbd_pemkot') ) {
        $('#datatable_apbd_pemkot').DataTable().clear().destroy();
    }

    $('#datatable_apbd_pemkot').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy',
            {
                extend: 'excel',
                messageTop: 'Data APBD bidang '+jenis+' sampai dengan tanggal '+tanggal
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, ':visible' ] //only show visible column
                },
                messageTop: 'Data APBD bidang '+jenis+' sampai dengan tanggal '+tanggal
            },
        ],
        processing: true,
        serverside: true,
        ajax: {
            url: '{{route('app.datatable_apbd_sby')}}',
            method: 'POST',
            data: {
                tanggal: tanggal,
                jenis: jenis,
            },
        },
        language: {
            decimal: ",",
            thousands: "."
        },
        columnDefs: [
            { targets: 8, className: 'text-right' },
            { targets: 9, className: 'text-right' },
            { visible: false, searchable: false, targets: 10 },
            { visible: false, searchable: false, targets: 11 },
        ]
    });

}

const load_detail_btt = (judul) => {
    if ( $.fn.DataTable.isDataTable('#datatable_btt') ) {
        $('#datatable_btt').DataTable().clear().destroy();
    }

    $('#datatable_btt').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy',
            {
                extend: 'excel',
                messageTop: 'Data BTT bidang '+judul+' sampai dengan tanggal '+tanggal
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, ':visible' ] //only show visible column
                },
                messageTop: 'Data BTT bidang '+judul+' sampai dengan tanggal '+tanggal
            },
        ],
        processing: true,
        serverside: true,
        ajax: {
            url: '{{route('app.datatable_btt')}}',
            method: 'POST',
            data: {
                tanggal: tanggal,
                judul: judul,
            },
        },
        language: {
            decimal: ",",
            thousands: "."
        },
        columnDefs: [
            { targets: 4, className: 'text-right' },
            { targets: 5, className: 'text-right' },
            { visible: false, searchable: false, targets: 6 },
            { visible: false, searchable: false, targets: 7 },
        ]
    });

}

const load_detail_bantuan = (jenis, judul) => {
    if ( $.fn.DataTable.isDataTable('#datatable_bantuan') ) {
        $('#datatable_bantuan').DataTable().clear().destroy();
    }

    $('#datatable_bantuan').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy',
            {
                extend: 'excel',
                messageTop: 'Data '+judul+' sampai dengan tanggal '+tanggal
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, ':visible' ] //only show visible column
                },
                messageTop: 'Data '+judul+' sampai dengan tanggal '+tanggal
            },
        ],
        processing: true,
        serverside: true,
        ajax: {
            url: '{{route('app.datatable_bantuan')}}',
            method: 'POST',
            data: {
                tanggal: tanggal,
                jenis: jenis,
            },
        },
        language: {
            decimal: ",",
            thousands: "."
        },
        columnDefs: [
            { targets: 5, className: 'text-right' },
            { targets: 6, className: 'text-right' },
            { visible: false, searchable: false, targets: 7 },
            { visible: false, searchable: false, targets: 8 },
        ]
    });
}

const load_detail_csr_default = (jenis) => {
    if ( $.fn.DataTable.isDataTable('#datatable_csr_default') ) {
        $('#datatable_csr_default').DataTable().clear().destroy();
    }

    let tabelnya = $('#datatable_csr_default').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy',
            {
                extend: 'excel',
                messageTop: 'Data Bantuan Masyarakat sampai dengan tanggal '+tanggal
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, ':visible' ] //only show visible column
                },
                messageTop: 'Data Bantuan Masyarakat sampai dengan tanggal '+tanggal
            },
        ],
        processing: true,
        serverside: true,
        ajax: {
            url: '{{route('app.datatable_csr_default')}}',
            method: 'POST',
            data: {
                jenis : jenis,
                tanggal: tanggal,
            },
        },
         language: {
            decimal: ",",
            thousands: "."
        },
        columnDefs: [
            { targets: 2, className: 'text-right' },
            { visible: false, searchable: false, targets: 3 },
        ]
    });
}

const load_detail_csr = (jenis) => {
    if ( $.fn.DataTable.isDataTable('#datatable_csr') ) {
        $('#datatable_csr').DataTable().clear().destroy();
    }

    let tabelnya = $('#datatable_csr').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy',
            {
                extend: 'excel',
                messageTop: 'Data Bantuan Masyarakkat sampai dengan tanggal '+tanggal
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2 ]
                },
                messageTop: 'Data Bantuan Masyarakkat sampai dengan tanggal '+tanggal
            },
        ],
        processing: true,
        serverside: true,
        ajax: {
            url: '{{route('app.datatable_csr')}}',
            method: 'POST',
            data: {
                jenis : jenis,
                tanggal: tanggal,
            },
        },
        language: {
            decimal: ",",
            thousands: "."
        },
        columnDefs: [
            { targets: 2, className: 'text-right' },
            { visible: false, searchable: false, targets: 3 },
        ]
    });
}

const load_detail_csr_uang = (jenis) => {
    if ( $.fn.DataTable.isDataTable('#datatable_csr_uang') ) {
        $('#datatable_csr_uang').DataTable().clear().destroy();
    }

    let tabelnya = $('#datatable_csr_uang').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy',
            {
                extend: 'excel',
                messageTop: 'Data Bantuan Masyarakkat sampai dengan tanggal '+tanggal
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, ':visible' ]
                },
                messageTop: 'Data Bantuan Masyarakkat sampai dengan tanggal '+tanggal
            },
        ],
        processing: true,
        serverside: true,
        ajax: {
            url: '{{route('app.datatable_csr_uang')}}',
            method: 'POST',
            data: {
                jenis : jenis,
                tanggal: tanggal,
            },
        },
        language: {
            decimal: ",",
            thousands: "."
        },
        columnDefs: [
            { targets: 2, className: 'text-right' },
            { targets: 3, className: 'text-right' },
            { visible: false, searchable: false, targets: 4 },
            { visible: false, searchable: false, targets: 5 },
        ]
    });
}

const displayModalSubDetail = (barang, satuan) => {
    $('#modalTitleSubdetail').text(barang);
    $('#subdetail_csr').modal('show');
    $.ajax({
        type: "POST",
        url: '{{route('app.load_tabel_subdetail')}}',
        data: {
            tanggal: tanggal,
            barang: barang,
            satuan: satuan
        },
        dataType: "json",
        success: function (response) {
            if(response.status) {
                $('#bodine-subdetail-csr').html(response.html);
            }
        }
    });

    // table_subdetail_uang
}

const displayModalSubDetailUang = (barang, is_asal) => {
    if ( $.fn.DataTable.isDataTable('#datatable_subdetail_csr_uang') ) {
        $('#datatable_subdetail_csr_uang').DataTable().clear().destroy();
    }

    $('#modalTitleSubdetailUang').text(barang);

    if(is_asal == 'true') {
        $('#thSubdetailUang').text('Diterima Dari');
    }else{
        $('#thSubdetailUang').text('Disalurkan Kepada');
    }

    $('#subdetail_csr_uang').modal('show');

    $('#datatable_subdetail_csr_uang').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy',
            {
                extend: 'excel',
                messageTop: 'Data Bantuan Masyarakkat sampai dengan tanggal '+tanggal
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, ':visible' ]
                },
                messageTop: 'Data Bantuan Masyarakkat sampai dengan tanggal '+tanggal
            },
        ],
        processing: true,
        serverside: true,
        ajax: {
            url: '{{route('app.datatable_subdetail_uang')}}',
            method: 'POST',
            data: {
                tanggal: tanggal,
                barang: barang,
                is_asal: is_asal
            },
        },
        language: {
            decimal: ",",
            thousands: "."
        },
        columnDefs: [
            { targets: 4, className: 'text-right' },
            { visible: false, searchable: false, targets: 5 },
        ]

    });

    // table_subdetail_uang
}



const tarikData = () => {
   Swal.fire({
        title: 'Yakin Update Data ?',
        text: "Data di Dashboard kemungkinan akan berubah",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Update Data!'
    }).then((result) => {
        if (result.isConfirmed) {
            $('#loading').show();
             $.ajax({
                type: "GET",
                url: "{{ route('app.proses_tarik', ['tgl' => \Request::get('tgl') ?? \Carbon\Carbon::now()->format('d-m-Y'), 'metode' => 'manual'])}}",
                dataType: "json",
                success: function (response) {
                    if(response.status == 'success') {
                        $('#loading').hide();
                        Swal.fire(
                            'Sukses!',
                            'Data Dashboard berhasil diperbaharui.',
                            'success'
                        )
                        location.reload();
                    }else{
                        $('#loading').hide();
                        Swal.fire(
                            'Gagal!',
                            'Data Dashboard Gagal Diperbaharui.',
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
