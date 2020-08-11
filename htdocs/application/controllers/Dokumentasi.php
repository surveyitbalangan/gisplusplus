<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dokumentasi extends CI_Controller {

    function __construct(){
        parent::__construct();
    }

    function index(){
		// $cek = $this->session->userdata('login_intranet_sukses');
		if(!empty($cek)){
			$d['judul']		= $this->config->item('lisensi_app');
			$d['perusahaan']= $this->config->item('nama_perusahaan');
			$d['footer'] 	= $this->config->item('copyright');
			$d['app_name'] 	= $this->config->item('app_name');
			$d['deskripsi'] = $this->config->item('app_fullname');
			// $d['open_tic']  = $this->app_model->getTotNewTicket();
			// $d['lokasi'] 	= $this->app_model->getLocation();
			// $d['kategori'] 	= $this->app_model->getCategory();		

			$d['nik']		= $this->session->userdata('nik_intranet');
			$d['level'] 	= $this->session->userdata('level');	
			$d['nama'] 		= $this->session->userdata('nama_intranet');
			$d['jabatan']	= $this->session->userdata('nama_jabatan_intranet');

			$this->template->display('dokumentasi/home',$d);
		}else{
			?>
				<script type="text/javascript">
					alert('Maaf, Session anda telah habis. Silakan login ulang');
					window.location.replace('/intranet');
				</script>
			<?
		}
    }

    function load_data(){
        $cari = $this->input->post("cari");
        
		$sql = "";
		$sql .= "SELECT * FROM vw_dokumentasi A0
				 WHERE ID IS NOT NULL";
		if ($cari!='') {
			$sql .= " AND A0.NAMA_DOKUMEN like '%$cari%'";
		}
		$sql .=" ORDER BY A0.ID DESC";

		$d['data'] = $this->app_model->manualQuery($sql);
		$d['nik']  = $this->session->userdata('nik_intranet');
		$this->load->view('dokumentasi/load_data',$d);
	}

	function load_data_karyawan(){
		$cari 	= $this->input->post("cari");

		$sql 	= "";
		$sql	= "SELECT * FROM mybc.vw_employee
				   WHERE EMP_IS_ACTIVE = 1 AND EMP_NIK NOT IN('00100000')";
		if ($cari!='') {
			$sql .=" AND EMP_NAME LIKE '%$cari%'";
		}

		$d['data'] = $this->app_model->manualQuery($sql);
		$this->load->view('dokumentasi/load_karyawan',$d);
	}	

	function show_edit(){
		$cek = $this->session->userdata('login_intranet_sukses');
		if(!empty($cek)){
			$d['judul']			= $this->config->item('lisensi_app');
			$d['perusahaan']	= $this->config->item('nama_perusahaan');
			$d['footer'] 		= $this->config->item('copyright');
			$d['app_name'] 		= $this->config->item('app_name');
			$d['deskripsi'] 	= $this->config->item('app_fullname');
			$d['kategori'] 		= $this->app_model->getKategoriDokumen();
			$d['kelompok'] 		= $this->app_model->getKelompokDokumen();
            
			$d['level'] 		= $this->session->userdata('level');
			$d['nik']			= $this->session->userdata('nik_intranet');
			$d['nama'] 			= $this->session->userdata('nama_intranet');
			$d['jabatan']		= $this->session->userdata('nama_jabatan_intranet');
			
			$no = $this->uri->segment(3);
			$sql = "";
			$sql = "SELECT * FROM vw_dokumentasi A0
					WHERE ID = '$no'";		
			
			$d['data'] = $this->app_model->manualQuery($sql);

			$this->template->display('dokumentasi/edit',$d);
		}else{
			?>
				<script type="text/javascript">
					alert('Maaf, Session anda telah habis. Silakan login ulang');
					window.location.replace('/intranet');
				</script>
			<?
		}
	}

	function show_detail(){
		$cek = $this->session->userdata('login_intranet_sukses');
		if(!empty($cek)){
			$d['judul']		= $this->config->item('lisensi_app');
			$d['perusahaan']= $this->config->item('nama_perusahaan');
			$d['footer'] 	= $this->config->item('copyright');
			$d['app_name'] 	= $this->config->item('app_name');
			$d['deskripsi'] = $this->config->item('app_fullname');
			
			$d['level'] 	= $this->session->userdata('level');
			$d['nik']		= $this->session->userdata('nik_intranet');
			$d['nama'] 		= $this->session->userdata('nama_intranet');
			$d['jabatan']	= $this->session->userdata('nama_jabatan_intranet');
			
			$id = $this->uri->segment(3);
			
			$sql = "";
			$sql = "SELECT * FROM vw_dokumentasi
					WHERE ID = '$id'";		
			
			$d['data'] = $this->app_model->manualQuery($sql);

			$this->template->display('dokumentasi/detail',$d);
		}else{
			?>
				<script type="text/javascript">
					alert('Maaf, Session anda telah habis. Silakan login ulang');
					window.location.replace('/intranet');
				</script>
			<?
		}
	}	

	function show_add(){
		$cek = $this->session->userdata('login_intranet_sukses');
		if(!empty($cek)){
			$d['judul']			= $this->config->item('lisensi_app');
			$d['perusahaan']	= $this->config->item('nama_perusahaan');
			$d['footer'] 		= $this->config->item('copyright');
			$d['app_name'] 		= $this->config->item('app_name');
			$d['deskripsi'] 	= $this->config->item('app_fullname');
			$d['kategori'] 		= $this->app_model->getKategoriDokumen();
			$d['kelompok'] 		= $this->app_model->getKelompokDokumen();

			$d['level'] 		= $this->session->userdata('level');
			$d['nik']			= $this->session->userdata('nik_intranet');
			$d['nama'] 			= $this->session->userdata('nama_intranet');
			$d['jabatan']		= $this->session->userdata('nama_jabatan_intranet');

			$this->template->display('dokumentasi/add',$d);
		}else{
			?>
				<script type="text/javascript">
					alert('Maaf, Session anda telah habis. Silakan login ulang');
					window.location.replace('/intranet');
				</script>
			<?
		}
	}

	function do_upload_file($file,$n_name){
		$max_file = $this->config->item('max_file');		
				
        $target_dir = $this->config->item('target_dir_file');
        // $panjang  = 1000;
        // $lebar    = 566;
					
		$temp   = explode('.', $file);
		$type   = end($temp);
		// $type 	= explode('.', $file);
		// $type 	= $type[count($type)-1];

		// $file_ext = substr($file, strripos($file, '.'));
		$sumber = $_FILES["file_dokumen"]["tmp_name"];
		$target = $_SERVER['DOCUMENT_ROOT'].$target_dir.$n_name;
	
		if (empty($file)) {
			return "";			
		}else{
			if (in_array($type, array("pdf","doc","docx","xls","xlsx","PDF","DOC","DOCX","XLS","XLSX")) && ($_FILES["file_dokumen"]["size"] < $max_file)){
				if (is_uploaded_file($sumber)){
					if(move_uploaded_file($sumber,$target)){
						// return $target;						
						// $config['image_library'] = 'gd2';
						// $config['allowed_types'] = 'gif|jpg|png|GIF|JPG|JPEG|PNG';
						// $config['source_image'] = $target;
						// $config['maintain_ratio'] = false;
						// $config['width'] = $panjang;
						// $config['height'] = $lebar;
						// $config['new_image'] = $target;
						// $this->image_lib->initialize($config);
						// $this->image_lib->resize();
					}
					return "";
				}
			}else{
				$this->session->set_flashdata('error_file', 'File yang diupload tidak sesuai type, format atau ukuran');
				header('location:'.base_url().'dokumentasi/show_add');			
			}
		}		
	}

	function simpan(){
		if(!isset($_POST)){
			show_404();
		}

		$ses_nik		= $this->session->userdata('nik_intranet');

		$company		= $this->input->post('cboCompany');
		$kategori		= $this->input->post('cboKategori');
		$kelompok		= $this->input->post('cboKelompok');
		$nomor	 		= $this->input->post('txtNoDok');
		$nama			= $this->input->post('txtNamaDok');
		$tgl_buat 		= $this->input->post('txtTglBuat');
		$pj 			= $this->input->post('txtNama');
		$jml_revisi		= $this->input->post('txtJmlRevisi');
		$revisi_1		= $this->input->post('tgl_revisi_1');
		$revisi_2		= $this->input->post('tgl_revisi_2');
		$revisi_3		= $this->input->post('tgl_revisi_3');
		$revisi_4		= $this->input->post('tgl_revisi_4');
		$ket			= $this->input->post('txtKet');
		$file 			= basename($_FILES['file_dokumen']['name']);		
		$file_ext 		= substr($file, strripos($file, '.'));
		$nama_file 		= $nomor.$file_ext;

		$sql  = "";
		$sql .= "SELECT * FROM t_dokumentasi WHERE NO_DOKUMEN='$nomor'";
		$stmt = $this->app_model->manualQuery($sql);
		
		if ($stmt->num_rows()<=0) {
			if (!empty($file)) {
				$this->do_upload_file($file,$nama_file);
				$nama_baru = $nama_file;
			}else{
				$nama_baru = 'no-file.png';
			}
	
			$sql = "";
			$sql .= "INSERT INTO t_dokumentasi(COMPANY,ID_KATEGORI,ID_KELOMPOK,NO_DOKUMEN,NAMA_DOKUMEN,
												PENANGGUNG_JAWAB,TGL_BUAT,JML_REVISI,
												TGL_REVISI_1,TGL_REVISI_2,TGL_REVISI_3,TGL_REVISI_4,
												KETERANGAN,FILE_DOKUMEN,LOG_DATE,LOG_USER) 
					 VALUES('$company','$kategori','$kelompok','$nomor','$nama','$pj',
							'$tgl_buat','$jml_revisi','$revisi_1','$revisi_2','$revisi_3','$revisi_4',
							'$ket','$nama_baru',NOW(),'$ses_nik')";	
			// var_dump($sql);
			// exit();
			$exec = $this->app_model->manualQuery($sql);
			if ($exec) {
				// echo "simpan_ok";
				?>
					<script type="text/javascript">
						alert('Dokumen berhasil diupload');
						window.location.replace('/edoc/dokumentasi');
					</script>
				<?
			}else{
				// echo "gagal_simpan";
				?>
					<script type="text/javascript">
						alert('Dokumen gagal diupload');
						window.location.replace('/edoc/dokumentasi');
					</script>
				<?
			}
		}else{
			?>
				<script type="text/javascript">
					alert('Dokumen gagal diupload\nNomor Dokumen tersebut sudah ada di database');
					window.location.replace('/edoc/dokumentasi');
				</script>
			<?
		}
															
	}

	function edit(){
		if(!isset($_POST)){
			show_404();
		}

		$ses_nik		= $this->session->userdata('nik_intranet');

		$id				= $this->input->post('txtIdDokumen');
		$company		= $this->input->post('cboCompany');
		$kategori		= $this->input->post('cboKategori');
		$kelompok		= $this->input->post('cboKelompok');
		$nomor	 		= $this->input->post('txtNoDok');
		$nama			= $this->input->post('txtNamaDok');
		$tgl_buat 		= $this->input->post('txtTglBuat');
		$pj 			= $this->input->post('txtNama');
		$jml_revisi		= $this->input->post('txtJmlRevisi');
		$revisi_1		= $this->input->post('tgl_revisi_1');
		$revisi_2		= $this->input->post('tgl_revisi_2');
		$revisi_3		= $this->input->post('tgl_revisi_3');
		$revisi_4		= $this->input->post('tgl_revisi_4');
		$ket			= $this->input->post('txtKet');
		$file 			= basename($_FILES['file_dokumen']['name']);		
		$file_ext 		= substr($file, strripos($file, '.'));
		$nama_file 		= $nomor.$file_ext;

		$sql  = "";
		$sql .= "SELECT * FROM t_dokumentasi WHERE ID='$id'";
		$stmt = $this->app_model->manualQuery($sql);
		
		if ($stmt->num_rows()>0) {

			if (!empty($file)) {
				$this->do_upload_file($file,$nama_file);
				$nama_baru = $nama_file;
			}else{
				$nama_baru = 'no-file.png';
			}

			$sql = "";			
			$sql .= "UPDATE t_dokumentasi SET COMPANY='$company',ID_KATEGORI='$kategori',ID_KELOMPOK='$kelompok',
					 NO_DOKUMEN='$nomor',NAMA_DOKUMEN='$nama',PENANGGUNG_JAWAB='$pj',
					 TGL_BUAT='$tgl_buat',JML_REVISI='$jml_revisi',TGL_REVISI_1='$revisi_1',TGL_REVISI_2='$revisi_2',
					 TGL_REVISI_3='$revisi_3',TGL_REVISI_4='$revisi_4',KETERANGAN='$ket'";
					 if(!empty($file)){
						$sql .=" ,FILE_DOKUMEN='$nama_baru'";
					 }					 
			$sql .=" WHERE ID='$id'";
			
			$exec = $this->app_model->manualQuery($sql);
			if ($exec) {
				// echo "simpan_ok";
				?>
					<script type="text/javascript">
						alert('Dokumen berhasil diupdate');
						window.location.replace('/edoc/dokumentasi');
					</script>
				<?
			}else{
				// echo "gagal_simpan";
				?>
					<script type="text/javascript">
						alert('Dokumen gagal diupdate');
						window.location.replace('/edoc/dokumentasi');
					</script>
				<?
			}			
		}else{
			// echo "edit_no";
			?>
				<script type="text/javascript">
					alert('Dokumen gagal diupdate');
					window.location.replace('/edoc/dokumentasi');
				</script>
			<?
		}			
	}

	function hapus(){
		if(!isset($_POST)){
			show_404();
		}	
		
		$kode 	= $this->input->post('kode');

		$sql    = "";
		$sql    = "SELECT * FROM t_dokumentasi WHERE ID='$kode'";
		$stmt	= $this->app_model->manualQuery($sql);		
		if ($stmt->num_rows()>0) {
			foreach($stmt->result_array() as $row){
				$nama_file = $row['FILE_DOKUMEN'];
			}

			$sql 	= "";
			$sql   .= "DELETE FROM t_dokumentasi WHERE ID='$kode'";

			$this->app_model->manualQuery($sql);

			if($nama_file!='no-file.png'){
				// hapus foto --------------------------------------------------------
				// $file_foto  = $_SERVER['DOCUMENT_ROOT'].'/api/foto_warga/'.$nama_foto;			
				$target_dir = $this->config->item('target_dir_file');				
				
				$file_dok  = $_SERVER['DOCUMENT_ROOT'].$target_dir.$nama_file;
				$fh         = fopen($file_dok, 'a');
				fclose($fh);
				unlink($file_dok);
				// end hapus foto ----------------------------------------------------
			}			

			$this->load_data();

		}
	}
}