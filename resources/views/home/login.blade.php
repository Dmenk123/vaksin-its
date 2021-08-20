
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}" />

 <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('assets/css')}}/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('assets/css')}}/dataTables.bootstrap4.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('assets/css')}}/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>Anggaran Belanja</b> Covid</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Mohon mengisi username dan password</p>
      <form id="login_form" method="post">
        <div class="input-group mb-3">
          <input type="text" name="username" id="username" class="form-control" placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" id="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" id="submitform" class="btn btn-primary btn-block"><span>Log In</span></button>
          </div>
          <!-- /.col -->
        </div>
      </form>

    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<script src="{{asset('assets/js')}}/jquery.min.js"></script>
<script src="{{asset('assets/js')}}/sweetalert2@10.js"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('assets/js')}}/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="{{asset('assets/js')}}/jquery.dataTables.js"></script>
<script src="{{asset('assets/js')}}/dataTables.bootstrap4.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('assets/js')}}/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('assets/js')}}/demo.js"></script>
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


$(document).ready(function(){
    $("#login_form").submit(function(){   
        $(".text-danger").remove();
        event.preventDefault();
        var data = new FormData($('#login_form')[0]);
        $("#submitform").attr('disabled', true);
        $("#submitform span").text('Mohon tunggu...');

        $.ajax({  
            url:"{{route('login.cek')}}",  
            method:"POST",  
            headers: { "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content") },
            data: data,
            datatype:'json',
            processData: false,
            contentType: false,
            success:function(data)  
            {  
                if($.isEmptyObject(data.error)){
                
                    if(data.status == true){
                        $("#submitform").removeAttr('disabled');
                        $("#submitform span").text('Simpan Data');
                        $("form").each(function() { this.reset() });  
                        swal.fire({
                            title: "Pemberitahuan",
                            text: "Anda Berhasil Login !",
                            icon: "success"
                        }).then(function() {
                            location.href = data.redirect;
                        });
                    }else{
                        swal.fire("Telah terjadi kesalahan pada sistem", "Mohon refresh halaman browser Anda", "warning");
                        $("#submitform").removeAttr('disabled');
                        $("#submitform span").text('Log In');
                    }

                }else{
                    swal.fire("Terjadi kesalahan input!", "cek kembali inputan anda", "warning");
                    $("#submitform").removeAttr('disabled');
                    $("#submitform span").text('Log In');
                    $.each(data.error, function(key, value) {
                        var element = $("#" + key);
                        element.closest("div.form-control")
                        .removeClass("text-danger")
                        .addClass(value.length > 0 ? "text-danger" : "")
                        .find("#error_" + key).remove();
                        element.after("<div id=error_"+ key + " class=text-danger>" + value + "</div>");
                    });
                }
            },
            error: function(){
                swal.fire("Telah terjadi kesalahan pada sistem", "Mohon refresh halaman browser Anda", "error");
                $("#submitform").removeAttr('disabled');
                $("#submitform span").text('Log In');
            }
        });  
    }); 
}); 
</script>
</body>
</html>
