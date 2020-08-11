<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title><?=$judul;?></title>
    <meta name="description" content="<?=$deskripsi;?>">
    <meta name="author" content="Ahmad Sultoni">	
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="<?=base_url();?>asset/images/favicon.png" rel="shortcut icon" type="image/x-icon">
    <!-- Bootstrap 3.3.2 -->
    <link href="<?=base_url();?>asset/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!--<link href="<?=base_url();?>asset/css/custom-theme/jquery-ui-1.10.0.custom.css" rel="stylesheet" type="text/css">-->
    <!-- FONTAWESOME ICONS STYLES-->
    <link href="<?=base_url();?>asset/skin/css/font-awesome.css" rel="stylesheet" />
    <!-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" /> -->
    <!-- Ionicons -->
    <!-- <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" /> -->
    <link href="<?=base_url();?>asset/css/ionicons.css" rel="stylesheet" type="text/css" />
    <!-- Data table -->
    <!--<link href="<?=base_url();?>asset/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />-->
    <!-- Morris chart -->
     <!-- <link href="<?=base_url();?>asset/plugins/morris/morris.css" rel="stylesheet" type="text/css" />  -->
    <link href="<?=base_url();?>asset/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <!-- <link href="<?=base_url();?>asset/plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" /> -->
    <!-- Daterange picker -->
    <!-- <link href="<?=base_url();?>asset/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" /> -->
    <!-- Theme style -->
    <link href="<?=base_url();?>asset/dist/css/AdminLTE.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
    <link href="<?=base_url();?>asset/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url();?>asset/plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url();?>asset/dist/css/style.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url();?>asset/css/sweet-alert.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url();?>asset/plugins/select2/select2.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url();?>asset/js/jquery.autocomplete.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url();?>asset/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url();?>asset/nprogress/nprogress.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url();?>asset/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />    
    <!--<script src="<?=base_url();?>asset/js/jQuery-2.1.3.min.js"></script>-->
    <!-- Bootstrap 3.3.2 JS -->
    <!--<script src="<?=base_url();?>asset/skin/js/bootstrap.js"></script>-->
    <!-- METISMENU SCRIPTS -->
    <!--<script src="<?=base_url();?>asset/skin/js/jquery.metisMenu.js"></script>-->
    <!-- CUSTOM SCRIPTS -->
    <!--<script src="<?=base_url();?>asset/skin/js/custom.js"></script>-->
    <!-- jQuery 2.1.3 -->
    <script src="<?=base_url();?>asset/js/jquery.min.js"></script>  
    <!--<script src="<?=base_url();?>asset/js/jquery-ui-1.9.2.custom.min.js" type="text/javascript"></script>-->
    <script src="<?=base_url();?>asset/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="<?=base_url();?>asset/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?=base_url();?>asset/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    
    <!-- FastClick -->
    <!--<script src='<?=base_url();?>asset/plugins/fastclick/fastclick.min.js'></script>
    <!- AdminLTE App -->
    <script src="<?=base_url();?>asset/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <script src="<?=base_url();?>asset/dist/js/app.min.js" type="text/javascript"></script>
    <!-- Sparkline -->
    <!--<script src="<?=base_url();?>asset/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>-->
    <!-- jvectormap -->
    <!--<script src="<?=base_url();?>asset/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
    <script src="<?=base_url();?>asset/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>-->
    <!-- daterangepicker -->
    <!--<script src="<?=base_url();?>asset/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>-->
    <!-- datepicker -->
    <script src="<?=base_url();?>asset/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
    <!-- Data Table -->
    
    <!-- SlimScroll 1.3.0 -->
    <script src="<?=base_url();?>asset/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!--<script src="<?=base_url();?>asset/plugins/chartjs/Chart.min.js" type="text/javascript"></script>-->

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <!--<script src="<?=base_url();?>asset/dist/js/pages/dashboard2.js" type="text/javascript"></script>-->

    <!-- AdminLTE for demo purposes -->
    <script type="text/javascript" src="<?=base_url();?>asset/dist/js/demo.js"></script>
    <script type="text/javascript" src="<?=base_url();?>asset/plugins/iCheck/icheck.min.js"></script>
    <script type="text/javascript" src="<?=base_url();?>asset/js/autoNumeric.js"></script>
    <script type="text/javascript" src="<?=base_url();?>asset/js/jquery.number.js"></script>
    <script type="text/javascript" src="<?=base_url();?>asset/js/sweet-alert.js"></script>
    <script type="text/javascript" src="<?=base_url();?>asset/plugins/select2/select2.full.js"></script>
    <script type="text/javascript" src="<?=base_url();?>asset/js/jquery.autocomplete.js"></script>
    <script type="text/javascript" src="<?=base_url();?>asset/js/jquery.form.js"></script>
    <script type="text/javascript" src="<?=base_url();?>asset/js/jquery.ajaxfileupload.js"></script>
    <script type="text/javascript" src="<?=base_url();?>asset/nprogress/nprogress.js"></script>
    <!-- <script type="text/javascript" src="<?=base_url();?>asset/js/FusionCharts_.js"></script> -->
    <script type="text/javascript" src="<?=base_url();?>asset/js/jquery.battatech.excelexport.js"></script>
    <script type="text/javascript" src="<?=base_url();?>asset/js/ion.sound.min.js"></script>
    <!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8MYBtTMTZyd0Tx-O534jA4Ry61L9DJS8"></script>-->
    <!--<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?libraries=places"></script>-->
    <!--<script src="//maps.googleapis.com/maps/api/js" type="text/javascript"></script>-->
    <!--<script src="https://maps.googleapis.com/maps/api/js"></script>-->
    <!-- <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script> -->
    <!--<script src="https://maps-api-ssl.google.com/maps/api/js?libraries=places"></script>-->
    <!--<script src="https://maps-api-ssl.google.com/maps/api/js"></script>-->

    <link rel="stylesheet" href="<?php echo base_url() ?>static/leaflet/leaflet.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>static/leaflet/L.control.Sidebar.css">
    <script src="<?php echo base_url() ?>static/js/sanwkttojson.js"></script>
    <script src="<?php echo base_url() ?>static/leaflet/leaflet.js"></script>
    <script src="<?php echo base_url() ?>static/leaflet/Leaflet.Control.Custom.js"></script>
    <script src="<?php echo base_url() ?>static/leaflet/L.control.Sidebar.js"></script>
    <script src="<?php echo base_url() ?>static/leaflet/Control.Draw.js"></script>

    <script type="text/javascript">
      $(window).on("load", function() {
        $(function () {
          $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
          });
        });

        $('.select2').select2();

        $('.datepicker').datepicker({
            "setDate": new Date(),
            autoclose: true,
            format: 'yyyy-mm-dd',
        })

        $('#btnBack').click(function(){
          window.history.go(-1);
        })
      });		
	  </script>
    
  </head>
  <body class="skin-green sidebar-collapse sidebar-mini- fixed">
    	<div class="wrapper">    		
    		<div id="header">
    			<?=$_header;?>
    		</div>
    		<div id="menu">
    			<?=$_menu;?>
    		</div>
    		<div id="content">
    			<?=$_content;?>
    		</div>
    		<div id="footer">
    			<?=$_footer;?>
    		</div>
    	</div>    				    
  </body>
</html>