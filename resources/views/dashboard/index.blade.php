@extends('layout.index')




@section('content')


<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Home</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Home</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-8">
          
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Agenda Kerja Panitia</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
              

                  <div class="col-md-12">
                      <table class="table table-bordered table-sm table-striped">
                        <thead>
                          <tr>
                            <th class="text-center" rowspan="2">No</th>
                            <th class="text-center" colspan="2">Tanggal</th>
                            <th class="text-center" rowspan="2">Agenda Kerja</th>
                            <th class="text-center" rowspan="2"></th>
                          </tr>
                          <tr>
                            <th class="text-center">Mulai</th>
                            <th class="text-center">Selesai</th>
                          </tr>
                        </thead>
                        <tbody>
                       @php $x = 1; @endphp
                       @foreach($data as $menu)
                       @php
                       if(\Route::has('app.transaksi.'.$menu->m_agenda_kegiatan->link.'.index')){
                          $link = route('app.transaksi.'.$menu->m_agenda_kegiatan->link.'.index');
                       }else{
                          $link = '#';
                       }
                       @endphp
                            <tr>
                                <td align="center">{{$x++}}</td>
                                <td align="center">{{date('d-m-Y',strtotime($menu->tgl_mulai))}}</td>
                                <td align="center">{{date('d-m-Y',strtotime($menu->tgl_selesai))}}</td>
                                <td>{{$menu->m_agenda_kegiatan->nama_agenda}}</td>
                                <td>
                                  <a class="btn btn-info btn-sm" href="#"><i class="fas fa-question-circle"></i></a>
                                  <a class="btn btn-warning btn-sm" href="#"><i class="fas fa-edit"></i></a>
                                  <a class="btn btn-primary btn-sm" href="{{ $link }}">Menu</a>
                                </td>
                            </tr>
                             @endforeach
                        </tbody>
                      </table>
                  </div>
                </div>
               
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>

        <div class="col-md-4">
          
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">e-TAS/IMTAS</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                      <ul class="list-group">
                        <li class="list-group-item"><a href="">Registrasi</a></li>
                        <li class="list-group-item"><a href="">Daftar Panitia</a></li>
                        <li class="list-group-item"><a href="">Daftar Penguji</a></li>
                        <li class="list-group-item"><a href="">Surat Pernyataan</a></li>
                        <li class="list-group-item"><a href="">Login</a></li>
                      </ul>
                  </div>
                </div>
               
            </div>

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  





@endsection