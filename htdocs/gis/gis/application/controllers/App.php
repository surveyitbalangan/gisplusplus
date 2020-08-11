<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller {
	
	public function index()
	{	
		$nik	= $this->session->userdata('nik_intranet');
		// $akses 	= $this->app_model->cek_hak_akses($nik,102);
		$cek 	= $this->session->userdata('login_intranet_sukses');

		$d['judul']		= $this->config->item('lisensi_app');
		$d['perusahaan']= $this->config->item('nama_perusahaan');
		$d['footer'] 	= $this->config->item('copyright');
		$d['app_name'] 	= $this->config->item('app_name');
		$d['deskripsi'] = $this->config->item('app_fullname');

		if(!empty($cek)){
			// if($akses==1){				
				$d['bulan_ini'] = $this->app_model->getCurrentDate('BLN');
				$d['tahun_ini'] = $this->app_model->getCurrentDate('THN');
				$d['level'] 	= $this->session->userdata('level');
				$d['nik'] 	    = $this->session->userdata('nik_intranet');
				$d['nama'] 		= $this->session->userdata('nama_intranet');
				$d['jabatan']	= $this->session->userdata('nama_jabatan_intranet');

				$this->template->display('home',$d);
			// }else{
				?>
				<!-- <script type="text/javascript">
					alert('Maaf, Anda tidak punya hak akses ke halaman ini');
					window.location.replace('/portal');
				</script> -->
				<?
			// }			
		}else{			
			// $this->load->view('auth/index', $d);
			header('location:'.'/intranet');
		}
	}

	function load_data_doc(){
		$cek = $this->session->userdata('login_intranet_sukses');
		if(!empty($cek)){
			$cari   = $this->input->post("cari");
			$id_doc = $this->input->post("id_doc");

			$sql = "";
			$sql .= "SELECT * FROM vw_dokumentasi A0
					 WHERE ID ='$id_doc'";
			if ($cari!='') {
				$sql .= " AND (A0.NO_DOKUMEN LIKE '%$cari%' OR A0.NAMA_DOKUMEN LIKE '%$cari%')";
			}
			$sql .=" ORDER BY A0.ID";

			$d['data'] = $this->app_model->manualQuery($sql);
			$this->load->view('app/load_list_doc',$d);
		}else{
			?>
				<script type="text/javascript">
					alert('Maaf, Session anda telah habis. Silakan login ulang');
					window.location.replace('/intranet');
				</script>
			<?
		}
	}

	function getTotDocCategory(){		 
		$sql    = "";
		$sql    = " SELECT COUNT(*)AS 'DOK' 
					FROM m_kategori";
		$stmt 	= $this->app_model->manualQuery($sql);
		$jml = 0;
		foreach($stmt->result_array() as $data){	
			$jml = $data['DOK'];
		}
		echo $jml;
	}

	function getTotOpenDoc(){		 
		$sql    = "";
		$sql    = " SELECT COUNT(*)AS 'OPEN' 
					FROM t_dokumentasi
					WHERE STATUS='O'";
		$stmt 	= $this->app_model->manualQuery($sql);
		$jml = 0;
		foreach($stmt->result_array() as $data){	
			$jml = $data['OPEN'];
		}
		echo $jml;
	}

	function getTotDraftDoc(){		 
		$sql    = "";
		$sql    = " SELECT COUNT(*)AS 'DRAFT' 
					FROM t_dokumentasi
					WHERE STATUS='D'";
		$stmt 	= $this->app_model->manualQuery($sql);
		$jml = 0;
		foreach($stmt->result_array() as $data){	
			$jml = $data['DRAFT'];
		}
		echo $jml;
	}

	function getTotProgDoc(){		 
		$sql    = "";
		$sql    = " SELECT COUNT(*)AS 'PROG' 
					FROM t_dokumentasi
					WHERE STATUS='P'";
		$stmt 	= $this->app_model->manualQuery($sql);
		$jml = 0;
		foreach($stmt->result_array() as $data){	
			$jml = $data['PROG'];
		}
		echo $jml;
	}

	function getTotCloseDoc(){		 
		$sql    = "";
		$sql    = " SELECT COUNT(*)AS 'CLOSE' 
					FROM t_dokumentasi
					WHERE STATUS='C'";
		$stmt 	= $this->app_model->manualQuery($sql);
		$jml = 0;
		foreach($stmt->result_array() as $data){	
			$jml = $data['CLOSE'];
		}
		echo $jml;
	}	

	function getTotAllDoc(){		 
		$sql    = "";
		$sql    = " SELECT COUNT(*)AS 'ALL' 
					FROM t_dokumentasi";
		$stmt 	= $this->app_model->manualQuery($sql);
		$jml = 0;
		foreach($stmt->result_array() as $data){	
			$jml = $data['ALL'];
		}
		echo $jml;
	}

	function getLastDokumen(){		 
		$sql    = "";
		$sql    = " SELECT * 
					FROM vw_dokumentasi
					ORDER BY ID DESC LIMIT 0,10";
		$stmt 	= $this->app_model->manualQuery($sql);
		$isi = '';
		foreach($stmt->result_array() as $data){
			// if($data['TIC_PRIORITY']==1){
			// 	$warna = 'label-success';
			// }else if($data['TIC_PRIORITY']==2){
			// 	$warna = 'label-warning';
			// }else if($data['TIC_PRIORITY']==3){
			// 	$warna = 'label-danger';
			// }
			$warna = 'label-success';
			$isi .= '<li class="item">
						<div class="product-img">
						<img src="'.base_url().'asset/images/folder-2.png" alt="Image" width="50" height="50"/>
						</div>
						<div class="product-info">
							<a href="'.base_url().'asset/file_dokumen/'.$data['FILE_DOKUMEN'].'" target="_blank" class="product-title">'.$data['NO_DOKUMEN'].' - '.$data['NAMA_DOKUMEN'].'</span> <span class="label '.$warna.' pull-right">'.$data['STATUS_DESC'].'</span></a>							
							<span class="product-description">
							<small>'.'Modified : '.$data['TGL_BUAT'].'&nbsp;&nbsp; by : '.$data['EMP_NAME'].'</small>
							</span>
						</div>
					</li>';
		}
		echo $isi;
	}

	function mssql_escape($str){
	    if(get_magic_quotes_gpc()){
	        $str= stripslashes($str);
	    }
	    return trim(str_replace("'", "''", $str));
	}

	function auth_user(){
		if(!isset($_POST)){
			show_404();
		}

		$nik 	= $this->input->post('txtNIK');
		$pwd 	= $this->input->post('txtPwd');

		$sql 	= "";
		$sql 	= " SELECT * FROM mybc.vw_employee A
					WHERE A.EMP_NIK='$nik' AND A.EMP_PWD='$pwd'
					AND A.EMP_IS_ACTIVE=1";
		$stmt 	= $this->app_model->manualQuery($sql);
		if ($stmt->num_rows()>0) {			
			foreach($stmt->result_array() as $row){
				$sess_data['login_intranet_sukses'] = true;
				$sess_data['nik_intranet'] 			= $row['EMP_NIK'];
				$sess_data['nama_intranet'] 		= $row['EMP_NAME'];
				// $sess_data['id_divisi_intranet'] 	= $row['KD_DIVISI'];
				// $sess_data['nama_divisi_intranet'] 	= $row['KD_DEPT'];
				$sess_data['id_dept_intranet'] 		= $row['EMP_DEPT_ID'];
				$sess_data['nama_dept_intranet'] 	= $row['DEPT_NAME'];
				$sess_data['id_unit_intranet'] 		= $row['EMP_SECTION_ID'];
				$sess_data['nama_unit_intranet'] 	= $row['EMP_SECTION_ID'];
				$sess_data['id_jabatan_intranet'] 	= $row['EMP_TITLE_ID'];
				$sess_data['nama_jabatan_intranet'] = $row['TITLE_NAME'];

				// cek level Administrator ---------------------------
				if ($row['EMP_DEPT_ID']=='DEP0000') {
					$sess_data['level_admin'] = true;
					$sess_data['level'] = 1;
				}else{
					$sess_data['level_admin'] = false;
					$sess_data['level'] = 2;
				}
				// ---------------------------------------------------				
				
				$this->session->set_userdata($sess_data);
			}

			// catat log ke database --------------------------------------------------------
			// $sys_nik= $row['EMP_NIK'];
			// $ip     = $this->input->ip_address();		
			// $sql 	= "";
			// $sql 	= "INSERT into sys_log(SYS_DATE,SYS_APP_NAME,SYS_NIK,SYS_HOSTNAME,SYS_DESCRIPTION)
			//            VALUES(NOW(),'HR-SIPP','$sys_nik','$ip','Login Aplikasi SIPP')";
			// $stmt 	= $this->app_model->manualQuery($sql);
			// ------------------------------------------------------------------------------

			$d['judul']		= $this->config->item('lisensi_app');
			$d['company']	= $this->config->item('nama_perusahaan');
			$d['footer'] 	= $this->config->item('copyright');
			$d['app_name']	= $this->config->item('app_name');
			$d['app_name_child'] = $this->config->item('app_name_child');
			$d['nama_user'] = $this->session->userdata('nama_portal');
			$d['jabatan'] 	= $this->session->userdata('nama_jabatan_portal');

			// redirect('app','refresh');
			header('location:'.base_url().'');

		}else{
			$this->session->set_flashdata('msg', 'NIK atau Password yang anda masukkan salah');			
			header('location:'.base_url().'');
		}
	}

	function getListDocCategory(){
		$com 	= $this->input->post('company');

		$sql    = "";
		$sql    = " SELECT * 
					FROM m_kategori
					WHERE ID is not null";
		$stmt 	= $this->app_model->manualQuery($sql);
		$isi = '';
		foreach($stmt->result_array() as $data){			
			$isi .= '<li class="item">
						<div class="product-img">
							<a href="'.base_url().'app/show_detail/'.$com.'/'.$data['ID'].'">
							<img src="'.base_url().'asset/images/folder-1.png" alt="Product Image" width="50" height="50"/>
							</a>
						</div>
						<div class="product-info">
							<a href="'.base_url().'app/show_detail/'.$com.'/'.$data['ID'].'" class="product-title">'.$data['KATEGORI'].'</span></a>
							<span class="product-description">
								Shared Dokumen terkait dengan '.$data['KATEGORI'].' di PT '.$com.'
							</span>							
						</div>
					</li>';
		}
		echo $isi;
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
			$d['nik'] 	    = $this->session->userdata('nik_intranet');
			$d['nama'] 		= $this->session->userdata('nama_intranet');
			$d['jabatan']	= $this->session->userdata('nama_jabatan_intranet');
			
			$com = $this->uri->segment(3);
			$no  = $this->uri->segment(4);

			$sql = "";			
			$sql = "SELECT DISTINCT * FROM (
						SELECT a0.ID,a0.INISIAL,a0.KELOMPOK,COUNT(b0.ID) AS 'JML',b0.ID AS 'ID_DOK' 
						FROM m_kelompok a0
						LEFT JOIN t_dokumentasi b0 ON b0.ID_KELOMPOK=a0.ID
						WHERE b0.COMPANY='$com' AND b0.ID_KATEGORI='$no'
						UNION ALL
						SELECT a0.ID,a0.INISIAL,a0.KELOMPOK,'0' AS 'JML','' AS 'ID_DOK'
						FROM m_kelompok a0	
						WHERE a0.ID NOT IN (
							SELECT ID_KELOMPOK FROM t_dokumentasi
							WHERE COMPANY='$com' AND ID_KATEGORI='$no'
						)
					)AS a
					WHERE ID!=0
					ORDER BY ID";
			$d['data'] = $this->app_model->manualQuery($sql);

			$sql = "";
			$sql = "SELECT * FROM m_kategori WHERE ID='$no'";
			$d['kategori'] = $this->app_model->manualQuery($sql);

			$d['company'] = $com;

			$this->template->display('app/detail',$d);
		}else{
			?>
				<script type="text/javascript">
					alert('Maaf, Session anda telah habis. Silakan login ulang');
					window.location.replace('/intranet');
				</script>
			<?
		}
	}

	function doc_list(){
		$cek = $this->session->userdata('login_intranet_sukses');
		if(!empty($cek)){
			$d['judul']		= $this->config->item('lisensi_app');
			$d['perusahaan']= $this->config->item('nama_perusahaan');
			$d['footer'] 	= $this->config->item('copyright');
			$d['app_name'] 	= $this->config->item('app_name');
			$d['deskripsi'] = $this->config->item('app_fullname');
			
			$d['level'] 	= $this->session->userdata('level');
			$d['nik'] 	    = $this->session->userdata('nik_intranet');
			$d['nama'] 		= $this->session->userdata('nama_intranet');
			$d['jabatan']	= $this->session->userdata('nama_jabatan_intranet');
			
			$id_doc = $this->uri->segment(3);
			
			$sql = "";
			$sql = "SELECT * FROM vw_dokumentasi WHERE ID='$id_doc'";
			$d['data'] = $this->app_model->manualQuery($sql);
			$d['id_doc'] = $id_doc;


			$this->template->display('app/doc_list',$d);
		}else{
			?>
				<script type="text/javascript">
					alert('Maaf, Session anda telah habis. Silakan login ulang');
					window.location.replace('/intranet');
				</script>
			<?
		}
	}
	
	function develop(){
		$d['judul']		= $this->config->item('lisensi_app');
		$d['perusahaan']= $this->config->item('nama_perusahaan');
		$d['deskripsi'] = $this->config->item('app_fullname');
		$d['footer'] 	= $this->config->item('copyright');
		$d['app_name'] 	= $this->config->item('app_name');
		$d['level'] 	= $this->session->userdata('level');
		$d['nik'] 	    = $this->session->userdata('nik_intranet');	
		$d['nama'] 		= $this->session->userdata('nama_intranet');
		$d['jabatan']   = $this->session->userdata('nama_jabatan_intranet');
		// $d['open_tic']  = $this->app_model->getTotNewTicket();
			
		$this->template->display('develop',$d);
	}

	function logout(){
		$cek = $this->session->userdata('login_intranet_sukses');
		if(!empty($cek))
		{			
			$this->session->sess_destroy();
			header('location:'.'/intranet');
		}
		else{
			header('location:'.'/intranet');
		}
	}

}