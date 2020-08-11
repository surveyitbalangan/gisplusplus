<script type="text/javascript">
    $(window).on("load", function() {
        // alert('AJAX');
        
    })
</script>

<div class="content-wrapper">
	<section class="content-header">
		<h1>
            <?=$company;?> - 
            <?php 
                foreach($kategori->result_array() as $isi){
                    echo $isi['KATEGORI'];
                } 
            ?>          
			<!-- <small>Document Control Management System</small> -->
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Dashboard</li>
		</ol>
	</section>

	<section class="content">		
		<div class="row">			
			<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="box box-primary-">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <button class="btn btn-info btn-sm btn-flat" id="btnBack"><i class="fa fa-mail-reply"></i> Kembali</button>
                        </h3>                
                        <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>                  
                        </div>
                    </div>              
                    <div class="box-body">
                        <ul class="products-list product-list-in-box" id="isi_open">
                            <?php 
                                foreach($data->result_array() as $isi){
                                    if($isi['JML']>0){
                                        $warna = 'label-success';
                                    }else if($isi['JML']<=0){
                                        $warna = 'label-danger';
                                    }
                            ?>
                            <li class="item">
                                <div class="product-img">
                                    <a href="<?=base_url().'app/doc_list/'.$isi['ID_DOK'];?>">
                                        <img src="<?=base_url();?>asset/images/folder-1.png" alt="Image" width="50" height="50"/>
                                    </a>
                                </div>
                                <div class="product-info">
                                    <a href="<?=base_url().'app/doc_list/'.$isi['ID_DOK'];?>" class="product-title"><?=$isi['INISIAL'];?> <span class="label <?=$warna;?> pull-right"><?=$isi['JML'];?></span></a>
                                    <span class="product-description">
                                        Shared Dokumen di <?=$isi['KELOMPOK'];?>
                                    </span>							
                                </div>
                            </li>
                            <?php 
                                } 
                            ?>
                        </ul>
                    </div>              
                    <!-- <div class="box-footer text-center">
                        <a href="<?=base_url();?>app/develop" class="uppercase">View All</a>
                    </div>  -->
                </div>
            </div>

            <!-- <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="box box-primary-">
                    <div class="box-header with-border">
                        <h3 class="box-title">New Document</h3>
                        <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    
                    <div class="box-body">
                        <ul class="products-list product-list-in-box" id="isi_new_document">
                        
                        </ul>
                    </div>                                       
                </div>
            </div> -->
		</div>				
    	
	</section>

</div>