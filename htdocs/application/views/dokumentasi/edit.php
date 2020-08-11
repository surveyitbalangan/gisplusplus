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
		
    })			
</script>

<div class="content-wrapper">

	<section class="content-header">
		<h1>
			Edit Dokumen
			<!-- <small>Version 2.0</small> -->
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-edit"></i> Dokumentasi</a></li>
			<li><a href="<?=base_url();?>seleksi"> Upload Dokumen</a></li>
			<li class="active">Edit Dokumen</li>
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
				<form role="form" id="form-input" action="<?=base_url();?>dokumentasi/edit" method="post" enctype="multipart/form-data">
					<?php foreach ($data->result_array() as $isi) { ?>
					<div class="col-md-12 col-sm-12 border">
						<div class="form-group">
							<label class="control-label" for="cboCompany">Company :</label>
							<select class="form-control select2" id="cboCompany" name="cboCompany" required>
								<?php
									if($isi['COMPANY']=='LSA'){
										?>
										<option value="LSA" selected>LSA</option>
										<option value="SCM">SCM</option>
										<option value="PCS">PCS</option>
										<?php
									}else if($isi['COMPANY']=='SCM'){
										?>
										<option value="LSA">LSA</option>
										<option value="SCM" selected>SCM</option>
										<option value="PCS">PCS</option>
										<?php
									}else{
										?>
										<option value="LSA">LSA</option>
										<option value="SCM">SCM</option>
										<option value="PCS" selected>PCS</option>
										<?php
									}
								?>
							</select>
							<input type="hidden" class="form-control" id="txtIdDokumen" name="txtIdDokumen" value="<?=$isi['ID'];?>" required readonly />
						</div>
						<div class="form-group">
							<label class="control-label" for="cboKategori">Kategori :</label>
							<select class="form-control select2" name="cboKategori" id="cboKategori" required>
								<option value="">--Pilih--</option>
								<?php		                      			
									foreach ($kategori as $kode_kategori => $nama_kategori) {
										if($isi['ID_KATEGORI']==$kode_kategori){
											echo "<option value='$kode_kategori' selected>$nama_kategori</option>";
										}else{
											echo "<option value='$kode_kategori'>$nama_kategori</option>";
										}										
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
										if($isi['ID_KELOMPOK']==$kode_kelompok){
											echo "<option value='$kode_kelompok' selected>$nama_kelompok</option>";
										}else{
											echo "<option value='$kode_kelompok'>$nama_kelompok</option>";
										}										
									}
								?>
							</select>                        
						</div>
						<div class="form-group">
							<label class="control-label" for="txtNoDok">No. Dokumen :</label>
							<input type="text" class="form-control" id="txtNoDok" name="txtNoDok" value="<?=$isi['NO_DOKUMEN'];?>" required/>
						</div>
						<div class="form-group">
							<label class="control-label" for="txtNamaDok">Nama Dokumen :</label>
							<input type="text" class="form-control" id="txtNamaDok" name="txtNamaDok" value="<?=$isi['NAMA_DOKUMEN'];?>" required/>
						</div>
						<div class="form-group">
							<label class="control-label" for="txtPJ">Penanggung Jawab :</label>
							<div class="input-group">
								<div class="input-group-btn">
									<button title="Pilih Karyawan" type="button" class="btn btn-warning btn-flat" id="btnBrowseKaryawan"><i class="fa fa-user"></i></button>
								</div>
								<input type="text" class="form-control" id="txtNama" name="txtNama" value="<?=$isi['PENANGGUNG_JAWAB'];?>" required readonly>
								<!-- <input type="hidden" class="form-control" id="txtNIKKaryawan" name="txtNIKKaryawan" readonly /> -->
							</div>						
						</div>						
						<div class="form-group">
							<label class="control-label" for="txtTglBuat">Tgl Pembuatan :</label>
							<div class="input-group">						
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input type="text" class="form-control input-sm- datepicker" id="txtTglBuat" name="txtTglBuat" value="<?=$isi['TGL_BUAT'];?>" required/>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label" for="txtJmlRevisi">Revisi :</label>
							<input type="number" class="form-control" id="txtJmlRevisi" name="txtJmlRevisi" value="<?=$isi['JML_REVISI'];?>" />
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
											<input type="text" class="form-control input-sm- datepicker" id="tgl_revisi_1" name="tgl_revisi_1" value="<?=$isi['TGL_REVISI_1'];?>"/>
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
											<input type="text" class="form-control input-sm- datepicker" id="tgl_revisi_2" name="tgl_revisi_2" value="<?=$isi['TGL_REVISI_2'];?>"/>
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
											<input type="text" class="form-control input-sm- datepicker" id="tgl_revisi_3" name="tgl_revisi_3" value="<?=$isi['TGL_REVISI_3'];?>"/>
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
											<input type="text" class="form-control input-sm- datepicker" id="tgl_revisi_4" name="tgl_revisi_4" value="<?=$isi['TGL_REVISI_4'];?>"/>
										</div>
									</td>								
								</tr>							
							</table>                        
						</div>						
						<div class="form-group">
							<label class="control-label" for="txtKet">Keterangan :</label>
							<textarea class="form-control" name="txtKet" id="txtKet" rows="5"><?=$isi['KETERANGAN'];?></textarea>							
						</div>
						<div class="form-group">
				            <label class="control-label" for="foto_gallery">File Dokumen :</label>
							<?php
								if($isi['FILE_DOKUMEN']!='no-file.png'){
									?>
									<img src="<?=base_url();?>asset/images/pdf.png" width="30px" height="30px">&nbsp;&nbsp;&nbsp;	<a href="<?=base_url();?>asset/file_dokumen/<?=$isi['FILE_DOKUMEN'];?>" target="_blank"><?=$isi['FILE_DOKUMEN'];?></a>
									<?php
								}else{
									echo '<font color="red">no file found</font>';
								}
							?>
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
								<?php
									if($isi['STATUS']=='O'){
										?>
										<option value="O" selected>OPEN</option>
										<option value="D">DRAFT</option>
										<option value="P">PROGRESS</option>
										<option value="C">OK</option>
										<?php
									}else if($isi['STATUS']=='D'){
										?>
										<option value="O">OPEN</option>
										<option value="D" selected>DRAFT</option>
										<option value="P">PROGRESS</option>
										<option value="C">OK</option>
										<?php
									}else if($isi['STATUS']=='P'){
										?>
										<option value="O">OPEN</option>
										<option value="D">DRAFT</option>
										<option value="P" selected>PROGRESS</option>
										<option value="C">OK</option>
										<?php
									}else if($isi['STATUS']=='C'){
										?>
										<option value="O">OPEN</option>
										<option value="D">DRAFT</option>
										<option value="P">PROGRESS</option>
										<option value="C" selected>OK</option>
										<?php
									}
								?>								
							</select>							
						</div>
						
						<div class="form-group">					
							<!-- <button type="button" class="btn btn-info btn-flat" id="btnSimpan"><i class="fa fa-sm fa-save"></i> Update</button> -->
							<input type="submit" class="btn btn-info btn-flat" name="submit" value="Update" />
							<button type="button" class="btn btn-warning btn-flat" id="btnBatal"><i class="fa fa-sm fa-mail-reply"></i> Batal</button>
						</div>					
					</div>
					<?php } ?>
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