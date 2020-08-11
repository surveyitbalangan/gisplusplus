<script type="text/javascript">
    $(window).on("load", function() {
        // alert('AJAX');
        load_data();
        
        function load_data(){
            var id_doc  = $('#txtIdDoc').val();
            var cari    = $('#txtCari').val();
			$.ajax({
				type : 'POST',
				url  : '<?=base_url()?>app/load_data_doc',
				data : {'id_doc':id_doc,'cari':cari},
				cache: false,
				beforeSend: function() {
				  NProgress.start();
				},
				success : function(ok){					
					$('#isiData').animate({ opacity: "show" }, "slow");
					$('#isiData').html(ok);					
				},
				error : function(event, textStatus, errorThrown){
					alert('Pesan kesalahan : '+ textStatus + ' , HTTP Error : '+errorThrown);
				},
				complete : function(){
					NProgress.done();
				}	
			})
		}

        $('#txtCari').keyup(function(){
			var isi = $(this).val();
			if (isi!='') {
				load_data();
			}else{
				load_data();
			}
		})

        $('#btnHome').click(function(){
            window.location.replace('<?=base_url();?>');
        })
    })
</script>

<div class="content-wrapper">
	<section class="content-header">
		<h1>
            <?php 
                foreach($data->result_array() as $isi){
                    echo $isi['KATEGORI'].' - '.$isi['KELOMPOK'];
                } 
            ?>
            <input type="hidden" id="txtIdDoc" class="form-control" value="<?=$id_doc?>" readonly/>
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
                        <h3 class="box-title">Shared Document</h3>                
                        <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>                  
                        </div>
                    </div>              
                    <div class="box-body">
                        <div class="input-group">
                            <div class="input-group-btn">
                                <button class="btn btn-success btn-sm btn-flat" id="btnHome" style="margin-right:5px;"><i class="fa fa-home"></i></button>
                                <button class="btn btn-info btn-sm btn-flat" id="btnBack"><i class="fa fa-mail-reply"></i> Kembali</button>
                                <button class="btn btn-sm btn-default pull-right"><i class="fa fa-search"></i></button>
                                <input type="text" id="txtCari" class="form-control input-sm pull-right" style="width:250px;" placeholder="Cari Nama Dokumen..."/>                                
                            </div>                                                                       
                        </div>
                        <div>
                            <div id="isiData" style="margin-top:5px;"></div>
                        </div>                          
                    </div>                  
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
                    
                    <div class="box-footer text-center">
                        <a href="<?=base_url();?>app/develop" class="uppercase">View All</a>
                    </div>                    
                </div>
            </div> -->
		</div>				
    	
	</section>

</div>