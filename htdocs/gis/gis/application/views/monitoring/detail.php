<script type="text/javascript">
	$(window).on("load", function() {
		var hit_timer;
		var status_tiket = $('#txtStatus').val();
		// var cate_id 	 = $('#txtCateID').val();

		if(status_tiket==1){
			setTimer();
		}else{
			stopTimer();
		}		

		$('#txtSolution').focus();		

		$('#btnEdit').click(function() {
			edit();
		})

		$('#btnBack').click(function() {
			window.location.replace('/helpdesk/monitoring');
		})

		function setTimer(){
			hit_timer = setInterval(function(){
				getRealTime('#txtRespontime');
			},1000);
		}
		function stopTimer(){
			clearTimeout(hit_timer);
		}

		function getRealTime(isi){            
			$.ajax({
				url : "<?=base_url();?>monitoring/getTimeServer",
				type: "GET",
				success:function(data){
					// alert(data);
					$(isi).val(data);
				}
			});                        
		}

		// $('#txtCateID').change(function(){
		$(function () {
            var id_kategori = $('#txtCateID').val();//$(this).val();
			var sub_id_kategori = $('#txtSubCateID').val();
			// alert(id_kategori);
            $.ajax({
                url     : '<?=base_url()?>monitoring/show_sub_kategori',
                type    : 'POST',
                data    : {"id_kategori":id_kategori},
                success : function(hasil){
                    $('#cboSubCategory').empty();
                    $.each(hasil, function(id,obj){
						if(obj.kode==sub_id_kategori){
							// alert(obj.kode);
							$('#cboSubCategory').append('<option value='+obj.kode+' selected>'+obj.nama+'</option>');
						}else{
							$('#cboSubCategory').append('<option value='+obj.kode+'>'+obj.nama+'</option>');
						}
                    })
                }
            })
        })

		function edit(){
			var kode 	 	= $('#txtKode').val();
			var PIC 	 	= $('#cboPIC').val();
            var solusi 		= $('#txtSolution').val();
			var status 		= $('#cboStatus').val();
			var note 		= $('#txtNote').val();
			var respontime 	= $('#txtRespontime').val();
			var subkategori = $('#cboSubCategory').val();

            if (PIC.length==0) {
				alert('PIC IT belum dipilih !!!');
				$('#cboPIC').focus();
				return false;
			}
			if(status=='4'){
				if (solusi.length==0) {
					alert('Solusi belum diisi !!!');
					$('#txtSolution').focus();
					return false;
				}
			}
			if(subkategori.length==0){
				alert('Sub kategori belum dipilih !!!');
				$('#cboSubCategory').focus();
			}
			if (status.length==0) {
				alert('Status belum dipilih !!!');
				$('#cboStatus').focus();
				return false;
			}

			$.ajax({
				type : 'POST',
				url  : '<?=base_url()?>monitoring/edit',
				data : {"no":kode,"pic":PIC,"solusi":solusi,"status":status,"note":note,
						"respontime":respontime,"subkategori":subkategori},
				cache: false,
				success : function(result){
                    // alert(result);	
					if (result=='edit_ok') {
						// swal('Information','Update success','success');
						var judul = 'Information';
						var pesan = 'Update success';
						var tipe  = 'success';
					}else if(result=='edit_no'){
						// swal('Oops..','Update failed','warning');
						var judul = 'Oops...';
						var pesan = 'Update failed';
						var tipe  = 'warning';
					}
					message(judul,pesan,tipe);
				},
				error : function(event, textStatus, errorThrown){
					alert('Pesan kesalahan : '+ textStatus + ' , HTTP Error : '+errorThrown);
				}
			})
		}

		function message(judul,pesan,tipe) {
		    swal({
				title: judul,
				text: pesan,
				type: tipe,
				showCancelButton: false,
				// confirmButtonColor: "#DD6B55",
				confirmButtonText: "OK",
				closeOnConfirm: false
		    },
		    function(isConfirm){
		    	// window.history.go(-1);
		    	window.location.replace('/helpdesk/monitoring');		      
		    });
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
				<?php foreach ($data->result_array() as $isi) { ?>
				<div class="col-md-6 col-sm-12 col-xs-12">
					<div class="form-group">
						<label class="control-label" for="txtTicketNo">Ticket Number</label>
						<input type="text" class="form-control" id="txtKode" value="<?=$isi['TIC_NO'];?>" readonly/>
					</div>
					<div class="form-group">
						<label class="control-label" for="txtNama">User</label>
						<input type="text" class="form-control" id="txtNama" value="<?=$isi['USER'];?>" readonly/>
						<input type="hidden" class="form-control" id="txtNIK" value="<?=$isi['TIC_NIK'];?>" readonly/>						
						<input type="hidden" class="form-control" id="txtStatus" value="<?=$isi['TIC_STATUS'];?>" readonly/>
					</div>
					<div class="form-group">
						<label class="control-label" for="txtLocation">Location</label>
						<input type="text" class="form-control" id="txtLocation" value="<?=$isi['LOC_NAME'];?>" readonly/>						
					</div>
					<div class="form-group">
						<label class="control-label" for="txtCategory">Category</label>
						<input type="text" class="form-control" id="txtCategory" value="<?=$isi['CATE_NAME'];?>" readonly/>
						<input type="hidden" class="form-control" id="txtCateID" value="<?=$isi['TIC_CATEGORY_ID'];?>" readonly/>
					</div>
					<div class="form-group">
				 		<label class="control-label" for="txtDescription">Description</label>
						<textarea class="form-control" id="txtDescription" cols="30" rows="2" readonly><?=$isi['TIC_DESCRIPTION'];?></textarea>
					</div>
					<label class="control-label" for="txtPriority">Priority</label>
					<div class="input-group input-group-sm">
						<input type="text" class="form-control" value="<?=$isi['PRIORITY_DESC'];?>" readonly>
						<?php
							if($isi['TIC_PRIORITY']==1){
								$warna = 'btn-success';
							}else if($isi['TIC_PRIORITY']==2){
								$warna = 'btn-warning';
							}else if($isi['TIC_PRIORITY']==3){
								$warna = 'btn-danger';
							}
						?>
						<span class="input-group-btn">
							<button class="btn <?=$warna?> btn-flat" type="button"><i class="fa fa-clock-o"></i></button>
						</span>
					</div><br>
					<form class="form-inline">
						<label class="control-label" for="txtDowntime">Downtime</label>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<label class="control-label" for="txtRespontime">Respontime</label>
					</form>
					<form class="form-inline">
						<div class="form-group">						
							<input type="text" class="form-control tulisan-besar tengah" id="txtDowntime" value="<?=$isi['TIC_DATE'];?>" readonly/>						
						</div>					
						<div class="form-group">						
							<input type="text" class="form-control tulisan-besar tulisan-merah tengah" id="txtRespontime" value="<?=$isi['TIC_RESPONTIME'];?>" readonly/>						
						</div>						
					</form>
					<!-- <div class="col-md-4 col-sm-12 col-xs-12">
						<div class="form-group">						
							<label class="control-label" for="txtClosetime">Closetime</label>
							<input type="text" class="form-control" id="txtClosetime" readonly/>						
						</div>
					</div> -->
				</div>
				<div class="col-md-6 col-sm-12 col-xs-12">					
					<div class="form-group">
						<label class="control-label" for="cboPIC">PIC IT</label>
						<select class="form-control select2" id="cboPIC">							
							<?php		                      			
								foreach ($pic as $kode => $nama) {
									echo "<option value='$kode'>$nama</option>";
								}
							?>
						</select>
					</div>
					<div class="form-group">
						<label class="control-label" for="txtSubCategory">Sub Category</label>
						<select class="form-control select2" id="cboSubCategory">
							<option value="">--Choose--</option>
							<?php		                      			
								// foreach ($sub_kategori as $kode => $nama) {
								// 	echo "<option value='$kode'>$nama</option>";
								// }
							?>
						</select>
						<input type="hidden" class="form-control" id="txtSubCateID" value="<?=$isi['TIC_SUBCATE_ID'];?>" readonly/>
					</div>
					<div class="form-group">
						<label class="control-label" for="txtSolution">Solution</label>
						<textarea class="form-control" id="txtSolution" cols="30" rows="2"></textarea>
					</div>
					<div class="form-group">						
						<label class="control-label" for="cboStatus">Status</label>
						<select class="form-control select2" id="cboStatus">
							<option value="">--Choose--</option>
							<option value="2">PROGRESS</option>
							<option value="3">PENDING</option>
							<option value="4">CLOSED</option>
							<?php
								// if($isi['TIC_STATUS']==1){
								// 	?>
								<!-- // 	<option value="2" selected>PROGRESS</option>
								// 	<option value="3">PENDING</option>
								// 	<option value="4">CLOSED</option> -->
								 	<?php
								// }else if($isi['TIC_STATUS']==2){
								 	?>
								<!-- // 	<option value="2">PROGRESS</option>
								// 	<option value="3">PENDING</option>
								// 	<option value="4" selected>CLOSED</option> -->
								 	<?								
								// }else if($isi['TIC_STATUS']==3){
								// 	?>
								<!-- // 	<option value="2">PROGRESS</option>
								// 	<option value="3" selected>PENDING</option>
								// 	<option value="4">CLOSED</option> -->
								 	<?php
								// }else if($isi['TIC_STATUS']==4){
								// 	?>
								<!-- // 	<option value="2">PROGRESS</option>
								// 	<option value="3">PENDING</option>
								// 	<option value="4" selected>CLOSED</option> -->
								 	<?php
								// }
							?>							
						</select>
					</div>
					<div class="form-group">
						<label class="control-label" for="txtNote">Note</label>
						<textarea class="form-control" id="txtNote" cols="30" rows="2"></textarea>
					</div>
				<div>
				<?php } ?>							
	        </div>
			<div class="form-group">					
				<button type="button" class="btn btn-info btn-flat" id="btnEdit"><i class="fa fa-sm fa-save"></i> Save</button>
				<button type="button" class="btn btn-warning btn-flat" id="btnBack"><i class="fa fa-sm fa-mail-reply"></i> Back</button>
			</div>		
	  	</div>		  	
	</section>
	
</div>