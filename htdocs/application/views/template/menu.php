<aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?=base_url();?>/asset/images/avatar.png" class="img-circle" alt="User Image" />
        </div>
        <div class="pull-left info">
          <p><?=$nama;?></p>

          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Pencarian..."/>
          <span class="input-group-btn">
            <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
          </span>
        </div>
      </form>
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="treeview">
          <a href="<?php echo base_url();?>app">
            <i class="fa fa-dashboard ajax"></i> <span>Home</span>
            <!-- <i class="fa fa-angle-left pull-right"></i> -->
          </a>          
        </li>        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Master Data</span><i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url();?>tahun"><i class="fa fa-circle-o text-yellow ajax"></i> Data Tahun</a></li>
            <li><a href="<?php echo base_url();?>satuan"><i class="fa fa-circle-o text-yellow ajax"></i> Data Satuan</a></li>
            <li><a href="<?php echo base_url();?>lokasi"><i class="fa fa-circle-o text-yellow ajax"></i> Lokasi PIT</a></li>
            <li><a href="<?php echo base_url();?>parameter"><i class="fa fa-circle-o text-yellow ajax"></i> Data Parameter</a></li>
            <!-- <li><a href="<?php echo base_url();?>app/develop"><i class="fa fa-circle-o text-yellow ajax"></i> Parameter Pengupasan OB</a></li>
            <li><a href="<?php echo base_url();?>app/develop"><i class="fa fa-circle-o text-yellow ajax"></i> Parameter Peledakan OB</a></li>
            <li><a href="<?php echo base_url();?>app/develop"><i class="fa fa-circle-o text-yellow ajax"></i> Parameter Penggunaan Bahan Peledak</a></li>
            <li><a href="<?php echo base_url();?>app/develop"><i class="fa fa-circle-o text-yellow ajax"></i> Parameter Pengelolaan Air Tambang</a></li>  -->
          </ul>
        </li>
        <li class="treeview">
          <a href="<?php echo base_url();?>webgis">
            <i class="fa fa-square ajax"></i> <span>Webgis Dashboard</span>
          </a>          
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-map-marker"></i>
            <span>GIS Data List</span><i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url();?>pit"><i class="fa fa-circle-o text-yellow ajax"></i> Pit</a></li>
            <li><a href="<?php echo base_url();?>disposal"><i class="fa fa-circle-o text-yellow ajax"></i> Disposal OB </a></li>
            <li><a href="<?php echo base_url();?>disposal_soil"><i class="fa fa-circle-o text-yellow ajax"></i> Disposal Soil</a></li>
            <li><a href="<?php echo base_url();?>bukaanlahan"><i class="fa fa-circle-o text-yellow ajax"></i> Bukaan Lahan</a></li>
            <li><a href="<?php echo base_url();?>catchmentpit"><i class="fa fa-circle-o text-yellow ajax"></i> Catchment Area</a></li>
            <li><a href="<?php echo base_url();?>pemukiman"><i class="fa fa-circle-o text-yellow ajax"></i> Pemukiman</a></li>
            <li><a href="<?php echo base_url();?>fasilitas_penunjang"><i class="fa fa-circle-o text-yellow ajax"></i> Fasilitas Penunjang</a></li>
            <li><a href="<?php echo base_url();?>reklamasi"><i class="fa fa-circle-o text-yellow ajax"></i> Reklamasi</a></li>
            <li><a href="<?php echo base_url();?>settling_pond"><i class="fa fa-circle-o text-yellow ajax"></i> Settling Pond</a></li>
            <li><a href="<?php echo base_url();?>app/develop"><i class="fa fa-circle-o text-yellow ajax"></i> Toponimi</a></li>
            <li><a href="<?php echo base_url();?>topoupdate"><i class="fa fa-circle-o text-yellow ajax"></i> Topo Update</a></li>
          </ul>
        </li>                          
        <li class="treeview">
          <a href="#">
            <i class="fa fa-tags"></i>
            <span>Non GIS</span><i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url();?>app/develop"><i class="fa fa-circle-o text-yellow ajax"></i> Pengupasan OB</a></li>
            <li><a href="<?php echo base_url();?>app/develop"><i class="fa fa-circle-o text-yellow ajax"></i> Peledakan OB</a></li>
            <li><a href="<?php echo base_url();?>app/develop"><i class="fa fa-circle-o text-yellow ajax"></i> Penimbunan OB</a></li>
            <li><a href="<?php echo base_url();?>app/develop"><i class="fa fa-circle-o text-yellow ajax"></i> Inpit Outpit Dump Tambang Terbuka</a></li>
            <li><a href="<?php echo base_url();?>app/develop"><i class="fa fa-circle-o text-yellow ajax"></i> Elevasi Kedalaman Tambang</a></li>
            <li><a href="<?php echo base_url();?>app/develop"><i class="fa fa-circle-o text-yellow ajax"></i> Penempatan Timbunan OB Out Pit Dump</a></li>
            <li><a href="<?php echo base_url();?>app/develop"><i class="fa fa-circle-o text-yellow ajax"></i> Penggunaan Bahan Peledak</a></li>            
          </ul>
        </li>
        <!-- <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Report</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url();?>app/develop"><i class="fa fa-circle-o text-yellow"></i> Rekrutmen</a></li>
            <li><a href="<?php echo base_url();?>chart"><i class="fa fa-circle-o text-yellow"></i> Grafik Rekrutmen</a></li>
          </ul>
        </li> -->
      </ul>
    </section>
</aside>