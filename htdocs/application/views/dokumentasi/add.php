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
			Add Dokumen
			<!-- <small>Version 2.0</small> -->
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-edit"></i> Dokumentasi</a></li>
			<li><a href="<?=base_url();?>seleksi"> Upload Dokumen</a></li>
			<li class="active">Add Dokumen</li>
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
				<form role="form" id="form-input" action="<?=base_url();?>dokumentasi/simpan" method="post" enctype="multipart/form-data">
					<div class="col-md-12 col-sm-12 border">
						<div class="form-group">
							<label class="control-label" for="cboCompany">Company :</label>
							<select class="form-control select2" id="cboCompany" name="cboCompany" required>
								<option value="">--Pilih--</option>
								<option value="LSA">LSA</option>
								<option value="SCM">SCM</option>
								<option value="PCS">PCS</option>
							</select>
						</div>
						<div class="form-group">
							<label class="control-label" for="cboKategori">Kategori :</label>
							<select class="form-control select2" name="cboKategori" id="cboKategori" required>
								<option value="">--Pilih--</option>
								<?php		                      			
									foreach ($kategori as $kode_kategori => $nama_kategori) {
										echo "<option value='$kode_kategori'>$nama_kategori</option>";
									}
								?>
							</select>                        
						</div>
						<div class="form-group">
							<label class="control-label" for="cboKelompok">Kelompok :</label>
							<select class="form-control select2" name="cboKelompok" id="cboKelompok" required>
								<option value="">--Pilih--</option>
								<?php		                      			
									foreach ($kelompok as $kode_kelompok => $nama_kelompok) {
										echo "<option value='$kode_kelompok'>$nama_kelompok</option>";
									}
								?>
							</select>                        
						</div>
						<div class="form-group">
							<label class="control-label" for="txtNoDok">No. Dokumen :</label>
							<input type="text" class="form-control" id="txtNoDok" name="txtNoDok" required />
						</div>
						<div class="form-group">
							<label class="control-label" for="txtNamaDok">Nama Dokumen :</label>
							<input type="text" class="form-control" id="txtNamaDok" name="txtNamaDok" required />
						</div>
						<div class="form-group">
							<label class="control-label" for="txtPJ">Penanggung Jawab :</label>
							<div class="input-group">
								<div class="input-group-btn">
									<button title="Pilih Karyawan" type="button" class="btn btn-warning btn-flat" id="btnBrowseKaryawan"><i class="fa fa-user"></i></button>
								</div>
								<input type="text" class="form-control" id="txtNama" name="txtNama" required readonly>
								<input type="hidden" class="form-control" id="txtNIKKaryawan" name="txtNIKKaryawan" readonly />								
							</div>						
						</div>						
						<div class="form-group">
							<label class="control-label" for="txtTglBuat">Tgl Pembuatan :</label>
							<div class="input-group">						
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input type="text" class="form-control input-sm- datepicker" id="txtTglBuat" name="txtTglBuat" required/>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label" for="txtJmlRevisi">Revisi :</label>
							<input type="number" class="form-control" id="txtJmlRevisi" name="txtJmlRevisi" value="0" />
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
											<input type="text" class="form-control input-sm- datepicker" id="tgl_revisi_1" name="tgl_revisi_1" />
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
											<input type="text" class="form-control input-sm- datepicker" id="tgl_revisi_2" name="tgl_revisi_2" />
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
											<input type="text" class="form-control input-sm- datepicker" id="tgl_revisi_3" name="tgl_revisi_3" />
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
											<input type="text" class="form-control input-sm- datepicker" id="tgl_revisi_4" name="tgl_revisi_4" />
										</div>
									</td>								
								</tr>							
							</table>                        
						</div>						
						<div class="form-group">
							<label class="control-label" for="txtKet">Keterangan :</label>
							<textarea class="form-control" name="txtKet" id="txtKet" rows="5"></textarea>							
						</div>
						<div class="form-group">
				            <label class="control-label" for="file_dokumen">File Dokumen :</label>
				            <input type="file" class="form-control" id="file_dokumen" name="file_dokumen"/>
				            <?php
						        if($this->session->flashdata('error_file') != ''){
						          echo '
						          <div class="row-fluid">
						                <div class="span12 alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>'.$this->session->flashdata('error_file').'</div>
						              </div>';
						        }
						    ?>			            
				        </div>
						<div class="form-group">
							<label class="control-label" for="cboStatus">Status :</label>
							<select class="form-control select2" id="cboStatus" name="cboStatus" required>								
								<option value="O">OPEN</option>
								<option value="D">DRAFT</option>
								<option value="P">PROGRESS</option>
								<option value="C">OK</option>
							</select>							
						</div>
						<div class="form-group">					
							<!-- <button type="button" class="btn btn-info btn-flat" id="btnSimpan"><i class="fa fa-sm fa-save"></i> Simpan</button> -->
							<input type="submit" class="btn btn-info btn-flat" name="submit" value="Upload" />
							<button type="button" class="btn btn-warning btn-flat" id="btnBatal"><i class="fa fa-sm fa-mail-reply"></i> Batal</button>
						</div>					
					</div>
				</form>		        	
	        </div> 		    
	  	</div>	 
	</section>	
    
    <!-- form show karyawan -->
	<div class="modal fade" id="form-show-karyawan" role="dialog" aria-hidden="true" style="display:none;">
		<div class="modal-dialog" style="width:800px;">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Judul</h4>
				</div>
				<div class="modal-body">
					<div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nama Karyawan :</label>
                                <div class="input-group" style="width:100%;">
                                    <div class="input-group-addon">
                                        <i class="fa fa-search"></i>
                                    </div>
                                    <input type="text" class="form-control" id="txtCariKaryawan" style="width:100%;" placeholder="Cari Nama..." />
                                </div>                          
                            </div>
                        </div>
                    </div>
					<div class="table-responsive">
                        <div id="isiDataKaryawan" style="margin-top:5px;"></div>
                    </div>									    
				</div>
				<div class="modal-footer">					
					<button type="button" class="btn btn-warning btn-flat" data-dismiss="modal"><i class="fa fa-sm fa-mail-reply"></i> Batal</button>
				</div>
			</div>
		</div>
	</div>
	<!-- end form show karyawan -->    

</div>