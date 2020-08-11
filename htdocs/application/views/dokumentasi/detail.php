<style>
	table{
		padding: 5px!important;
		border: 1px solid #ddd;
		width:100%;
	}	
	tr,td{
		border: 1px solid #ddd;
		padding:3px;
	}
	th{
		border: 1px solid #ddd;
		padding:15px 8px 15px 8px!important;
	}
</style>
<script type="text/javascript">
    $(window).on("load", function() {
        // alert('Halaman Siap');
        load_view_karyawan('');

        $('#btnBatal').click(function(){
            window.history.go(-1);
        })		

        $('#btnBrowseKaryawan').click(function(){
			$('.modal-title').html("Data Karyawan");	
			$('#form-show-karyawan').modal({
				show: true,
				keyboard:false,
				backdrop:false
			})
		})

        $('#txtCariKaryawan').keyup(function(){
			var isi = $(this).val();
			load_view_karyawan(isi);                   
		})

        function load_view_karyawan(cari){
			var url  = "<?=base_url();?>dokumentasi/load_data_karyawan";              
			
			$.ajax({
				type    : "POST",
				url     : url,
				data    : {"cari":cari},
				cache   : false,
				beforeSend: function() {
					// Display_Load();
				},
				success : function(result){
					// alert(result);
					$('#isiDataKaryawan').animate({ opacity: "show" }, "slow");
					$('#isiDataKaryawan').html(result);
					
					// Hide_Load();
				},
				error:function(event, textStatus, errorThrown) {
					alert('Pesan kesalahan : '+ textStatus + ' , HTTP Error : '+errorThrown);
				},        
				complete: function() {
					// Hide_Load();
				}
			})
		}        

		$('#btnSimpan').click(function(){
			// simpan();
		})

		function simpan(){
			var id_seleksi 			= $('#txtIdSeleksi').val();
			var tgl_seleksi 		= $('#tgl_apply').val();
			var id_pelamar 			= $('#txtIdPelamar').val();
			var id_vacant 			= $('#txtIdVacant').val();
			var seleksi_berkas 		= $('#tgl_seleksi_berkas').val();
			var st_seleksi_berkas 	= $('#cboStatus_seleksi_berkas').val();
			var interview_1 		= $('#tgl_interview_1').val();
			var st_interview_1 		= $('#cboStatus_interview_1').val();
			var psikotes 			= $('#tgl_psikotes').val();
			var st_psikotes 		= $('#cboStatus_psikotes').val();
			var interview_2 		= $('#tgl_interview_2').val();
			var st_interview_2 		= $('#cboStatus_interview_2').val();
			var mcu 				= $('#tgl_mcu').val();
			var st_mcu 				= $('#cboStatus_mcu').val();
			var nego 				= $('#tgl_nego').val();
			var st_nego 			= $('#cboStatus_nego').val();

			var url  				= "<?=base_url();?>dokumentasi/simpan"; 

			if (id_pelamar.length==0) {
				alert('Pelamar tidak boleh kosong !!!');
				$('#btnBrowsePelamar').focus();
				return false;
			}  
			if (id_vacant.length==0) {
				alert('Lowongan belum dipilih !!!');
				$('#btnBrowseLowongan').focus();
				return false;
			}         
			
			$.ajax({
				type    : "POST",
				url     : url,
				data    : {"id_seleksi":id_seleksi,"tgl_seleksi":tgl_seleksi,"id_pelamar":id_pelamar,
						   "id_vacant":id_vacant,"seleksi_berkas":seleksi_berkas,"st_seleksi_berkas":st_seleksi_berkas,
						   "interview_1":interview_1,"st_interview_1":st_interview_1,"psikotes":psikotes,
						   "st_psikotes":st_psikotes,"interview_2":interview_2,"mcu":mcu,"st_mcu":st_mcu,
						   "nego":nego,"st_nego":st_nego},
				cache   : false,
				beforeSend: function() {
					NProgress.start();
				},
				success : function(result){
					// alert(result);
					if (result=='simpan_ok'){
						message('Informasi','Data berhasil disimpan','success');
					}else if (result=='simpan_no'){
						message('Oops..','Data gagal disimpan','warning');
					}
					// window.location.replace('/rekrutmen/seleksi');
					
				},
				error:function(event, textStatus, errorThrown) {
					alert('Pesan kesalahan : '+ textStatus + ' , HTTP Error : '+errorThrown);
				},        
				complete: function() {
					NProgress.done();
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
		    	window.location.replace('/edoc/dokumentasi');		      
		    });
		}
    })			
</script>

<div class="content-wrapper">

	<section class="content-header">
		<h1>
			Detail Dokumen
			<!-- <small>Version 2.0</small> -->
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-edit"></i> Dokumentasi</a></li>
			<li><a href="<?=base_url();?>seleksi"> Upload Dokumen</a></li>
			<li class="active">Detail Dokumen</li>
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
				<?php foreach ($data->result_array() as $isi) { ?>
					<div class="col-md-12 col-sm-12 border">
						<div class="form-group">
							<label class="control-label" for="cboCompany">Company :</label>
							<input type="text" class="form-control" id="txtNoDok" value="<?=$isi['COMPANY'];?>" readonly />
						</div>
						<div class="form-group">
							<label class="control-label" for="cboKategori">Kategori :</label>
							<input type="text" class="form-control" id="cboKategori" value="<?=$isi['KATEGORI'];?>" readonly />
						</div>
						<div class="form-group">
							<label class="control-label" for="cboKelompok">Kelompok :</label>
							<input type="text" class="form-control" id="cboKategori" value="<?=$isi['KELOMPOK'];?>" readonly />							                       
						</div>
						<div class="form-group">
							<label class="control-label" for="txtNoDok">No. Dokumen :</label>
							<input type="text" class="form-control" id="txtNoDok" value="<?=$isi['NO_DOKUMEN'];?>" readonly />
						</div>
						<div class="form-group">
							<label class="control-label" for="txtNamaDok">Nama Dokumen :</label>
							<input type="text" class="form-control" id="txtNamaDok" value="<?=$isi['NAMA_DOKUMEN'];?>" readonly />
						</div>
						<div class="form-group">
							<label class="control-label" for="txtPJ">Penanggung Jawab :</label>
							<input type="text" class="form-control" id="txtNamaDok" value="<?=$isi['PENANGGUNG_JAWAB'];?>" readonly />
						</div>						
						<div class="form-group">
							<label class="control-label" for="txtTglBuat">Tgl Pembuatan :</label>
							<input type="text" class="form-control" id="txtNamaDok" value="<?=$isi['TGL_BUAT'];?>" readonly />							
						</div>
						<div class="form-group">
							<label class="control-label" for="txtJmlRevisi">Revisi :</label>
							<input type="number" class="form-control" id="txtJmlRevisi" value="<?=$isi['JML_REVISI'];?>" readonly />
						</div>						             
						<div class="form-group">
							<table>
								<tr>
									<th width="1%">No.</th>
									<th>Revisi</th>
									<th>Tanggal</th>
								</tr>
								<tr>
									<td align="center">1.</td>
									<td>Revisi 1</td>
									<td>
										<div class="input-group">
											<div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											</div>
											<input type="text" class="form-control input-sm-" id="tgl_revisi_1" value="<?=$isi['TGL_REVISI_1'];?>" readonly/>
										</div>
									</td>								
								</tr>
								<tr>
									<td align="center">2.</td>
									<td>Revisi 2</td>
									<td>
										<div class="input-group">
											<div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											</div>
											<input type="text" class="form-control input-sm-" id="tgl_revisi_2" value="<?=$isi['TGL_REVISI_2'];?>" readonly/>
										</div>
									</td>								
								</tr>
								<tr>
									<td align="center">3.</td>
									<td>Revisi 3</td>
									<td>
										<div class="input-group">
											<div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											</div>
											<input type="text" class="form-control input-sm-" id="tgl_revisi_3" value="<?=$isi['TGL_REVISI_3'];?>" readonly/>
										</div>
									</td>								
								</tr>
								<tr>
									<td align="center">4.</td>
									<td>Revisi 4</td>
									<td>
										<div class="input-group">
											<div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											</div>
											<input type="text" class="form-control input-sm-" id="tgl_revisi_4" value="<?=$isi['TGL_REVISI_4'];?>" readonly/>
										</div>
									</td>								
								</tr>							
							</table>                        
						</div>						
						<div class="form-group">
							<label class="control-label" for="txtKet">Keterangan :</label>
							<textarea class="form-control" name="txtKet" id="txtKet" rows="5" readonly><?=$isi['KETERANGAN'];?></textarea>							
						</div>
						<div class="form-group">
				            <label class="control-label" for="txtFile">File Dokumen :</label>
							<?php
								if($isi['FILE_DOKUMEN']!='no-file.png'){
									?>
									<img src="<?=base_url();?>asset/images/pdf.png" width="30px" height="30px">&nbsp;&nbsp;&nbsp;	<a href="<?=base_url();?>asset/file_dokumen/<?=$isi['FILE_DOKUMEN'];?>" target="_blank"><?=$isi['FILE_DOKUMEN'];?></a>
									<?php
								}else{
									echo '<font color="red">no file found</font>';
								}
							?>				            
				        </div>
						<div class="form-group">
							<label class="control-label" for="cboStatus">Status :</label>
							<input type="text" class="form-control" id="cboStatus" value="<?=$isi['STATUS_DESC'];?>" readonly/>														
						</div>
						
						<div class="form-group">					
							<!-- <button type="button" class="btn btn-info btn-flat" id="btnSimpan"><i class="fa fa-sm fa-save"></i> Update</button> -->
							<button type="button" class="btn btn-warning btn-flat" id="btnBatal"><i class="fa fa-sm fa-mail-reply"></i> Batal</button>
						</div>					
					</div>
				<?php } ?>		        	
	        </div> 		    
	  	</div>	 
	</section>            

</div>