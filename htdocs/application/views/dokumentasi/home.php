<script type="text/javascript">
	$(window).on("load", function() {
		$('#txtNama').focus();
		
		load_data();

		$('#btnRefresh').click(function(){
			load_data();
		})		

		function load_data(){
      		var cari = $('#txtCari').val();

			$.ajax({
				type : 'POST',
				url  : '<?=base_url()?>dokumentasi/load_data',
				data : {'cari':cari},
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

		function bersih(){
			$('#txtKode').val('');
			$('#txtNama').val('');
			$('#txtKode').focus();
		}

	})
</script>
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Upload Dokumen
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-edit"></i> Dokumentasi</a></li>
			<li class="active">Upload Dokumen</li>
		</ol>
	</section>

	<section class="content">		
		<div class="box box-stable">
			<div class="box-header with-border">
	          <h3 class="box-title"></h3>
	          <div class="box-tools pull-right">
	            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
	            <!-- <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
	          </div>
	        </div>
	        <div class="box-body">
	        	<div class="input-group">									        	        					        
			        <div class="input-group-btn">
			        	<a href="<?=base_url()?>dokumentasi/show_add" class="btn btn-sm btn-info btn-flat" id="btnTambah"><i class="fa fa-plus"></i> Tambah</a>
						<button class="btn btn-success btn-sm btn-flat" id="btnRefresh" style="margin-left:5px;"><i class="fa fa-refresh"></i> Refresh</button>
			        	<button class="btn btn-sm btn-default pull-right"><i class="fa fa-search"></i></button>
			        	<input type="text" id="txtCari" class="form-control input-sm pull-right" style="width:250px;" placeholder="Cari Nama Dokumen..."/>			          	
			        </div>
			    </div>
	        	<div >
	        		<div id="isiData" style="margin-top:5px;"></div>
	        	</div>
	        </div> 		    
	  	</div>	 
	</section>	

	<!-- form hapus -->
	<div class="modal fade" id="form-hapus" role="dialog" aria-hidden="true" style="display:none;">
		<div class="modal-dialog custom-modal-del">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Judul</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
				        <label class="control-label">Yakin data akan dihapus...?</label>
			            <input type="hidden" class="form-control" id="txtid_hapus" size="5" readonly />
				    </div>				    
				</div>
				<div class="modal-footer">					
					<button type="button" class="btn btn-info btn-flat" id="btnHapus"><i class="fa fa-sm fa-trash-o"></i> Hapus</button>
					<button type="button" class="btn btn-warning btn-flat" data-dismiss="modal"><i class="fa fa-sm fa-mail-reply"></i> Batal</button>
				</div>
			</div>
		</div>
	</div>
	
</div>