<script type="text/javascript">
	$(window).on("load", function() {
		// $('#txtNama').focus();
		
		load_data();		

		$('#btnTambah').click(function(){
			bersih();
			$('.modal-title').html("Create New Ticket");	
			$('#form-input').modal({
				show: true,
				keyboard:false,
				backdrop:false
			})			
		})

		$('#btnSimpan').click(function() {
			simpan();
		})		

		function simpan(){
			var kode 	 = $('#txtKode').val();
			var lokasi 	 = $('#cboLocation').val();
            var kategori = $('#cboCategory').val();
			var deskripsi = $('#txtDescription').val();
			var prioritas = $('#cboPriority').val();			

			// if (lokasi.length==0) {
			// 	alert('Lokasi belum dipilih !!!');
			// 	$('#txtNama').focus();
			// 	return false;
			// }

            if (kategori.length==0) {
				alert('Kategori belum dipilih !!!');
				$('#cboCategory').focus();
				return false;
			}
			if (deskripsi.length==0) {
				alert('Deskripsi tidak bleh kosong !!!');
				$('#txtDescription').focus();
				return false;
			}

			$.ajax({
				type : 'POST',
				url  : '<?=base_url()?>monitoring/simpan',
				data : {"no":kode,"location":lokasi,"category":kategori,"desc": deskripsi,"priority":prioritas},
				cache: false,
				success : function(result){
                    // alert(result);
					if (result=='simpan_ok'){
						swal('Information','Submit success','success');
					}else if (result=='simpan_no'){
						swal('Oops..','Submit failed','warning');
					}else if (result=='edit_ok') {
						swal('Information','Update success','success');
					}else if(result=='edit_no'){
						swal('Oops..','Update failed','warning');
					}
					load_data();
					$('#form-input').modal('hide');
				},
				error : function(event, textStatus, errorThrown){
					alert('Pesan kesalahan : '+ textStatus + ' , HTTP Error : '+errorThrown);
				}
			})
		}

		function load_data(){
            // var status = $('#cboStatus').val();

			$.ajax({
				type : 'POST',
				url  : '<?=base_url()?>monitoring/load_data',
				// data : {'status':status},
				// cache: false,
				beforeSend: function() {
			        NProgress.start();
			    },
				success : function(ok){					
					$('#isiData').animate({ opacity: "show" }, "slow");
					$('#isiData').html(ok);					
				},
				error : function(event, textStatus, errorThrown){
					// alert('Pesan kesalahan : '+ textStatus + ' , HTTP Error : '+errorThrown);
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
			}
			// else{
			// 	load_data();
			// }
		})

		function bersih(){
			$('#txtKode').val('');
			// $('#txtNama').val('');
			$('#txtDescription').val('').removeAttr('disabled','disabled');
			$('#cboPriority').val('1').removeAttr('disabled','disabled');
			$('#cboLocation').val('1').removeAttr('disabled','disabled');
			$('#cboCategory').val('1').removeAttr('disabled','disabled');
			$('#cboLocation').focus();			
		}

	})
</script>
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Monitoring Ticketing
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-desktop"></i> Monitoring</a></li>
			<li class="active">Ticketing List</li>
		</ol>
	</section>

	<section class="content">		
		<div class="box box-info">
			<div class="box-header with-border">
	          <h3 class="box-title"></h3>
	          <div class="box-tools pull-right">
	            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
	            <!-- <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
	          </div>
	        </div>
	        <div class="box-body">
	        	<div class="input-group">			        	        					        
                    <button class="btn btn-sm btn-info btn-flat" id="btnTambah"><i class="fa fa-plus"></i> Add New</button>
			        <div class="input-group-btn form-group- has-feedback">
			        	<!-- <button class="btn btn-sm btn-default pull-right"><i class="fa fa-search"></i></button> -->
			        	<input type="text" id="txtCari" class="form-control input-sm pull-right" style="width:230px;" placeholder="Search by name..."/>
                        <span class="fa fa-search form-control-feedback"></span>
			        </div>
			    </div>
	        	<div >
	        		<div id="isiData" style="margin-top:5px;"></div>
	        	</div>
	        </div> 		    
	  	</div>	 
	</section>

	<!-- Form input data -->
	<div class="modal modal-default fade" id="form-input" role="dialog" aria-hidden="true" style="display:none;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Judul</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
			            <label class="control-label" for="txtNama">User</label>
			            <input type="text" class="form-control" id="txtNama" value="<?=$nama;?>" readonly/>
			            <input type="hidden" class="form-control" id="txtNIK" value="<?=$nik;?>" readonly/>
			            <input type="hidden" class="form-control" id="txtKode" readonly/>
			        </div>
					<div class="form-group">
						<label class="control-label" for="cboLocation">Location</label>
						<select class="form-control select" id="cboLocation">							
							<?php		                      			
								foreach ($lokasi as $kode => $nama) {
									echo "<option value='$kode'>$nama</option>";
								}
							?>
						</select>
					</div>
					<div class="form-group">
						<label class="control-label" for="cboCategory">Category</label>
						<select class="form-control select" id="cboCategory">							
							<?php		                      			
								foreach ($kategori as $kode => $nama) {
									echo "<option value='$kode'>$nama</option>";
								}
							?>
						</select>
					</div>
					<div class="form-group">
			            <label class="control-label" for="txtDescription">Description</label>
						<textarea class="form-control" id="txtDescription" cols="30" rows="3"></textarea>
			        </div>
                    <div class="form-group">
			            <label class="control-label" for="cboPriority">Priority</label>
			            <select class="form-control select" id="cboPriority">
                            <option value="1">Low</option>
                            <option value="2">Medium</option>
							<option value="3">High</option>
                        </select>
			        </div>
				</div>
				<div class="modal-footer">					
					<button type="button" class="btn btn-info btn-flat" id="btnSimpan"><i class="fa fa-sm fa-save"></i> Submit</button>
					<button type="button" class="btn btn-warning btn-flat" data-dismiss="modal"><i class="fa fa-sm fa-mail-reply"></i> Cancel</button>
				</div>
			</div>
		</div>
	</div>	
	<!-- end form input data -->

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
				        <label class="control-label">Are sure want to delete this data...?</label>
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