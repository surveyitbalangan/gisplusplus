<header class="main-header">

  <!-- Logo -->
  <a href="<?=base_url();?>app" class="logo" style="background-color:#ffffff;">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><img src="<?=base_url();?>asset/images/logo.png" width="30" height="30"></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg">
        <img src="<?=base_url();?>asset/images/logo.png" width="65" height="40">
        <!-- <img src="<?=base_url();?>asset/images/mms_w.png" width="45" height="45"> -->
        <!-- <span style="color:#545252;"><?=$app_name;?></span> -->
    </span>
  </a>

  <nav class="navbar navbar-static-top" role="navigation">    
    <?php
      //if($nik=='14120325' || $nik=='00100000'){
    ?>
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <?php
      //}
    ?>
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">                
        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="<?=base_url();?>/asset/images/avatar.png" class="user-image" alt="User Image"/>
            <span class="hidden-xs"><?=$nama;?></span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              <img src="<?=base_url();?>/asset/images/avatar.png" class="img-circle" alt="User Image" />
              <p>
                <?=$nama;?>
                <small><?=$jabatan;?></small>
              </p>
            </li>            
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-left">
                <a href="/intranet" class="btn btn-info btn-flat"><i class="fa fa-user"></i> Intranet</a>
              </div>
              <div class="pull-right">
                <a href="<?=base_url();?>app/logout" class="btn btn-danger btn-flat"><i class="fa fa-sign-out"></i> Sign out</a>
              </div>
            </li>
          </ul>
        </li>
        <!-- Control Sidebar Toggle Button -->
        <li>
          <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
        </li>
      </ul>
    </div>

  </nav>
</header>