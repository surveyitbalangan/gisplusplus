<script type="text/javascript">
	$(window).on("load", function() {
		// $('#txtNama').focus();
		
		load_data();		

		$('#btnTampil').click(function(){
            $('#tgl1').val('');
            $('#tgl2').val('');
            $('#cboStatus').val('');
            load_data();
		})

		$('#btnPrint').click(function() {
			window.print();
        })
        
        $('#tgl1,#tgl2,#cboStatus').change(function(){
            load_data();
        })

		function load_data(){
            var tgl1    = $('#tgl1').val();
            var tgl2    = $('#tgl2').val();
            var status  = $('#cboStatus').val();
            var custom  = $('#txtCari').val();
            // alert(tgl1+' - '+tgl2+' - '+status);
			$.ajax({
				type : 'POST',
				url  : '<?=base_url();?>allTicket/load_data',
				data : {'status':status,'tgl1':tgl1,'tgl2':tgl2,'custom':custom},
				cache: false,
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
			}else{
				load_data();
			}
		})		

	})
</script>
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			All Ticketing History
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-pie-chart"></i> Report</a></li>
			<li class="active">All Ticketing</li>
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
                <div class="row">
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="control-label" for="tgl1">From</label>                        
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control input-sm datepicker" id="tgl1" />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="control-label" for="tgl1">To</label>                        
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control input-sm datepicker" id="tgl2" />
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-2">
                        <div class="form-group">
                            <label class="control-label" for="cboStatus">Status</label>
                            <select class="form-control input-sm" id="cboStatus">							
                                <option value="">--Choose--</option>
                                <option value="1">OPEN</option>
                                <option value="2">PROGRESS</option>
                                <option value="3">PENDING</option>
                                <option value="4">CLOSED</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <div class="form-group has-feedback">
                            <label class="control-label" for="txtCari" style="color:#fff-;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Custom Search</label>
                            <!-- <button class="btn btn-sm btn-default pull-right"><i class="fa fa-search"></i></button> -->
                            <input type="text" id="txtCari" class="form-control input-sm pull-right" style="width:230px;" placeholder="Search by description..."/>
                            <span class="fa fa-search form-control-feedback"></span>
                        </div>
                    </div>
                </div>                
                <div class="row">
                    <div class="col-sm-12">                        
                        <button class="btn btn-sm- btn-success btn-flat" id="btnTampil"><i class="fa fa-refresh"></i> Refresh</button>
                        <button class="btn btn-sm- btn-warning btn-flat" id="btnPrint"><i class="fa fa-print"></i> Print Preview</button>
                    </div>                    
                </div>
	        	<div>
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
</div>