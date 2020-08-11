<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title><?=$judul;?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="<?=$app_name;?>">
    <meta name="author" content="Ahmad Sultoni">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link rel="shortcut icon" type="image/x-icon" href="<?=base_url();?>asset/images/favicon.png">
    <!-- Bootstrap 3.3.2 -->
    <link href="<?=base_url();?>asset/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <!-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" /> -->
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>asset/css/font-awesome.min.css">
    <!-- Theme style -->
    <link href="<?=base_url();?>asset/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="<?=base_url();?>asset/plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />    

    <style type="text/css" media="screen">      
      .background-image{
        position:fixed;
        left:0;
        right:0;
        top:0;
        bottom:0;
        /* background: url(http://localhost/intranet/asset/images/cikupa_gate.png); */
        background-color:#dddddd;
        background-size:cover;
        z-index:0;
        /*-webkit-filter: blur(3px);
        -moz-filter: blur(3px);
        -o-filter: blur(3px);
        -ms-filter: blur(3px);
        filter: blur(3px); */
      }      
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="background-image">
    <div id="loading" style="text-align:center;font-size:24pt;padding-top:20%;display:none;"></div>
    <div class="login-box">
      <div class="login-logo">
        <a href="#">
          <img src="<?=base_url();?>asset/images/logo.png" alt="Balangan" width="120" height="80">
          <!-- <b>SITOTAM</b> <font size="4" color="#FFFFFF">Integrated System</font> -->
        </a>
      </div><!-- /.login-logo -->
      
      <?php
        if($this->session->flashdata('msg') != ''){
          echo '
          <div class="row-fluid">
                <div class="span12 alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>'.$this->session->flashdata('msg').'</div>
              </div>';
        }
      ?>

      <div class="login-box-body">
        <p class="login-box-msg">Welcome to <strong>SIPP</strong></p>
        <!-- <form action="<?=base_url();?>app/auth_user" method="post"> -->
        <?php echo form_open("app/auth_user", '-class="form-horizontal"'); ?>
          <div class="form-group has-feedback">
            <input title="NDK tidak boleh kosong" type="text" class="form-control" id="txtNIK" name="txtNIK" placeholder="NIK" maxlength="10" autocomplete="off" required/>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input title="Password tidak boleh kosong" type="password" class="form-control" id="txtPwd" name="txtPwd" placeholder="Password" required/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">    
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox"> Remember Me
                </label>
              </div>                        
            </div>
            <div class="col-xs-4">
              <button type="submit" class="btn btn-warning btn-block btn-flat" id="btnLogin"><i class="glyphicon glyphicon-log-in"></i> &nbsp;Sign In</button>
            </div><!-- /.col -->
          </div>
        <!-- </form> -->
        <?php echo form_close();?>

        <!-- <div class="social-auth-links text-center">
          <p>- OR -</p>
          <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using Facebook</a>
          <a href="#" class="btn btn-block btn-social btn-google-plus btn-flat"><i class="fa fa-google-plus"></i> Sign in using Google+</a>
        </div> -->

        <a href="#" id="link_forget">I forgot my password</a><br>
        <!-- <a href="#" class="text-center">Register a new membership</a> -->

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.3 -->
    <script src="<?=base_url();?>asset/plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?=base_url();?>asset/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="<?=base_url();?>asset/plugins/iCheck/icheck.min.js" type="text/javascript"></script>    
    <script>
      $(document).ready(function(){
          $('#txtNIK').focus();
          
          function Display_Load(){
            $("#loading").fadeIn(1000,0);
          }
          function Hide_Load(){
            $("#loading").fadeOut('slow');
          }

          $(function () {
              $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
              });
          });

          $('#link_forget').click(function() {
              $('#form-forget').modal({
                show: true,
                keyboard:false,
                backdrop:false
              })
          });

          function cek_login(){
              var nik = $('#txtNIK').val();
              var pwd = $('#txtPwd').val();

              Display_Load();
              if (nik.length==0) {
                alert('NIK tidak boleh kosong');
                $('#txtNIK').focus();
                Hide_Load();
                return false;
              }
              if (pwd.length==0) {
                alert('Password tidak boleh kosong');
                $('#txtPwd').focus();
                Hide_Load();
                return false;
              }              
          }
      })      
    </script>

    <div class="modal fade" id="form-forget" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display:none;">
        <div class="modal-dialog" style="width:350px;">
            <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h3 class="modal-title">Informasi</h3>
                </div>
                <div class="modal-body">
                    <p>Jika Anda lupa password, silakan hubungi IT untuk reset password.</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-warning btn-flat" data-dismiss="modal"><i class="glyphicon glyphicon-ok-sign"></i> OK</button>                  
                </div>
            </div>
        </div>
    </div>
  </body>
</html>